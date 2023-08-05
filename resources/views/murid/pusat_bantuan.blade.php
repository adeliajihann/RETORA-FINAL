@extends('murid.layout.main', ['title'=>'Pusat Bantuan'])

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
                        Mengapa daftar tutor yang tersedia tidak banyak?
                        </button>
                    </h2>
                    <div id="nol" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">
                            RETORA merupakan sistem yang baru-baru ini dikembangkan. Karena masih dalam tahap awal, kemungkinan jumlah pengguna saat ini masih terbatas. Namun, kami berkomitmen untuk terus mengembangkan dan memperbaiki sistem ini agar dapat memberikan pengalaman terbaik kepada pengguna kami. Kami menghargai dukungan dan partisipasi dari setiap pengguna, dan kami berharap bahwa sistem ini akan terus berkembang seiring berjalannya waktu.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#satu" aria-expanded="false" aria-controls="satu">
                        Bagaimana cara mengajukan les privat kepada tutor?
                        </button>
                    </h2>
                    <div id="satu" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">
                            1. Masuk ke halaman 'Daftar Tutor' <br>
                            2. Masukkan kriteria tutor yang diinginkan <br>
                            2. Klik 'Cari Tutor' <br>
                            2. Jika tutor sudah muncul, lalu klik 'Kirim Permintaan' dan kirim <br>
                            2. Selesai, dan mohon ditunggu tanggapan dari tutor tersebut. <br>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#dua" aria-expanded="false" aria-controls="dua">
                        Mengapa saya tidak bisa melihat no handphone tutor?
                        </button>
                    </h2>
                    <div id="dua" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample" style="">
                        <div class="accordion-body">
                            Ketika permintaan les dari murid belum diterima, no handphone tutor tidak akan terlihat karena kami mengutamakan privasi dan keamanan bagi para pengguna kami. Kami memahami pentingnya menjaga informasi pribadi tutor, dan dengan tidak menampilkan no handphone sampai permintaan les diterima, kami ingin memastikan bahwa tutor merasa aman dan nyaman menggunakan platform kami. Setelah permintaan les diterima, no handphone tutor akan menjadi tersedia bagi murid yang terlibat dalam interaksi les. Transparansi dan keamanan adalah hal yang penting bagi kami, dan kami berusaha untuk memberikan pengalaman terbaik bagi semua pengguna RETORA.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection