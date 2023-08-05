@extends('admin.layout.main', ['title'=>'Mata Pelajaran'])

@section('judul')
    <div class="pagetitle">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi bi-plus"></i> Tambah</button>
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Mata Pelajaran</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="tambah-mapel" method="POST" cenctype="multipart/form-data">
                        @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="mapel" class="form-label">Mata Pelajaran</label>
                                    <input type="text" id="mapel" class="form-control
                                    @error('mapel')
                                    is-invalid
                                    @enderror" name="mapel" autofocus autocomplete="off">
                                    @error('mapel')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div><br>
                            <button type="submit" class="btn btn-primary btn-sm" style="float: right;">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
@endsection

@section('isi')
<div class="col-lg-15">
    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Mata Pelajaran</h5> 
            <table id="example" class="table table-borderless table-hover">
            <thead>
              <tr>
                <th style="text-align:center" scope="col">No</th>
                <th style="text-align:center" scope="col">Mata Pelajaran</th>
                <th style="text-align:center" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp
              @foreach ($mapel as $data)
              <tr>
                <th style="text-align:center">{{ $no++ }}</th>
                <td style="text-align:center">{{ $data->mapel }}</td>
                <td style="text-align:center">
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus{{ $data->id }}"><i class="bi bi-trash"></i></button>
                  <div class="modal fade" id="hapus{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian!</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Apakah Anda yakin ingin hapus?</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                          <a href="hapus/mapel/{{ $data->id }}"><button type="button" class="btn btn-danger btn-sm">Hapus</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
    </div>
</div>

@endsection