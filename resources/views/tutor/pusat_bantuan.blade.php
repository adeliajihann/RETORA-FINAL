@extends('tutor.layout.main', ['title'=>'Pusat Bantuan'])

@section('judul')
    <div class="pagetitle">
        <h1 style="text-align: center">Pusat Bantuan RETORA</h1>
    </div><br>
@endsection

@section('isi')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
            <h5 class="card-title"><i class="bi bi-question-circle"></i> Pusat Bantuan</h5>

            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#nol" aria-expanded="false" aria-controls="nol">
                        Apa saja Syarat dan Ketentuan Daftar Tutor?
                        </button>
                    </h2>
                    <div id="nol" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">
                            1. Menyediakan informasi data diri yang lengkap dan akurat <br>
                            2. Memiliki dan upload ijazah <b>minimal</b> SMA/sederajat <br>
                            3. Memiliki kemampuan mengajar <br>
                            4. Memiliki kode etik mengajar <br>
                            5. Domisili Kota Cilacap <br>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#satu" aria-expanded="false" aria-controls="satu">
                        Mengapa akun saya dibatasi?
                        </button>
                    </h2>
                    <div id="satu" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">Karena akun Anda masih dalam proses verifikasi Admin. Jika akun Anda telah disetujui, status akun akan berubah menjadi 'Tervirifikasi' dan Anda bisa mengakses fitur yang lain. 
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dua" aria-expanded="false" aria-controls="dua">
                        Mengapa akun saya belum diverifikasi?
                        </button>
                    </h2>
                    <div id="dua" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">
                            1. Data diri profil Anda belum lengkap (terutama <b>ijazah</b> pendidikan terakhir). Pastikan data telah lengkap. <br>
                            2. Nilai rata-rata dan berkas ijazah pendidikan yang di upload tidak sesuai. Silahkan cek kembali. <br>
                            3. Proses verifikasi akun membutuhkan waktu 1x24 jam kerja. Mohon untuk ditunggu. <br><br>
                            Jika akun Anda belum diverifikasi setelah memenuhi kondisi di atas, silahkan untuk melakukan pengaduan <a href="layanan-pengaduan"><b>di sini</b></a> untuk ditindaklanjuti.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#tiga" aria-expanded="false" aria-controls="tiga">
                        Bagaimana cara agar akun saya diverifikasi?
                        </button>
                    </h2>
                    <div id="tiga" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">
                            1. Lengkapi data diri profil Anda <br>
                            2. Upload nilai rata-rata dan berkas ijazah pendidikan terakhir yang sesuai (hal ini dipantau oleh Admin)
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#empat" aria-expanded="false" aria-controls="empat">
                        Mengapa harus mencantumkan nilai ijazah?
                        </button>
                    </h2>
                    <div id="empat" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">
                            1. Sebagai salah satu kriteria verifikasi keahlian dan kualifikasi tutor <br>
                            2. Dapat membantu membangun kepercayaan murid terhadap kemampuan tutor <br>
                            3. Dapat meningkatkan peluang tutor untuk menarik murid
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection