@extends('murid.layout.main', ['title'=>'Daftar Tutor Selesai'])

@section('judul')
    <div class="pagetitle">
        <h1>Daftar Tutor (Selesai)</h1>
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
                <div class="card mb-3" style="max-width: 500px;">
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
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detail-tutor_{{ $data->tutor }}">Lihat</button>
                                <div class="modal fade" id="detail-tutor_{{ $data->tutor }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><b>Detail Profil Tutor</b></h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Deskripsi</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->deskripsi }}</div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Berkas Ijazah</div>
                                                    <div class="col-lg-6 col-md-8"><a href="{{ asset('tutor/ijazah/'.$data->berkas_ijazah) }}" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i></a></div>
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
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">No HP</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->no_hp }}</div>
                                                </div><br>
                                                <div class="col-lg-4 col-md-4 label"><b>Detail Les Privat</b></div><br>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Tanggal Awal</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->tgl_awal }}</div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Tanggal Akhir</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->tgl_akhir }}</div>
                                                </div> 
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
                                                    <div class="col-lg-4 col-md-4 label">Jadwal</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->jadwal }}</div>
                                                </div><br>
                                                @if($data->rating == null)
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Rating</div>
                                                    <div class="col-lg-6 col-md-8"><i class="bi bi-star-fill text-warning"></i> (belum ada)</div>
                                                </div>
                                                @else
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Rating</div>
                                                    <div class="col-lg-6 col-md-8"><i class="bi bi-star-fill text-warning"></i> {{ $data->rating }}</div>
                                                </div>
                                                @endif
                                                @if($data->ulasan == null)
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Ulasan</div>
                                                    <div class="col-lg-6 col-md-8">(belum ada)</div>
                                                </div>
                                                @else 
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Ulasan</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->ulasan }}</div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($data->id_detail != null)
                                <button type="button" class="btn btn-sm btn-primary" disabled><i class="bi bi-star-fill" style="color: yellow"></i> Rating dan Ulasan</button>
                                @else 
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#rate"><i class="bi bi-star-fill" style="color: yellow"></i> Rating dan Ulasan</button>
                                <div class="modal fade" id="rate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Rating & Ulasan</b></h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="murid-rating-selesai" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <input hidden type="text" name="t_id" id="t_id" class="form-control" value="{{ $data->tutor }}">
                                                <input hidden type="text" name="m_id" id="m_id" class="form-control" value="{{ $data->id_murid }}">
                                                <input hidden type="text" name="id_detail" id="id_detail" class="form-control" value="{{ $data->id }}">
                                                <input hidden type="text" name="les_id" id="les_id" class="form-control" value="{{ $data->id_les }}">
                                                <div class="col-12">
                                                    <div class="star-rating">
                                                        <input type="checkbox" name="rating" id="star5" value="5">
                                                        <label for="star5"></label>
                                                        <input type="checkbox" name="rating" id="star4" value="4">
                                                        <label for="star4"></label>
                                                        <input type="checkbox" name="rating" id="star3" value="3">
                                                        <label for="star3"></label>
                                                        <input type="checkbox" name="rating" id="star2" value="2">
                                                        <label for="star2"></label>
                                                        <input type="checkbox" name="rating" id="star1" value="1">
                                                        <label for="star1"></label>
                                                    </div>
                                                </div>
                                                <div class="col-12"><br>
                                                    <label for="ulasan" class="form-label">Ulasan</label>
                                                    <textarea type="text" rows="3" id="ulasan" name="ulasan" class="form-control
                                                    @error('ulasan')
                                                    is-invalid
                                                    @enderror
                                                    " id="ulasan" name="ulasan">{{ $data->ulasan }}</textarea>
                                                    @error('ulasan')
                                                        <div class='invalid-feedback'>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div><br>
                                                <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>&nbsp;&nbsp;&nbsp;
            @endforeach
            @endif
        </div>
    </section>
    
@endsection