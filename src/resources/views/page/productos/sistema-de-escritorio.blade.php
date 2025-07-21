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
<h1>Sistema de escritorio</h1>
<div class="container-fluid">
<div class="row">
	<div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">
	<p>Un sistema de escritorio es la implementación de un sistema en un entorno y sistema operativo que requiere el usuario.</p>
	<p>Tenemos en nuestro repositorio diferentes aplicaciones realizadas en software libre, los cuales se podrán adaptar a las 
		necesidades de cada cliente.</p>
	<p>Cada uno de estos esta depurados y libre de errores, vienen con una garantía de uso, y un periodo de servicio técnico luego 
		de la instalación.</p>
	<p>Ud. podrá sentirse cómodo viendo como en cuestión de minutos, podrá realizar lo que manualmente llevaba horas realizándolo 
		a mano. También resguardar datos y tenerlos a su disposición. La tecnología es una gran herramienta y podemos actualizarnos
		 y lograr ser más eficientes.
	</p>
	</div>
	<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
		<img src="media/img/productos/compu.png" class="img-responsive"	/>
	</div>
</div>
	
	<h2>Sistemas realizados</h2>
	<p>Disponemos de sistemas ya realizados, que son facilmente implementables en su empresa o entidad afin. </p>
	
	<p>Cada uno de ellos fue testeado y depurado, para que exista un correcto funcionamiento.</p>
	
	<div class="row">
	<div class="card border-primary mb-4 shadow-lg mx-auto" style="width: 18rem;">
          <div class="card-header"  >
            <h4 class="my-0 font-weight-normal">Sistema Bancario</h4>
          </div>
          <div class="card-body">
            
            <ul class="list-unstyled mt-4 mb-4">
              <li>Impresion de Cheques</li>
              <li>Manejo de movimientos bancarios</li>
              <li>Registro de Proveedores</li>
              <li>Registro de Clientes</li>
            </ul>
            <a href="productos.sist-bancario/">
            <button type="button" class="btn btn-lg btn-block btn-primary">
            	<i class="fas fa-money-check"></i> Mas detalles
            </button>
            </a>
          </div>
     </div>
     
     <div class="card border-primary mb-4 shadow-lg mx-auto" style="width: 18rem;">
          <div class="card-header"  >
            <h4 class="my-0 font-weight-normal">Stock y ventas</h4>
          </div>
          <div class="card-body">
           
            <ul class="list-unstyled mt-1 mb-4">
              <li> compras</li>
              <li>ventas</li>
              <li>productos</li>
              <li>clientes</li>
              <li>proveedores</li>
            </ul>
            <a href="productos.sist-stock/">
            <button type="button" class="btn btn-lg btn-block btn-primary">
            	<i class="fas fa-money-check"></i> Mas detalles
            </button>
            </a>
          </div>
     </div>
     
    <!-- <div class="card mb-4 box-shadow mx-auto" style="width: 18rem;">
          <div class="card-header"  >
            <h4 class="my-0 font-weight-normal">Factura Electronica</h4>
          </div>
          <div class="card-body">
          
            <ul class="list-unstyled mt-1 mb-4">
              <li>Emision</li>
              <li>Control</li>
              <li>Clientes</li>
              <li>Pagos</li>
            </ul>
            <a href="index.php/sitios/productos/sist-factura-electronica/">
            <button type="button" class="btn btn-lg btn-block btn-primary">
				<i class="fas fa-money-check"></i> Mas detalles
			</button>
			</a>
          </div>
     </div>-->
	</div>
		
  
	
	<a href="#como-trabajamos" class="btn btn-success" data-toggle="collapse">
			Como Trabajamos
	</a>
	<a href="#cotizacion" class="btn btn-success" data-toggle="collapse">
			Cotizacion
	</a>
	
	<div id="como-trabajamos" class="collapse">
       @include('page.institucional.template.como-trabajamos')
	</div>
	<div id="cotizacion" class="collapse">
     	</div>
</div>
@endsection	