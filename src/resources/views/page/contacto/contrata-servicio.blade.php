<?php
   /*********************************************
	 *  Sitio web infrasoft
	 * Autor: Ariel Marcelo Diaz
	 * https://infrasoft.com.ar/
	 * Tel: +5493872204925
	 * Salta Capital
	 * Derechos reservados
	 **********************************************/
?>


<hr />
<div class="container">
	<h3>Solicita una version de prueba Gratuita por 30 dias</h3>
	
	@section("add_component") 
		@include('components.select',["title"=>"Rubro de la empresa:","id"=>"rubro","name"=>"rubro",
									"option"=>["Grafica y Libreria","Servicios","Ferreteria y Pintureria",
									"Moda e indumentaria","Comercio Minorista","Tecnologia","Otros"]])
		<input name='sistema' id='sistema' type='hidden'  value="<?php echo $sistema;?>"/>						
		@include("components.input",["title"=>"Cantidad de Sucursales:","id"=>"sucursales","name"=>"sucursales", "type"=>"number"])
		@include("components.input",["title"=>"Cantidad de Usuarios en el sistema:","id"=>"usuarios","name"=>"usuarios", "type"=>"number"])
		@include("components.input",["title"=>"Codigo de Descuento:","id"=>"cod_descuento","name"=>"cod_descuento"])
	@endsection
	@include("components.form",["titleForm"=>"productos_on_line" ])     	
    		
	
</div>

