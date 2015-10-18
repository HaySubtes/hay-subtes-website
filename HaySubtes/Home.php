<?php namespace HaySubtes;

use Flight;
use HaySubtes\Support\Subtes;

class Home {

    public static function index()
    {
    	$subtes = new Subtes();

    	$viewData = ['subte' => $subtes];
    	echo Flight::get('blade')->view()->make('home', $viewData);
    }

}
