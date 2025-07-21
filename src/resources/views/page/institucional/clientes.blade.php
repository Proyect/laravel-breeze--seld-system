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

<h1>Clientes y trabajos realizados</h1>
                    
            <p>Aquí mostramos algunos de nuestros clientes con quienes tuvimos el gusto de
            poder trabajar.</p>


<div class="row">
	
  <div class="col">
    <a href="" >
    	<b>Universidad Nacional de Salta</b>
      <img src="media/img/clientes/escudounsa.gif" alt="Universidad Nacional de Salta" 
      		class="img-fluid mx-auto d-block">
    </a>
  </div>
  
  <div class="col">
    <a href="" >    	
      <img src="media/img/clientes/LogoCopaipa.png" alt="COPAIPA" class="img-fluid mx-auto d-block">
    </a>
  </div>
  
  <div class="col">
    <a href="" >    	
      <img src="media/img/clientes/logo_grupo_horizonte.png" alt="Horizonte" 
      		class="img-fluid mx-auto d-block">
    </a>
  </div>
  
  <div class="col">
    <a href="" >    	
      <img src="media/img/clientes/gobierno-de-la-provincia-de-salta.png" 
      			alt="Gobierno de la provincia de Salta" class="img-fluid mx-auto d-block">
    </a>
  </div>
  
  <div class="col">
    <a href="" >    	
      <img src="media/img/clientes/estudioaban.png" alt="Estudio Aban" class="img-fluid mx-auto d-block">
    </a>
  </div>
  
  <div class="col">
    <a href="" >
    	<b>Federacion de Psicologos de la Republica Argentina</b>
      <img src="media/img/clientes/ulapsi.png" alt="Federacion de Psicologos de la Republica Argentina" 
      		class="img-fluid mx-auto d-block">
    </a>
  </div>
  
  <div class="col">
    <a href="" >
    	
      <img src="media/img/clientes/pabike.png" alt="Pa Bike Salta" class="img-fluid mx-auto d-block">
    </a>
  </div>
  
</div>
<div >
		<!-- Diseño y desarrollo Web -->
	@include('components.modalButton',["title"=>"Diseño y Desarrollo Web","id"=>"diseño_y_desarrollo_web"])
	
	@section("detail") 
		@include('components.carousel',["list"=>["media/img/clientes/sist_netbook.png",
												 "media/img/clientes/sist_inscripcion.png",
												 "media/img/clientes/sist_admin_proyectos.png",
												 "media/img/clientes/sist_stock.png"   
										]]) 
	@endsection
	
	@include('components.modal',["id"=>"diseño_y_desarrollo_web","title"=>"Diseño y Desarrollo Web"]) 	
          
    <!-- Software y sistemas -->
	@include('components.modalButton',["title"=>"Software y Sistemas a medida","id"=>"software-y-sistemas"])
    
	@section('detail')
		@include('components.carousel',["id"=>"sistema-software","list"=>[
											"media/img/productos/sistemas/stock/busqueda-avanzada-recibos.png",
											"media/img/productos/sistemas/stock/comprobante-de-compra.png" ,
											"media/img/productos/sistemas/stock/user1.png" ,
											"media/img/productos/sistemas/bancario/busqueda-avanzada-cheque1.png", 
											"media/img/productos/sistemas/bancario/cheques-facturas.png",
											"media/img/productos/sistemas/bancario/conciliacion.png" 
		]])
		<hr />
		<ul class="list-inline">
			<li>Control de Sucursal</li>
			<li> Manejo de Viandas</li>
			<li>Control de Distribucion</li>
			<li> Liquidacion de Sueldos</li>
			<li>Control de Administración</li>
			<li> Consultorios Medicos</li>
			<li>Control de stock</li>
		</ul>
	@endsection   
	
	@include('components.modal',["id"=>"software-y-sistemas","title"=>"Software y Sistemas a medida",
			"detail"=>[]])

	<!-- Redes y servidores -->	
	@include('components.modalButton',["title"=>"Redes y Servidores","id"=>"redes-servidores"])

	@section('detail')
		@include('components.carousel',["list"=>[
												"media/img/servicios/redes/server.jpg",
												"media/img/servicios/redes/pc.jpg",
												"media/img/servicios/redes/data-center.jpg" 
		]])
	@endsection
	@include('components.modal',["title"=>"Redes y Servidores","id"=>"redes-servidores"])
	
	<!-- Camaras de seguridad -->
	@include('components.modalButton',["title"=>"Camaras de Seguridad","id"=>"camaras-de-seguridad"])
	
	@section('detail')
		@include("components.carousel",["list"=>[
												"media/img/servicios/dahua.png",
												"media/img/servicios/camaras/camaraIP.png",
												"media/img/servicios/camaras/dispositivos.png" 
		]])

	@endsection

	@include('components.modal',["title"=>"Camaras de Seguridad","id"=>"camaras-de-seguridad"])

</div>
@endsection   




