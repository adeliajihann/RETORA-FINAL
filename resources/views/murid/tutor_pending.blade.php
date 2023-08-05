@extends('murid.layout.main', ['title'=>'Daftar Tutor Pending'])

@section('judul')
    <div class="pagetitle">
        <h1>Daftar Tutor (Menunggu Konfirmasi)</h1>
    </div><br>
@endsection

@section('isi')

    <section class="section dashboard">
        <div class="row">
            @if ($tutor->isEmpty())
            <div class="text-center" style="justify-content: center">
                <img src="assets/img/not found.png" alt="" style="width: 30%">
            </div>
            @else 
            @foreach ($tutor as $data)
                <div class="card mb-3" style="max-width: 450px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if ($data->foto == null)
                            <img src="assets/img/profile.png" style="width: 100%" style="max-height: 300px;" class="img-fluid rounded-start" alt="..."> 
                            @else
                            <img src="{{ asset ('tutor/img/'.$data->foto) }}" style="width: 100%" style="max-height: 300px;" class="img-fluid rounded-start" alt="...">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $data->namaT }}</h5>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detail-tutor_{{ $data->id }}">Lihat</button>
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
                                </div>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#batal{{ $data->id }}"><i class="bi bi-x-circle-fill"></i> Batal</button>
                                <div class="modal fade" id="batal{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian!</h1>
                                        </div>
                                        <div class="modal-body">Apakah Anda yakin ingin membatalkan permintaan?</div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                                        <a href="batal/{{ $data->id }}"><button type="button" class="btn btn-danger btn-sm">Iya, batalkan</button></a>
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