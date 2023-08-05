@extends('admin.layout.main', ['title'=>'Data Murid'])

@section('isi')

  <div class="col-lg-15">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Data Murid</h5> 
          <table id="example" class="table table-borderless table-hover">
            <thead>
              <tr>
                <th style="text-align:center" scope="col">No</th>
                <th style="text-align:center" scope="col">Nama</th>
                <th style="text-align:center" scope="col">Alamat</th>
                <th style="text-align:center" scope="col">No HP</th>
                <th style="text-align:center" scope="col">Pendidikan</th>
                <th style="text-align:center" scope="col">Jenis Kelamin</th>
                <th style="text-align:center" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp
              @foreach ($users as $data)
              <tr>
                <th style="text-align:center">{{ $no++ }}</th>
                <td style="text-align:center">{{ $data->namaM }}</td>
                <td style="text-align:center">{{ $data->alamat }}</td>
                <td style="text-align:center">{{ $data->no_hp }}</td>
                <td style="text-align:center">{{ $data->r_pendidikan }}</td>
                <td style="text-align:center">{{ $data->jk }}</td>
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
                          <a href="hapus/akun/murid/{{ $data->id }}"><button type="button" class="btn btn-danger btn-sm">Hapus</button></a>
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