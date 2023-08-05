@extends('admin.layout.main', ['title'=>'Pengaduan Murid'])

@section('isi')

  <div class="col-lg-15">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Pengaduan Murid</h5> 
          <table id="example" class="table table-borderless table-hover">
            <thead>
              <tr>
                <th style="text-align:center" scope="col">No</th>
                <th style="text-align:center" scope="col">Nama</th>
                <th style="text-align:center" scope="col">Status</th>
                <th style="text-align:center" scope="col">Respon</th>
                <th style="text-align:center" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp
            @foreach($pengaduan as $data)
              <tr>
                <th style="text-align:center">{{ $no++ }}</th>
                <td style="text-align:center">{{ $data->namaM }}</td>
                @if($data->status_respon == 'menunggu')
                <td style="text-align:center"><span class="badge rounded-pill bg-warning">{{ $data->status_respon }}</span></td>
                @else 
                <td style="text-align:center"><span class="badge rounded-pill bg-success">{{ $data->status_respon }}</span></td>
                @endif
                <td style="text-align:center">
                  <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#respon{{ $data->id }}"><i class="bi bi-plus-circle"></i></button>
                  <div class="modal fade" id="respon{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Respon</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="respon/pengaduan/murid/{{ $data->id }}" method="POST" cenctype="multipart/form-data">
                              @csrf
                              <div class="row g-3">
                                  <div class="col-12">
                                      <textarea name="respon" id="respon" class="form-control
                                      @error('respon')
                                      is-invalid
                                      @enderror" name="respon" rows="10">{{ $data->respon }}</textarea>
                                      @error('respon')
                                          <div class='invalid-feedback'>
                                              {{ $message }}
                                          </div>
                                      @enderror
                                  </div><br> 
                              </div><br>
                              <button type="submit" class="btn btn-primary btn-sm" style="float: right;">Simpan</button>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
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
                                  <a href="hapus/pengaduan/murid/{{ $data->id }}"><button type="button" class="btn btn-danger btn-sm">Hapus</button></a>
                              </div>
                          </div>
                      </div>
                  </div>
                </td>
              </tr>
            </tbody>
            @endforeach
          </table>
      </div>
    </div>
  </div>
  
@endsection