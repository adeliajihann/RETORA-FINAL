<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>RETORA</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/retora2.png" rel="icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor2/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor2/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor2/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor2/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor2/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor2/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor2/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style2.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Vesperr - v4.9.1
  * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <img src="assets/img/retora2.png" alt="" style="width: 120%">
        {{-- <h1 style="color: #291958">RETORA</h1> --}}
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang Kami</a></li>
          <li><a class="nav-link scrollto" href="#features">Fitur</a></li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Selamat Datang!</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Jasa tutor les privat untuk anak tingkat akhir di SD, SMP, SMA/SMK di Cilacap</h2>
          <div data-aos="fade-up" data-aos-delay="800">
            <a href="{{ route("login") }}" class="btn-get-started scrollto">Login</a>
            <a href="{{ route("role") }}" class="btn-get-started scrollto">Daftar Akun</a>
            <a href="{{ route("cari.tutor") }}" class="btn-get-started scrollto"><i class="bi bi-search"></i> Cari Tutor</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
          <img src="assets/img/logoretora.jpg" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    @include('sweetalert::alert')

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Tentang Kami</h2>
        </div>

        <div class="row content">
          <p style="text-align: center">
            RETORA merupakan E-Marketplace Jasa Les Privat (offline) sebagai tempat penghubung murid dengan tutor dari berbagai mata pelajaran. Untuk saat ini, website akan khusus digunakan untuk murid dan tutor di Kota Cilacap.
          </p>
          <div class="card-body">
            <div class="row">
              <img src="assets/img/1.png" alt="" style="width: 25%">
              <img src="assets/img/2.png" alt="" style="width: 25%">
              <img src="assets/img/3.png" alt="" style="width: 25%">
              <img src="assets/img/rating.png" alt="" style="width: 25%">
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Features Section ======= -->
    <section id="features" class="features">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Fitur Utama</h2>
          <p>Beberapa fitur utama yang tersedia di RETORA</p>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="300" style="justify-content: center">
          <div class="col-lg-3 col-md-4 mt-4 mt-md-0">
            <div class="icon-box" style="justify-content: center">
              <i class="bi bi-search" style="color: #e80368;"></i>
              <h3><a href="">Pencarian Tutor</a></h3>
            </div>
          </div>
          <div class="col-lg-3 col-md-4">
            <div class="icon-box" style="justify-content: center">
              <i class="bi bi-star-fill" style="color: #ffbb2c;"></i>
              <h3><a href="">Rating dan Ulasan</a></h3>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Features Section -->

      </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="copyright" style="text-align: center">
          &copy; Adhelia Jihan Athaya
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor2/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor2/aos/aos.js"></script>
  <script src="assets/vendor2/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor2/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor2/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor2/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor2/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main2.js"></script>

</body>

</html>