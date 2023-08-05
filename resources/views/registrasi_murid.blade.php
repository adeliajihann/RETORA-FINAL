<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Halaman Registrasi Murid</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/retora2.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  
  <main style="background-image: url('http://127.0.0.1:8000/assets/img/wallpaper.png');">
    @include('sweetalert::alert')
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Daftar Akun Murid</h5>
                  </div>

                  <form action="register-murid" method="POST" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-12">
                      <label for="namaM" class="form-label">Nama</label><span class="text-danger">*</span>
                      <div class="input-group has-validation">
                        <input type="text" class="form-control
                        @error('namaM')
                        is-invalid
                        @enderror
                        " name="namaM" id="namaM" placeholder="Masukkan nama anda" value="{{ old('namaM') }}" required autofocus>
                        <div class="input-group-append"></div>
                        @error('namaM')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="email" class="form-label">Email</label><span class="text-danger">*</span>
                      <div class="input-group has-validation">
                        <input type="text" class="form-control
                        @error('email')
                        is-invalid
                        @enderror
                        " name="email" id="email" placeholder="Masukkan email anda" value="{{ old('email') }}" required>
                        <div class="input-group-append"></div>
                        @error('email')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="username" class="form-label">Username</label><span class="text-danger">*</span>
                      <div class="input-group has-validation">
                        <input type="text" class="form-control
                        @error('username')
                        is-invalid
                        @enderror
                        " name="username" id="username" placeholder="Masukkan username anda" value="{{ old('username') }}" required>
                        <div class="input-group-append"></div>
                        @error('username')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="password">Password</label><span class="text-danger">*</span>
                      <input id="password" type="password" name="password" class="form-control
                      @error('password')
                      is-invalid
                      @enderror
                      " placeholder="Masukan Password" value="{{ old('password') }}" required>
                      @error('password')
                      <div class='invalid-feedback'>
                      {{ $message }}
                      </div>
                      @enderror
                      <input type="checkbox" onclick="togglePasswordVisibility()"> Lihat Password
                    </div>
                    <input hidden type="text" name="role" id="role" class="form-control" value="murid">

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Daftar</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Sudah punya akun? <a href="login">Login</a></p>
                    </div>
                  </form>
                  <script>
                    function togglePasswordVisibility() {
                        var passwordInput = document.getElementById("password");
                        if (passwordInput.type === "password") {
                            passwordInput.type = "text";
                        } else {
                            passwordInput.type = "password";
                        }
                    }
                  </script>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>