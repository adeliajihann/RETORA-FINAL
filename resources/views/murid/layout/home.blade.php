@extends('murid.layout.main', ['title'=>'Daftar Tutor'])

@section('judul')
    <div class="pagetitle">
        <div class="text-center">
            @foreach($x as $m)
            <h1>Selamat Datang, {{$m->namaM}}!</h1>
            <h5>Mau belajar apa nih? Cari aja ya~<h5>
            @endforeach
        </div>
    </div>
@endsection

@section('isi')
    
    <div class="container-fluid">
        <a href="murid-home" type="button" class="btn btn-primary btn-sm"><i class="bi bi-arrow-clockwise"></i> Refresh</a>
        <div class="card">
            <div class="card-body"><br>
                <form action="{{ route('murid.home') }}" method="get" enctype="multipart/form-data">
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
                </div>
            </form>
            </div>
        </div>
    </div>

    <section class="section dashboard">
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
                        <a href="murid-detail-rating/{{ $data->id_tutor }}" type="button" class="btn btn-sm btn-primary rounded-pill">Lihat Ulasan</a>
                        </div>
                        <button type="button" class="btn btn-sm rounded-pill" style="background-color: #BEA6EE" data-bs-toggle="modal" data-bs-target="#permintaan{{ $data->id }}"><i class="bi bi-send-fill"></i> Kirim Permintaan</button>
                        <div class="modal fade" id="permintaan{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="permintaan" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="labelmodal"><b>Kirim Permintaan</b></h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="req-tutor" method="POST" cenctype="multipart/form-data">
                                            @csrf
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <input hidden type="text" name="id_userT" id="id_userT" class="form-control" value="{{ $data->id_user }}" readonly>
                                                    <input hidden type="text" name="id_les" id="id_les" class="form-control" value="{{ $data->id }}" readonly>
                                                    <input hidden type="text" name="tutor" id="tutor" class="form-control" value="{{ $data->idT }}" readonly>
                                                    @foreach ($murid as $data)
                                                    <input hidden type="text" name="id_murid" id="id_murid" class="form-control" value="{{ $data->idM }}" readonly>
                                                    @endforeach
                                                    <input hidden type="text" name="tgl_awal" id="tgl_awal" class="form-control" value="{{ date("d/m/Y") }}" readonly>
                                                </div> 
                                            </div>
                                            <span>Apakah Anda yakin ingin mengirim permintaan?</span><br><br>
                                            <button type="submit" class="btn btn-primary btn-sm" style="float: right;">Kirim</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>&nbsp;&nbsp;&nbsp;
            @endforeach
            @endif
        </div>
    </section>

@endsection