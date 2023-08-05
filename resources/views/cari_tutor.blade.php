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
    
    <div class="text-center"><br><a href="/" class="btn btn-sm" style="background-color: #D4C6F0"><i class="bi bi-arrow-left-circle"></i> Halaman Utama</a></div>
    <br>
    <form action="{{ route("cari.tutor") }}" method="GET" enctype="multipart/form-data">
    @csrf
    <div class="row g-2" style="justify-content: center">
        <div class="col-md-3">
            <select name="mapel" id="mapel" class="form-select">
                <option>Pilih Mapel</option>
                @foreach ($mapel as $data)
                    <option value="{{ $data->mapel }}">{{ $data->mapel }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <select name="pendidikan" id="pendidikan" class="form-select">
                <option>Pilih Pendidikan</option>
                <option value="SD">SD</option>
                <option value="SMP">SMP</option>
                <option value="SMA/sederajat">SMA/sederajat</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="kelas" id="kelas" class="form-select" id="kelas"> 
                <option>Pilih Kelas</option>
                @foreach ($pendidikan as $data)
                    <option value="{{ $data->kelas }}">{{ $data->kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="row g-2" style="justify-content: center">
            <div class="col-md-3">
                <select name="jenis_paket" id="jenis_paket" class="form-select">
                    <option>Pilih Jenis Paket</option>
                    <option value="Paket Pagi">Paket Pagi</option>
                    <option value="Paket Siang">Paket Siang</option>
                    <option value="Paket Sore">Paket Sore</option>
                    <option value="Paket Malam">Paket Malam</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="kurikulum" id="kurikulum" class="form-select">
                    <option>Pilih Kurikulum</option>
                    <option value="2013">2013</option>
                    <option value="Merdeka">Merdeka</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-search"></i> Cari Tutor</button>
            </div>
        </div>
    </div><br>
    </form>

    <div class="row" style="justify-content: center">
        @if ($tutor->isEmpty())
        <div class="text-center" style="justify-content: center">
            <img src="assets/img/tutor not found.png" alt="" style="width: 30%">
        </div>
        @else 
        @foreach ($tutor as $data)
        <div class="card mb-5" style="max-width: 350px;"><br>
            @if ($data->foto == null)
            <img src="assets/img/profile.png" class="card-img-top mx-auto" class="img-fluid rounded-start" style="width: 60%" alt="...">
            @else
            <img src="{{ asset ('tutor/img/'.$data->foto) }}" class="card-img-top mx-auto" style="width: 50%" class="img-fluid rounded-start" alt="Profile">
            @endif
            <div class="col-md-15">
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center">{{ $data->namaT }}</h5>
                    <div class="text-center">
                        <span style="font-size: 17px">Rp.{{ $data->harga }} / pertemuan</span><br>
                        <span style="font-size: 17px">{{ $data->jadwal }}</span><br>
                    </div>
                    <div class="d-grid gap-2 mt-3">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-primary btn-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#detail-tutor_{{ $data->id }}">Lihat Detail</button>
                        <div class="modal fade" id="detail-tutor_{{ $data->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title"><b>Detail Profil Tutor</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Deskripsi</div>
                                        <div class="col-lg-8 col-md-8">{{ $data->deskripsi }}</div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Berkas Ijazah</div>
                                        <div class="col-lg-8 col-md-8"><a href="{{ asset('tutor/ijazah/'.$data->berkas_ijazah) }}" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i></a></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Nama</div>
                                        <div class="col-lg-6 col-md-8">{{ $data->namaT }}</div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Jenis Kelamin</div>
                                        <div class="col-lg-6 col-md-8">{{ $data->jk }}</div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Riwayat Pendidikan</div>
                                        <div class="col-lg-6 col-md-8">{{ $data->r_pendidikan }}</div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Alamat</div>
                                        <div class="col-lg-6 col-md-8">{{ $data->alamat }}</div>
                                    </div>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-info-circle"></i>
                                        No HP akan muncul saat permintaan telah diterima
                                    </div>
                                    <div class="col-lg-4 col-md-4 label"><b>Detail Les Privat</b></div><br>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Jenis Paket</div>
                                        <div class="col-lg-6 col-md-8">{{ $data->jenis_paket }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Kurikulum</div>
                                        <div class="col-lg-6 col-md-8">{{ $data->kurikulum }}</div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Pendidikan</div>
                                        <div class="col-lg-6 col-md-8">{{ $data->pendidikan }}</div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Mata Pelajaran</div>
                                        <div class="col-lg-6 col-md-8">{{ $data->mapel }}</div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Kelas</div>
                                        <div class="col-lg-6 col-md-8">{{ $data->kelas }}</div>
                                    </div><br>
                                    <div class="label" style="text-align: center">Rencana Pembelajaran Semester</div>
                                    <textarea name="rps" id="rps" class="form-control" name="rps" rows="10" disabled>{{ $data->rps }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>&nbsp;
                    <a href="{{ route('rating', ['id' => $data->id_tutor]) }}" type="button" class="btn btn-sm btn-primary rounded-pill">Lihat Ulasan</a>
                    </div>
                    <a href="login" type="button" class="btn btn-sm rounded-pill" style="background-color: #BEA6EE"><i class="bi bi-send-fill"></i> Kirim Permintaan</a>
                </div>
                </div>
            </div>
        </div>&nbsp;&nbsp;&nbsp;
        @endforeach
        @endif
    </div>

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