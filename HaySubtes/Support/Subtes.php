<?php namespace HaySubtes\Support;

use PHPHtmlParser\Dom;
use Carbon\Carbon;
use FileSystemCache;

class Subtes {

	private $sourceURL = 'http://www.metrovias.com.ar/';

	private $lineas = [];

	public function __construct() {
		$this->createLineas();
		$this->getAndParseSubteInfo();
	}

	public function getLineas() {
		return $this->lineas;
	}

	private function getAndParseSubteInfo() {
		if ($cachedData = $this->isCached()) {
			$this->lineas = $cachedData;

			return true;
		}

		$dom = new Dom;
		$dom->loadFromUrl($this->sourceURL);

		foreach ($this->lineas as $linea => $info) {
			$lineInfo = $dom->find("#status-line-{$linea}-container")[0];
			$lineStatusClass = $lineInfo->getAttribute('class');

			if(strpos($lineStatusClass, 'suspendido') !== false) {
				$this->lineas[$linea]->status = 'CANCELLED';
			}
			if(strpos($lineStatusClass, 'demorado') !== false) {
				$this->lineas[$linea]->status = 'DELAYED';
			}

			if($this->isSleepingTime()) {
				$this->lineas[$linea]->status = 'SLEEPING';
			}

			// get raw status msg
			$status_msg = $lineInfo->find("#status-line-{$linea}")->text;
			$this->lineas[$linea]->statusMessage = html_entity_decode($status_msg, ENT_QUOTES, 'ISO-8859-1');
		}

		$this->updateStatusInfo();

		$this->cacheLines();
	}

	private function updateStatusInfo() {
		foreach ($this->lineas as $linea => $info) {
		    switch ($info->status) {
		        case 'NORMAL':
		        	$this->lineas[$linea]->statusText = 'Normal';
		        	$this->lineas[$linea]->statusCSS = ' normal';
		            break;
		        case 'CANCELLED':
		        	$this->lineas[$linea]->statusText = 'Interrumpida';
		        	$this->lineas[$linea]->statusCSS = ' interrumpido';
		            break;
		        case 'DELAYED':
		        	$this->lineas[$linea]->statusText = 'Demorada';
		        	$this->lineas[$linea]->statusCSS = ' demorado';
		            break;
		        case 'REDUCED':
		        	$this->lineas[$linea]->statusText = 'Limitada';
		        	$this->lineas[$linea]->statusCSS = ' limitado';
		            break;
		        case 'SLEEPING':
		        	$this->lineas[$linea]->statusText = 'Durmiendo';
		        	$this->lineas[$linea]->statusCSS = ' sleeping';
		            break;
		        default:
		        	// UNKNOWN
		        	$this->lineas[$linea]->statusText = '';
		        	$this->lineas[$linea]->statusCSS = ' unknown';
		    }
		}

	    return true;
	}

	private function createLineas() {
		$this->lineas = [
			"A" => new Linea('A'),
			"B" => new Linea('B'),
			"C" => new Linea('C'),
			"D" => new Linea('D'),
			"E" => new Linea('E'),
			"H" => new Linea('H'),
			"P" => new Linea('P'),
		];
	}

	private function isSleepingTime() {
		$now = Carbon::now('America/Argentina/Buenos_Aires')->hour;
		$opening = 5;
		$closing = 23;

		if ($now < $opening || $now > $closing) {
			return true;
		}

		return false;
	}

	public function getGlobalStatus() {
	    $status = 'S&iacute; :)';
	    $funcionando = 0;

	    foreach ($this->lineas as $linea => $info) {
	    	switch ($info->status) {
	    		case 'NORMAL':
	    			$funcionando++;
	    			break;
	    		case 'DELAYED':
	    		case 'CANCELLED':
	    		case 'REDUCED':
	    			$status = 'Casi :/';
	    			$funcionando++;
	    			break;
    			case 'SLEEPING':
	    			$status = 'Shh...';
	    			$funcionando++;
	    			break;
	    		default:
	    			break;
	    	}
	    }

	    if ($funcionando == 0) {
			$status = 'No :(';
	    }

	    return $status;
	}

	private function cacheLines() {
		$key = FileSystemCache::generateCacheKey('haysubtes');

		FileSystemCache::store($key, $this->lineas, 120);
	}

	private function isCached() {
		$key = FileSystemCache::generateCacheKey('haysubtes');

		$data = FileSystemCache::retrieve($key);

		if($data === false) {
		    return false;
		}

		return $data;
	}

	public function getTweetText() {
		$status = '&iexcl;YAY! Todos los subtes funcionan con normalidad :D';
	    $funcionando = 0;

	    foreach ($this->lineas as $linea => $info) {
	        if ($info->status === 'NORMAL') {
	            $funcionando++;
	        }
	        if ($info->status === 'DELAYED') {
	            $tw_status = 'Mmmh, algunos subtes andan... otros no :/';
	            $funcionando++;
	        }
	        if ($info->status === 'CANCELLED') {
	            $tw_status = 'Mmmh, algunos subtes andan... otros no :/';
	            $funcionando++;
	        }
	        if ($info->status === 'REDUCED') {
	            $tw_status = 'Mmmh, algunos subtes andan... otros no :/';
	            $funcionando++;
	        }
	        if ($info->status === 'SLEEPING') {
	            $tw_status = '&iexcl;Oh! Los subtes est&aacute;n durmiendo';
	            $funcionando++;
	        }
	    }

	    if ($funcionando == 0) {
			$tw_status = 'Buuh, todos los subtes están interrumpidos :C';
	    }

	    return $tw_status;
	}

}
