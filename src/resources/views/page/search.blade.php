<?php
   /*********************************************
	 *  Sitio web infrasoft
	 * https://infrasoft.com.ar/
	 * Salta Capital
	 * Derechos reservados
	 **********************************************/
      
?>
@extends('layouts.site')

@section('container')
<div class='row'>
	@foreach ($search as $item)
		 @include('components.list-animation',
		 ["title"=> $item["title"],
		   "link"=>"/".$item["categoria"].".".$item["pagina"],
		   "detail"=>$item["descripcion"] ])
	@endforeach
	
</div>
<div class="container text-center">
	<p>Se han encontrado {{$count ?? ""}} resultados</p>
</div>
@endsection