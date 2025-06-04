
<!DOCTYPE html>
<html lang="es">

<head>
    <title>{{$site[0]->title ?? "Infrasoft Servicios Informaticos"}}</title>
    <!-- Define Charset -->
    <meta charset="utf-8">
    <!-- Responsive Metatag -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="{{$site[0]->descripcion ?? "Desarrollo de sistemas  y Servicios Informaticos"}}"/>
  <meta name="author" content="Ariel Marcelo Diaz">
  <meta name='keywords' content="{{$site[0]->tag ?? "sistemas, software, programas, servicios"}}"/>
  <link rel='shortcut icon' type='image/x-icon' href="media/img/icono.ico" />
  <link rel='canonical' href='https://www.infrasoft.com.ar/'/>
  <meta name='google-site-verification' content='5quw57-5vY5HJSCDwHIMxEJPkflMJHuVl0ATGqBrMJY' />
  <link href='https://www.facebook.com/infrasofts' rel='publisher'>
  <link href='https://twitter.com/infra_soft' rel='publisher'>
  <link href='https://api.whatsapp.com/send?phone=5493872204925&text=-Infrasoft-' rel='publisher'>

  <!-- Google -->
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-N0YBR2XWNQ"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-N0YBR2XWNQ');
</script>

<!-- Bootstrap CSS -->  	
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">	
<link rel="stylesheet" href= "./media/css/styles.css" type="text/css" media="screen" />

<!-- fontawesome -->
<link href="./media/fontawesome/css/fontawesome.css" rel="stylesheet">
<link href="./media/fontawesome/css/brands.css" rel="stylesheet">
<link href="./media/fontawesome/css/solid.css" rel="stylesheet">
   
<!--[if IE 8]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

{{$CodesStyles ?? ""}}
</head>
<body>
  <div class="position-absolute  top-50 start-50 text-center d-flex justify-content-center" >
    <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status" id="preload">
      <span class="sr-only">Loading...</span>
    </div>
    </div>
    <div class="container">
        <!-- Contact Header -->    
        <div class = "mx-auto">
            <ul class='nav nav-pills nav-fill'>
              <li class="list-group-item">
                <a class='facebook' href='https://www.facebook.com/infrasofts/' target="_blank">
                    <i class='fab fa-facebook-f'></i>
                </a>
              </li>
              <li class="list-group-item">
                <a class='twitter' href='https://twitter.com/infra_soft' target="_blank">
                    <i class='fab fa-twitter'></i>
                </a>
              </li>   <!--                            
              <li class="list-group-item">
                <a class='linkedin' href='https://www.linkedin.com/in/infrasoft-servicios-informaticos-55302133' target="_blank">
                    <i class='fab fa-linkedin-in'></i>
                </a>
              </li>    -->    
              
              <li class="list-group-item">
                  <a class='whatsapp' href='https://api.whatsapp.com/send?phone=5493872204925&text=-Consultas-' target="_blank">
                      <i class='fab fa-whatsapp'></i>
                  </a>
              </li>
            </ul>
        </div>

        <!-- Nav -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded border border-2" aria-label="Eleventh navbar">
            <div class="container-fluid">
              <a class="navbar-brand fw-bold" href="page.presentacion.home">INFRASOFT</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09" 
                    aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
      
              <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-bs-toggle="dropdown" aria-expanded="false">Institucional</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown09">
                      <li><a class="dropdown-item" href="institucional.institucional">Quienes Somos</a></li>
                      <li><a class="dropdown-item" href="institucional.politica">Politica de Privacidad</a></li>
                      <li><a class="dropdown-item" href="institucional.preguntas-frecuentes">Preguntas Frecuentes</a></li>
                      <li><a class="dropdown-item" href="institucional.como-trabajamos">Como Trabajamos</a></li>
                      <li><a class="dropdown-item" href="institucional.tecnologias/">Tecnologias</a></li>
                      <li><a class="dropdown-item" href="institucional.clientes">Clientes</a></li>
                    </ul>
                  </li> 
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-bs-toggle="dropdown" aria-expanded="false">Productos</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown09">
                      <li><a class="dropdown-item" href="productos.sistema-de-escritorio/">Sistemas</a></li>
                      <li><a class="dropdown-item" href="productos.sist-stock/">Sistemas de Stock</a></li>
                      <li><a class="dropdown-item" href="productos.sist-bancario/">Sistemas Bancario</a></li>
                      <li><a class="dropdown-item" href="productos.sistemas-web/">Sistemas Web</a></li>
                      <li><a class="dropdown-item" href="productos.plataformas-educativas/">Plataformas Educativas</a></li>                
                    </ul>
                  </li> 
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-bs-toggle="dropdown" aria-expanded="false">Servicios</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown09">
                      <li><a class="dropdown-item" href="servicios.desarrollo-de-software/">Desarrollo de Software</a></li>
                      <li><a class="dropdown-item" href="servicios.desarrollo-web/">Desarrollo Web</a></li>
                      <li><a class="dropdown-item" href="servicios.desarrollo-mobile/">Desarrollo mobile</a></li>
                      <li><a class="dropdown-item" href="servicios.redes/">Redes</a></li>
                      <li><a class="dropdown-item" href="servicios.instalacion-de-camaras-ip/">Camaras de Seguridad</a></li>
                      <li><a class="dropdown-item" href="servicios.asesoramiento-informatico/">Asesoramiento Informatico</a></li>
                      <li><a class="dropdown-item" href="servicios.servicio-tecnico/">Servicio Tecnico</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown09" data-bs-toggle="dropdown" aria-expanded="false">Contactos</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown09">
                      <li><a class="dropdown-item" href="contacto.contacto">Contacto</a></li>
                      <li><a class="dropdown-item" href="contacto.instalacion-de-camaras-ip/">Camaras de seguridad</a></li>
                      <li><a class="dropdown-item" href="contacto.cotizacion/">Cotizacion</a></li>
                      <li><a class="dropdown-item" href="contacto.presupuesto-web/">Presupuesto Web</a></li>
                      <li><a class="dropdown-item" href="contacto.plataformas-educativas/">Plataformas Educativas</a></li>
                      <li><a class="dropdown-item" href="contacto.oportunidad-laboral/">Oportunidad Laboral</a></li>
                      <li><a class="dropdown-item" href="contacto.formas-de-pago/">Formas de Pago</a></li>
                    </ul>
                  </li>
                </ul>
                
                <form class="row" method="post" action="{{$action ?? route('site.search')}}"  >
                  @csrf
                <div class="input-group mb-3">
                  <input class="form-control" type="text" placeholder="Search" aria-label="Search" id="buscar" name="buscar" required>
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                     <i class="fas fa-file-contract"></i> Buscar
                  </button>
                </div>
                </form>
              </div>
            </div>
          </nav>

    @yield('container')     
    </div>    
<footer>
    <div class="container-fluid">
        <div class='row '>
        </div>
    </div>
</footer>
<!-- Librería jQuery requerida por los plugins de JavaScript -->  
  	
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./media/js/functions.js"></script>
{{$footer ?? ""}}
<script>
  $('#form').submit(function(event) {
  event.preventDefault(); // Evita el envío del formulario por defecto
  var datos = $(this).serialize(); // Serializa los datos del formulario
  $.ajax({
    url: 'http://localhost/infrasoft/my-site2024/public/post', // URL del script que procesa los datos
    method: 'POST',
    data: datos,
    success: function(response) {
      // Manejar la respuesta del servidor
      if (response === 'success') {
        console.log('Formulario enviado correctamente');
      } else {
        console.log('Error al enviar el formulario');
      }
    }
    //still not finished
  });
});
</script>
</body>