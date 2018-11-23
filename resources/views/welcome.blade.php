@extends('layouts.app')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1" class=""></li>
                    <li data-target="#myCarousel" data-slide-to="2" class=""></li>
                </ol>
                <div class="carousel-inner bg-secondary">
                    <div class="carousel-item active">
                        <img src="https://res.cloudinary.com/hammock-software/image/upload/c_scale,g_south_east,h_100,l_icon.png/v1540232384/pexels1.jpg" class="w-100">
                        <div class="container">
                            <div class="carousel-caption text-left">
                                <h3 class="text-white">Ten entrevistas con empresas de {{env('APP_NAME')}}.</h3>
                                <p><a class="btn btn-lg btn-primary" href={{route('register')}} role="button">Registrarse</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://res.cloudinary.com/hammock-software/image/upload/c_scale,g_south_east,h_100,l_icon.png/v1540232381/pexels2.jpg" class="w-100">
                        <div class="container">
                            <div class="carousel-caption">
                                <h3>Crea oportunidades en {{env('APP_NAME')}}.</h3>
                                <p><a class="btn btn-lg btn-primary"
                                      href={{url('employees')}} role="button">Aspirantes</a></p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://res.cloudinary.com/hammock-software/image/upload/c_scale,g_south_east,h_100,l_icon.png/v1540232381/pexels3.jpg" class="w-100">
                        <div class="container">
                            <div class="carousel-caption text-right">
                                <h3 class="text-white">Ayúdanos a crecer contigo en {{env('APP_NAME')}}.</h3>
                                <p><a class="btn btn-lg btn-primary"
                                      href={{url('employers')}} role="button">Empresas</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <section class="jumbotron text-center pt-5">
                <div class="container">
                    <h1 class="jumbotron-heading">Bolsa de Trabajo</h1>
                    <h5 class="lead text-muted">¡Genera, Aplica o ve Empleos!</h5>
                    <p>
                        <a href="{{ url('/employees') }}" class="btn btn-primary my-2 btn-lg">Aspirantes</a>
                        <a href="{{ url('/employers') }}" class="btn btn-secondary my-2 btn-lg">Empresas</a>
                    </p>
                </div>
            </section>
        </div>
    </div>
@endsection
