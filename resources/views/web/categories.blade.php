@extends('web.base')

@section('content')


    <main id="main">


        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Categorias</h2>
                    <ol>
                        <li><a href="{{route('index')}}">Inicio</a></li>
                        <li>Categorias</li>
                    </ol>
                </div>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <section id="team" class="team section-bg">
                <div class="container">


                    <div class="row">

                        <div class="col-lg-4 col-md-2 d-flex align-items-stretch">
                            <div class="member" data-aos="fade-up" data-aos-delay="100">
                                <div class="member-img">
                                    <img src="{{asset('assets2/img/categorias2.jpg')}}" class="img-fluid" alt="">

                                </div>
                                <div class="member-info">
                                    <h4>Alimentos</h4>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                            <div class="member" data-aos="fade-up" data-aos-delay="100">
                                <div class="member-img">
                                    <img src="{{asset('assets2/img/categorias3.jpg')}}" class="img-fluid" alt="">

                                </div>
                                <div class="member-info">
                                    <h4>Ropa y Accesorios</h4>
                                    <span></span>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                            <div class="member" data-aos="fade-up">
                                <div class="member-img">
                                    <img src="{{asset('assets2/img/turismo.jpeg')}}" class="img-fluid" alt="">

                                </div>
                                <div class="member-info">
                                    <h4>Turismo</h4>
                                    <span> </span>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                            <div class="member" data-aos="fade-up">
                                <div class="member-img">
                                    <img src="{{asset('assets2/img/categorias1.jpg')}}" class="img-fluid" alt="">

                                </div>
                                <div class="member-info">
                                    <h4>Equipos de bioseguridad e insumos de salud</h4>
                                    <span> </span>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                            <div class="member" data-aos="fade-up">
                                <div class="member-img">
                                    <img src="{{asset('assets2/img/categorias4.jpg')}}" class="img-fluid" alt="">

                                </div>
                                <div class="member-info">
                                    <h4>Miscelaneos</h4>
                                    <span> </span>
                                </div>
                            </div>

                        </div>

                       {{-- <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                              <div class="member" data-aos="fade-up" data-aos-delay="200">
                                  <div class="member-img">
                                        <img src="{{asset('assets2/img/categorias5.jpg')}}" class="img-fluid" alt="">

                                   </div>
                                    <div class="member-info">
                                        <h4>Transporte</h4>
                                        <span></span>
                                    </div>
                                </div>
                            </div> --}}


                    </div>


                </div>
            </section>
        </section><!-- End Services Section -->

        <!-- ======= Features Section ======= -->
        <section id="features" class="features">

        </section><!-- End Features Section -->

    </main>

@endsection
