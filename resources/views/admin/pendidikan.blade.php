@extends('admin.layout.main', ['title'=>'Pendidikan'])

@section('judul')
    <div class="pagetitle">
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah"><i class="bi bi-plus"></i> Tambah</button>
        <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Pendidikan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="tambah-pendidikan" method="POST" cenctype="multipart/form-data">
                        @csrf
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="pendidikan" class="form-label">Pendidikan</label>
                                    <input type="text" id="pendidikan" class="form-control
                                    @error('pendidikan')
                                    is-invalid
                                    @enderror" name="pendidikan" autofocus autocomplete="off">
                                    @error('pendidikan')
                                    <div class='invalid-feedback'>
                                        {{ $message }}
                                    </div>
                                @enderror
                                </div>
                                <div class="col-12">
                                    <label for="kelas" class="form-label">Kelas</label>
                                    <select name="kelas" id="kelas" class="form-select
                                    @error('kelas')
                                    is-invalid
                                    @enderror
                                    " id="kelas" placeholder="-- Pilih --"> 
                                        <option>-- Pilih --</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                    </select>
                                    @error('kelas')
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
        <h5 class="card-title">Pendidikan & Kelas</h5> 
            <table id="example" class="table table-borderless table-hover">
            <thead>
              <tr>
                <th style="text-align:center" scope="col">No</th>
                <th style="text-align:center" scope="col">Pendidikan</th>
                <th style="text-align:center" scope="col">Kelas</th>
                <th style="text-align:center" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp
              @foreach ($pendidikan as $data)
              <tr>
                <th style="text-align:center">{{ $no++ }}</th>
                <td style="text-align:center">{{ $data->pendidikan }}</td>
                <td style="text-align:center">{{ $data->kelas }}</td>
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
                          <a href="hapus/pendidikan/{{ $data->id }}"><button type="button" class="btn btn-danger btn-sm">Hapus</button></a>
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