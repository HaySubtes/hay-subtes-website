@extends('layouts.master')

@section('lineas')
	<div class="lineas">
	  <ul>
	  	<li class="divider"></li>
	  	@foreach($subte->getLineas() as $linea)
	    <li class="linea a{{ $linea->statusCSS }}">
	      <div class="icono logo">
	        <img src="assets/images/icons/Linea-{{ $linea->name }}.png" alt="Estado subte linea {{ $linea->name }}" />
	      </div>
	      <div class="icono estado"></div>
	      <div class="descripcion estado">{{ $linea->statusText }}</div>
	      {{-- <div class="descripcion detalle">{{ $linea->statusMessage }}</div> --}}
	    </li>
	    <li class="divider"></li>
	  	@endforeach
	  </ul>
	</div>
@endsection
