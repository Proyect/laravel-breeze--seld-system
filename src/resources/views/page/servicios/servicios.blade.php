@extends('layouts.site')
@section('container')
<div class="container-fluid">
	<h1>Servicios</h1>
	<p>Nuestro compromiso, se basa en lograr una gran calidad, y brindar soporte y variedad de cada uno de nuestros servicios 
		permitiendo así lograr cada uno de los objetivos que nuestros clientes requieren.</p>
	<div class="row">	
	<div class="col">
  		<h2>Desarrollo de software</h2>
  		<div class="panel-body">
    		<p>Ofrecemos soluciones que permiten integrar muchos de los procesos de negocio en su empresa con proveedores, clientes, socios, etc. Logrado un
    	 	óptimo rendimiento en su producción y un mayor desempeño.
    		</p>
    		<p>Disponemos de los conocimientos y la experiencia necesaria para poder brindar una amplia variedad de soluciones informáticas a su Empresa o 
    		negocio.
    		</p>
    		<p>Todos nuestros sistemas  son desarrollados para su óptimo funcionamiento, fáciles de operar, documentados, de fácil adaptación, logrando 
    		tambien funcionar en diferentes sistemas operativos (Windows, Linux, dispositivos móviles, etc.). 
			</p> 
 
 			<img src="media/img/servicios/cd.png" alt="desarrollo de software" class="img-responsive img-rounded w-75 h-75  p-3" />
 			<div class="text-right">
				<a href="index.php/sitios/servicios/desarrollo-de-software/" >
					<i>Mas info</i>
				</a>
			</div>
  		</div>
	</div>	
	
	<div class="col">
  		<h2>Diseño y desarrollo web</h2>
  		<div class="panel-body">
    		<p>Realizamos sitios Web dinámicos, acode a sus requerimientos. Nos enfocamos que su sitio sea agradable y por sobre todo óptimos, 
    			logrando así los objetivos que nuestros clientes deseen apuntar.
    		</p>
    		<p>Nuestros sitios se adaptan a los diferentes dispositivos en el mercado. 
    		</p>
    		<p>Ajustamos nuestro presupuesto acorde a sus necesidades, y por sobre todo hacemos hincapié en la calidad de nuestros productos.
			</p> 
 
 			<img src="media/img/servicios/servicios-informatica.png" alt="diseño web" class="img-responsive img-rounded" />
 			<div class="text-right">
				<a href="index.php/sitios/servicios/desarrollo-de-software/" >
					<i>Mas info</i>
				</a>
			</div>
  		</div>
	</div>
	
	<div class="col">
  		<h2>Desarrollo mobile</h2>
  		<div class="panel-body">
    		<p>Nuestro servicio de Desarrollo Mobile permite poder desarrollar cualquier tipo de aplicación Mobile (app), que se ajuste a sus 
    			necesidades de negocio y de tecnología.
    		</p>
    		<p>Nuestra meta es ayudar brindar a nuestros clientes los procesos y desarrollos óptimos que necesita su negocio pueda ser accesible 
    			desde cualquier dispositivo móvil.
    		</p>
    		<p>Los dispositivos móviles brindan gran comodidad y simplicidad debido a su tamaño y portabilidad
			</p> 
 
 			<img src="media/img/servicios/desarrollo-mobile.png" alt="diseño web" class="img-responsive img-rounded" />
 			<div class="text-right">
				<a href="index.php/sitios/servicios/desarrollo-de-software/" >
					<i>Mas info</i>
				</a>
			</div>
  		</div>
	</div>
	
	
	<div class="col">
  		<h2>Comercio Electronico</h2>
  		<div class="panel-body">
    		<p>Internet es un medio global de comunicación, que permite el intercambio de datos entre los usuarios conectados a la red y que conecta 
    			a millones de servidores encargados del servicio de información.
    		</p>
    		<p>Internet ofrece una oportunidad única, especial y decisiva a organizaciones de cualquier tamaño.
    		</p>
    		<p>Esperamos su consulta si desea hacer conocer sus productos o servicios a millones de usuarios que día a día están on line 

			</p> 
			
 			<img src="media/img/servicios/conectividad.png" alt="comercio electronico" class="img-responsive w-25 p-3" />
 			<div class="text-right">
				<a href="index.php/sitios/servicios/desarrollo-de-software/" >
					<i>Mas info</i>
				</a>
			</div>
  		</div>
	</div>
	
	<div class="col">
  		<h2>Diseño Grafico</h2>
  		<div class="panel-body">
    		<p>Proveemos de un diseño grafico adaptado a las necesidades del sistema, sitio web o logotipo que requiera para su emprendimiento o 
    			empresa.
			</p>
    		<p>Un buen diseño en su logo o carteleria, requiere una correcta elección de tipografía, colores e imagen.    			
    		</p>
    		<p>Consúltenos para una atención personalizada y un presupuesto adecuado.


			</p> 
 
 			<img src="media/img/servicios/diseno-grafico.png" alt="comercio electronico" class="img-responsive img-rounded" />
 			<div class="text-right">
				<a href="index.php/sitios/servicios/desarrollo-de-software/" >
					<i>Mas info</i>
				</a>
			</div>
  		</div>
	</div>
	
	<div class="col">
  		<h2>Redes Informaticas</h2>
  		<div class="panel-body">
    		<p>Una red informática es un conjunto de dispositivos interconectados entre sí a través de un medio, que intercambian información y 
    			comparten recursos.
    		</p>
    		<p>La conectividad entre equipos informáticos es posible e inevitable. Permite un mejor desempeño de los procesos de las empresas, 
    			economizando costos y tiempos. 
    		</p>
    		<p>La interconexión de servidores, ordenadores y dispositivos, requieren una gran planificación y además un correcto mantenimiento..

			</p> 
 
 			<img src="media/img/servicios/redes.png" alt="diseño web" class="img-responsive img-rounded" />
 			<div class="text-right">
				<a href="index.php/sitios/servicios/desarrollo-de-software/" >
					<i>Mas info</i>
				</a>
			</div>
  		</div>
	</div>
	</div>
	<hr />
	@include('page.contacto.formulario-contacto')
</div>
@endsection