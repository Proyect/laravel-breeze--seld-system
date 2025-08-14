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
<div class="container-fluid">
	<h1>Sistema Bancario</h1>
	<p>Este sistema tiene como fin los siguientes objetivos:</p>
	<ul>
		<li>el manejo de cuentas bancarias</li>
		<li>impresión de cheques </li>
		<li>registro de facturas</li>
		<li>registro de pagos</li>
	</ul>
	@include('components.carousel',["list"=>["media/img/productos/sistemas/bancario/conciliacion.png",
											"media/img/productos/sistemas/bancario/lista-movimientos.png",
											"media/img/productos/sistemas/bancario/orden-pago.png",
											"media/img/productos/sistemas/bancario/nuevo-cheque.png",
											"media/img/productos/sistemas/bancario/nueva-empresas.png"
			]])
	@include('page.productos.sist-beneficios')	
	@include('page.contacto.contrata-servicio',["sistema"=>"bancario"]) 		

</div>
@endsection