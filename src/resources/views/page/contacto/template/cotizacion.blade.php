<div class="container text-justify">
    <h1>Cotizacion</h1>
        <div class="container">
                        <p>Para Facilitar la descripcion del Sitio que usted necesita, hemos desarrollado un
                formulario de consultas de presupuesto para el desarrollo de su proyecto con una serie 
                de pregunta para conocer sus requerimientos. Y poder calcular con mas exactitud el
                presupuesto requerido para el desarrollo de su proyecto.</p>    
                
                <p>Importante, Los Campos marcados con (*) son Obligatorios</p>
                <h3>Datos Personales</h3>
         </div>
            
         <div class="row">            
                <div class="container-fluid">
                    <h2>Requerimientos Generales:</h2>    			
                </div>	
    
        @section('add_component')
        <div class="form-group row">
            @include("components.select",["title"=>"Prioridad:","id"=>"prioridad","name"=>"prioridad",
                        "option"=>["baja","media","alta"]])
            @include("components.select",["title"=>"Aplicacion a realizar:","id"=>"tipo_aplicacion","name"=>"tipo_aplicacion",					
                        "option"=>["Cliente-Servidor","Aplicacion Web","Cifrado de Datos", "APP"]])
        </div>
        <div class="form-group row">				
            @include("components.radio",["title"=>"Dispone del Contenido necesario para el desarrollo:","id"=>"dispone_contenido",
                "name"=>"dispone_contenido", "option"=>["Si","No"]])
            <div class="container-fluid">
                <h3>Informacion de su Aplicacion:</h3>
            </div>
            @include("components.checkbox",["title"=>"Datos Institucionales","id"=>"datos_institucionales",
                "name"=>"datos_institucionales"])
            @include("components.checkbox",["title"=>"Catalogo de Productos o Servicios","id"=>"catalogo","name"=>"catalogo"])
            @include("components.checkbox",["title"=>"Documentacion/Manuales","id"=>"documentacion","name"=>"documentacion"])
            @include("components.checkbox",["title"=>"Administracion de contenidos","id"=>"administracion","name"=>"administracion"])
            @include("components.checkbox",["title"=>"Acceso privado a contenidos","id"=>"acceso_restringido","name"=>"acceso_restringido"])
    
            <p class="text-muted">Aquí deberá detallar todo lo esperado a su proyecto, luego de ello nos 
                contactaremos con Ud., para un relevamiento más detallado, esto permitirá un desarrollo
                más eficiente y de gran calidad.</p>
            </div>
        </div>
        @endsection
        @include("components.form",["titleForm"=>"cotizacion"])		
        
         
    </div>