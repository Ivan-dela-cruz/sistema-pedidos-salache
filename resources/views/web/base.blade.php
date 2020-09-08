<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Tienda virtual UTC</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="" name="descriptison">
    <meta content="" name="keywords">


    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Favicons -->

    <link href="assets2/img/favicon.png" rel="icon">
    <link href="assets2/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Vendor CSS Files -->
    <link href="assets2/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets2/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="assets2/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets2/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets2/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="assets2/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="assets2/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets2/vendor/remixicon/remixicon.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets2/css/style.css" rel="stylesheet">

    <!-- =======================================================
    * Template Name: Company - v2.1.0
    * Template URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>

<body>

@include('web.header')



<!-- End #main -->
@yield('content')
<!-- ======= Footer ======= -->
 <!-- ======= Footer ======= -->
 <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>Tienda Virtual UTC</h3>
            <p>
              Av. Simón Rodríguez s/n Barrio El Ejido Sector San Felipe. <br>
              Latacunga - Ecuador.<br>
              <strong>Teléfono:</strong> 0998397454<br>
              <strong>Email:</strong>pablo.herrera0259@utc.edu.ec<br>
            </p>
          </div>



        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright <strong><span>Tienda Virtual UTC</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/company-free-html-bootstrap-template/ -->
          Designed by <a href="https://bootstrapmade.com/">Universidad Técnica de Cotopaxi</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">

        <a href="https://www.facebook.com/TiendavirtualUTC/" class="facebook"><i class="bx bxl-facebook"></i></a>

        <a href="{{ route('admin') }}" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer><!-- End Footer -->


<a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!-- Vendor JS Files -->
<script src="assets2/vendor/jquery/jquery.min.js"></script>
<script src="assets2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets2/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="assets2/vendor/php-email-form/validate.js"></script>
<script src="assets2/vendor/jquery-sticky/jquery.sticky.js"></script>
<script src="assets2/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets2/vendor/venobox/venobox.min.js"></script>
<script src="assets2/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="assets2/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="assets2/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="assets2/js/main.js"></script>

</body>

</html>
