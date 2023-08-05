@extends('tutor.layout.main', ['title'=>'Jadwal Les'])

@section('judul')
    <div class="pagetitle">
        @foreach ($x as $s)
          @if($s->status_akun == 'Acc')
          <a href="tutor-tambah-mapel" class="btn btn-primary btn-sm" style="float: right;"><i class="bi bi-plus-circle"></i &nbsp> Tambah</a>
          @else 
          <button type="button" class="btn btn-primary btn-sm" disabled style="float: right;"><i class="bi bi-plus-circle"></i &nbsp> Tambah</button>
          @endif
        @endforeach
    </div><br>
@endsection

@section('isi')

<div class="col-lg-15">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Jadwal Les</h5> 
          <table id="example" class="table table-borderless table-hover table-sm">
            <thead>
              <tr>
                <th style="text-align:center" scope="col">No</th>
                <th style="text-align:center" scope="col">Paket</th>
                <th style="text-align:center" scope="col">Kurikulum</th>
                <th style="text-align:center" scope="col">Pendidikan</th>
                <th style="text-align:center" scope="col">Kelas</th>
                <th style="text-align:center" scope="col">Mapel</th>
                <th style="text-align:center" scope="col">Harga</th>
                <th style="text-align:center" scope="col">Jadwal</th>
                <th style="text-align:center" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp
              @foreach ($mapel as $data)
              <tr>
                <th style="text-align:center">{{ $no++ }}</th>
                <td style="text-align:center">{{ $data->jenis_paket }}</td>
                <td style="text-align:center">{{ $data->kurikulum }}</td>
                <td style="text-align:center">{{ $data->pendidikan }}</td>
                <td style="text-align:center">{{ $data->kelas }}</td>
                <td style="text-align:center">{{ $data->mapel }}</td>
                <td style="text-align:center">{{ $data->harga }}</td>
                <td style="text-align:center">{{ $data->jadwal }}</td>
                <td style="text-align:center">
                  @if ($data->status_paket == 'Sembunyikan')
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#publikasi{{ $data->id }}"><i class="bi bi-send"></i></i></button>
                  <div class="modal fade" id="publikasi{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian!</h1>
                          </div>
                          <div class="modal-body">Apakah Anda yakin ingin publikasikan les?</div>
                          <div class="modal-footer">
                          <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                          <a href="publikasi/{{ $data->id }}"><button type="button" class="btn btn-primary btn-sm">Iya</button></a>
                          </div>
                      </div>
                      </div>
                  </div> 
                  @else 
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#sembunyi{{ $data->id }}"><i class="bi bi-send-exclamation"></i></button>
                  <div class="modal fade" id="sembunyi{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian!</h1>
                          </div>
                          <div class="modal-body">Apakah Anda yakin ingin sembunyikan les?</div>
                          <div class="modal-footer">
                          <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Tutup</button>
                          <a href="sembunyikan/{{ $data->id }}"><button type="button" class="btn btn-danger btn-sm">Iya</button></a>
                          </div>
                      </div>
                      </div>
                  </div> 
                  @endif
                  <a href="ubah-mapel/{{ $data->id }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square" ></i></a>  
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
      </div>
    </div>
  </div>

@endsection