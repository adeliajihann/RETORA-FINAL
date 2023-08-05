@extends('tutor.layout.main', ['title'=>'Daftar Murid Pending'])

@section('judul')
    <div class="pagetitle">
        <h1>Daftar Murid (Menunggu Konfirmasi)</h1>
    </div><br>
@endsection

@section('isi')

    <section class="section dashboard">
        <div class="row">
            @if ($murid->isEmpty())
            <div class="text-center" style="justify-content: center">
                <img src="assets/img/not found.png" alt="" style="width: 30%">
            </div>
            @else 
            @foreach ($murid as $data)
                <div class="card mb-3" style="max-width: 500px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                        @if ($data->foto == null)
                        <img src="assets/img/profile.png" style="width: 100%" style="max-height: 300px;" class="img-fluid rounded-start" alt="..."> 
                        @else
                        <img src="{{ asset ('murid/img/'.$data->foto) }}" style="width: 100%" style="max-height: 300px;" class="img-fluid rounded-start" alt="...">
                        @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $data->namaM }}</h5>
                                <p class="card-text">{{ $data->deskripsi }}</p>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detail-murid{{ $data->id }}"><i class="bi bi-eye-fill"></i></button>
                                <div class="modal fade" id="detail-murid{{ $data->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><b>Detail Profil Murid</b></h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Nama</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->namaM }}</div>
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
                                                    <div class="col-lg-4 col-md-4 label">Kurikulum</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->kurikulum }}</div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Alamat</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->alamat }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">No HP</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->no_hp }}</div>
                                                </div><br>
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
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Harga</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->harga }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Jadwal</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->jadwal }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#acc{{ $data->id }}"><i class="bi bi-check-circle-fill"></i> Terima</button>
                                <div class="modal fade" id="acc{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">Apakah Anda yakin ingin terima permintaan?</div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Batal</button>
                                        <a href="acc/{{ $data->id }}"><button type="button" class="btn btn-primary btn-sm">Terima</button></a>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#tolak{{ $data->id }}"><i class="bi bi-x-circle-fill"></i> Tolak</button>
                                <div class="modal fade" id="tolak{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian!</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">Apakah Anda yakin ingin tolak permintaan?
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Batal</button>
                                        <a href="tolak/{{ $data->id }}"><button type="button" class="btn btn-danger btn-sm">Iya, tolak</button></a>
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
