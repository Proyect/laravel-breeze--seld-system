@extends('layouts.site')
@section('container')
<div class="container"> 
    <div>
        <div id="carouselExampleDark" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000">
                <img src="media/img/presentacion/campo13.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>First slide label</h5>
                  <p>Some representative placeholder content for the first slide.</p>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <img src="media/img/presentacion/campo11.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Second slide label</h5>
                  <p>Some representative placeholder content for the second slide.</p>
                </div>
              </div>
              <div class="carousel-item">
                <img src="media/img/presentacion/campo12.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  <h5>Third slide label</h5>
                  <p>Some representative placeholder content for the third slide.</p>
                </div>
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
    </div>
    <hr/>
    <div class='row'>
        @include('components.list-animation',['title'=>"Desarrollo de Sistemas",
                    "detail"=>"Sistemas desarrollados con las últimas tecnologías, mediantes procesos estandarizados y correctamente planificados.",
                    "link"=>"servicios.desarrollo-de-software/","fa"=>"fab fa-ubuntu",])

        @include('components.list-animation',['title'=>"Diseños Web",
                    "detail"=>"Diseños adaptados a los diferentes dispositivos que existen en la actualidad (pc, notebook, ipad, tablets, ipod,
                    iphone, celulares, etc).",
                    "link"=>"productos.sistemas-web/","fa"=>"fas fa-laptop-code",])

        @include('components.list-animation',['title'=>"Desarrollo de App",
                    "detail"=>"Desarrollo, analisis de factibilidad, analisis, diseño, etc. Aplicando tecnologias libres",
                    "link"=>"servicios.desarrollo-mobile/","fa"=>"fas fa-mobile-alt",])
        
        @include('components.list-animation',['title'=>"Servicio Tecnico",
                    "detail"=>"Servicios de mantenimiento y actualizacion de sistemas informaticos. Tareas de automatizacion, programacion, etc",
                    "link"=>"servicios.servicio-tecnico/","fa"=>"fas fa-tools",])

        @include('components.list-animation',['title'=>"Marketing Digital",
                    "detail"=>"El desarrollo de múltiples técnicas para compartir y difundir contenido en Redes Sociales, Posicionamiento en buscadores, diseño grafico, merchandising, etc",
                    "link"=>"servicios.comercio-electronico/","fa"=>"fas fa-poll",])

        @include('components.list-animation',['title'=>"Desarrollo de Sistemas",
        "detail"=>"Sistemas desarrollados con las últimas tecnologías, mediantes procesos estandarizados y correctamente planificados.",
        "link"=>"servicios.desarrollo-de-software/","fa"=>"fab fa-ubuntu",])

        @include('components.list-animation',['title'=>"Desarrollo de Sistemas",
        "detail"=>"Sistemas desarrollados con las últimas tecnologías, mediantes procesos estandarizados y correctamente planificados.",
        "link"=>"servicios.desarrollo-de-software/","fa"=>"fab fa-ubuntu",])

        @include('components.list-animation',['title'=>"Desarrollo de Sistemas",
        "detail"=>"Sistemas desarrollados con las últimas tecnologías, mediantes procesos estandarizados y correctamente planificados.",
        "link"=>"servicios.desarrollo-de-software/","fa"=>"fab fa-ubuntu",])
    </div>
</div>
@endsection
