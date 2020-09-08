@extends('web.base')

@section('content')

    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">
            @include('web.slider')
        </div>
    </section><!-- End Hero -->

    <main id="main">


        <!-- ======= About Us Section ======= -->
        <section id="about-us" class="about-us">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Sobre Nosotros</strong></h2>
                </div>

                <div class="row content">
                    <div class="col-lg-6" data-aos="fade-right">

                        <center><p align="justify">
                                Bienvenido a una aventura emprendedora fácil y segura!!.
                                Bienvenido a la aplicación de la Tienda Virtual UTC!!
                                Fiel a sus principios de servicio y vinculación con el pueblo, la Universidad
                                Técnica de Cotopaxi y su Centro de Emprendimiento, presentan esta divertida y
                                útil aplicación en apoyo a la reactivación económica del centro del país

                            </p>
                        </center>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
                        <center><p align="justify">
                                Nuestro principio es fortalecer la vinculación de la universidad con el
                                pueblo, para aplacar y mejorar los efectos negativos generados por la emergencia
                                sanitaria a través del desarrollo productivo y comercial de nuestros emprendedores con
                                la generación de un aplicativo web y móvil.
                            </p>
                        </center>

                    </div>
                </div>

            </div>
        </section><!-- End About Us Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Categorías de Productos y Servicios </strong></h2>
                    <p>
                        En la app móvil podrás conseguir productos de estas categorías.
                    </p>
                </div>

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



                          {{--<div class="col-lg-4 col-md-5 d-flex align-items-stretch">
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

            </div>

        </section><!-- End Services Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>Encontraras Todo</h2>
                </div>

                <div class="row" data-aos="fade-up">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter=".filter-card">VARIEDAD DE PRODUCTOS Y SERVICIOS</li>

                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up">


                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('assets2/img/portfolio/alimentos2.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Empanadas</h4>

                            <a href="{{asset('assets2/img/portfolio/alimentos2.jpg')}}" data-gall="portfolioGallery"
                               class="venobox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('assets2/img/portfolio/alimentos4.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Salchipapas</h4>

                            <a href="{{asset('assets2/img/portfolio/alimentos4.jpg')}}" data-gall="portfolioGallery"
                               class="venobox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>

                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('assets2/img/portfolio/ali.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Tamales</h4>

                            <a href="{{asset('assets2/img/portfolio/ali.jpg')}}" data-gall="portfolioGallery"
                               class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>

                        </div>
                    </div>


                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('assets2/img/portfolio/ropa1.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Pantalones</h4>

                            <a href="{{asset('assets2/img/portfolio/ropa1.jpg')}}" data-gall="portfolioGallery"
                               class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('assets2/img/portfolio/accesorios.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Accesorios</h4>

                            <a href="{{asset('assets2/img/portfolio/accesorios.jpg')}}" data-gall="portfolioGallery"
                               class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('assets2/img/portfolio/ropa2.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Sacos</h4>

                            <a href="{{asset('assets2/img/portfolio/ropa2.jpg')}}" data-gall="portfolioGallery"
                               class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('assets2/img/portfolio/industrias2.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Emprendimientos</h4>

                            <a href="{{asset('assets2/img/portfolio/industrias2.jpg')}}" data-gall="portfolioGallery"
                               class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('assets2/img/portfolio/industrias.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Industrias</h4>

                            <a href="{{asset('assets2/img/portfolio/industrias.jpg')}}" data-gall="portfolioGallery"
                               class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('assets2/img/portfolio/industrias3.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Empresas</h4>

                            <a href="{{asset('assets2/img/portfolio/industrias3.jpg')}}" data-gall="portfolioGallery"
                               class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('assets2/img/portfolio/entregas.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Entregas Seguras</h4>

                            <a href="{{asset('assets2/img/portfolio/entregas.jpg')}}" data-gall="portfolioGallery"
                               class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img src="{{asset('assets2/img/portfolio/entregas2.jpg')}}" class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Entregas confiables</h4>

                            <a href="{{asset('assets2/img/portfolio/entregas2.jpg')}}" data-gall="portfolioGallery"
                               class="venobox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>

                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <img
                            src="{{asset('assets2/img/portfolio/La-importancia-del-servicio-de-entrega-a-domicilio.jpg')}}"
                            class="img-fluid" alt="">
                        <div class="portfolio-info">
                            <h4>Entregas puntuales</h4>

                            <a href="{{asset('assets2/img/portfolio/La-importancia-del-servicio-de-entrega-a-domicilio.jpg')}}"
                               data-gall="portfolioGallery" class="venobox preview-link" title="Card 3"><i
                                    class="bx bx-plus"></i></a>

                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Portfolio Section -->

        <!-- ======= Our Clients Section ======= -->
        <section id="clients" class="clients">

        </section><!-- End Our Clients Section -->
    </main>
@endsection
