<?php
    	
	 
?>
<div class="container-fluid">
	<h1>Registro de Usuarios</h1>
	<p></p>
	<?php echo form_open( base_url().'index.php/sitios/mensajes/', 
		array("name"=>"registro","id"=>"registro", "class"=>"form-inline", "role"=>"form"));?>
		<div class="form-group">
					<label class="sr-only" >Apellido</label>
    				<input type="text" class="form-control input-sm" id="apellido" name="apellido" placeholder="Apellido" required />
    				
    				<label class="sr-only" >Nombre</label>
    				<input type="text" class="form-control input-sm" id="nombre" name="nombre" placeholder="Nombre" required />
    				
    				<label class="sr-only" >Direccion</label>
    				<input type="text" class="form-control input-sm" id="direccion" name="direccion" placeholder="Direccion" required />
    			</div>
    			<br />
    			<div class="form-group">	
    				<label class="sr-only" >Email</label>
    				<input type="email" class="form-control input-sm" id="email" name="email" placeholder="Email" required />
    				
    				<label class="sr-only" >Telefono</label>
    				<input type="number" class="form-control input-sm" id="telefono" name="telefono" placeholder="Telefono">
    				
    				<label class="sr-only" >Celular</label>
    				<input type="number" class="form-control input-sm" id="celular" name="celular" placeholder="Celular" required />
    			</div>
	<?php echo form_close();?>
</div>