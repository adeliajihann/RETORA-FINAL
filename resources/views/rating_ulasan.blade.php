<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Rating dan Ulasan</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/retora2.png')}}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet"> --}}
  {{-- <link href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"rel="stylesheet"> --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"rel="stylesheet">
  <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css"rel="stylesheet">
  <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap4.min.css"rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body><br>
    
    <section class="section profile">
        <div class="container-fluid">
            <div class="row">
                <a href="{{ route("cari.tutor") }}"><i class="bi bi-arrow-left-circle-fill"></i></a>
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @foreach($tutorData as $data)
                            @if ($data->foto == null)
                            <img src="assets/img/profile.png" alt="Profile" class="rounded-circle" style="width: 120px; height: 120px;"> 
                            @else 
                            <img src="{{ asset('tutor/img/'.$data->foto) }}" alt="Profile" class="rounded-circle" style="width: 120px; height: 120px;">
                            @endif
                            <h5>{{$data->namaT}}</h5>
                            @endforeach
                            <div class="text-center">
                                <label><i class="bi bi-star-fill text-warning"></i>{{ $hasil_rating }} ({{ $totalRatings }} votes)</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="card">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ulasan">Ulasan ({{ $totalRatings }})</button>
                                </li>             
                            </ul>
                            <div class="tab-content pt-2">
                                <div class="tab-pane fade show active ulasan" id="ulasan">
                                    @foreach ($ratingData as $data)
                                    <div class="row">
                                        <img src="{{ asset ('murid/img/'.$data->foto) }}" alt="Profile" class="rounded-circle" style="width: 78px; height: 50px;">
                                        <div class="col-md-8 col-lg-10">
                                            <label for="nama" class="col-md-3 col-lg-10 col-form-label"><b>{{ $data->namaM }}</b> ({{ $data->created_at }}) <i class="bi bi-star-fill" style="color: #FFDA43"></i>{{ $data->rating }}</label>
                                            <textarea name="ulasan" class="form-control" id="ulasan" style="height: 50px" disabled>{{ $data->ulasan }}</textarea><br>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/chart.js/chart.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
    @stack('scripts')
    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js')}}"></script>

</body>

</html>