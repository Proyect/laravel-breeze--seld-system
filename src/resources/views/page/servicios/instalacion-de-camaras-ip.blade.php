@extends('layouts.site')
@section('container')
<?php
   /*********************************************
	 *  Sitio web infrasoft
	 * https://infrasoft.com.ar/
	 * Salta Capital
	 * Derechos reservados
	 **********************************************/
?>
<div class="container-fluid text-justify">
	<h1>Instalacion de camaras de vigilancia</h1>
	
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-7">
		<h3>Elementos necesarios para su instalacion</h3>
		<p>Los elementos necesarios para su instalación y configuración son los siguientes:
		<ul >
			<ol><b>Conexion a internet</b>: Elemento necesario para la transmisión a dispositivos moviles, laptop y ordenadores</ol>
			<ol><b>Router</b>:Dispositivo que proporciona conectividad a nivel de red o nivel tres en el modelo OSI</ol>
			<ol><b>DVR</b>:Un dvr es un equipo especializado diseñado para trabajar con cámaras de seguridad, su función es capturar lo
				 que la cámara ve y enviarla al disco duro del dvr en formato digital, la compresión de los equipos dvr pueden ser muchas,
				  pero hoy en día la mas utilizada	 en H.264</ol>
			 <ol><b>Camaras</b>: Se instalaran las camaras que sean necesaria</ol>
			 <ol><b>Cables y demas accesorios</b>: Tambien en la instalacion se incluyen cables y cargadores para las camaras y dvr</ol>		 
		</ul>
		</p>	
	</div>
	<div class="col-lg-4 col-md-4 col-sm-5">
		<img src="media/img/servicios/camaras-ip.png" class="img-fluid"/>
	</div>
</div>

<div class="row">	
	<div class="col-lg-4 col-md-4 col-sm-12">
		<h2 >Servicios Ofrecidos</h2>
		<ul>
			<li>Instalacion de camaras de seguridad y servidores</li>
			<li>Control de Acceso</li>
			<li>Venta de equipos de primera linea</li>
			<li>Actualizacion de sistemas</li>
		</ul>
	
		<h2>Servicios adicionales disponibles</h2>
		<ul>
			<li>Instalacion de alarmas</li>
			<li> <a href="servicios.redes"> Conectividad</a></li>
			<li><a href="servicios.asesoramiento-informatico">Asesoramiento informático </a> </li>
		
		</ul>
	</div>

	<div class="col-lg-8 col-md-8 col-sm-12">
		<img src="media/img/servicios/dahua.png" class="img-fluid"/>
	</div>
</div>
	@include("page.contacto.formulario-contacto")	
</div>	
@endsection