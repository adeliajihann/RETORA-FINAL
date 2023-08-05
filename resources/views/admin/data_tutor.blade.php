@extends('admin.layout.main', ['title'=>'Data Tutor'])

@section('isi')

  <div class="col-lg-15">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Data Tutor</h5> 
          <table id="example" class="table table-borderless table-hover">
            <thead>
              <tr>
                <th style="text-align:center" scope="col">No</th>
                <th style="text-align:center" scope="col">Nama</th>
                <th style="text-align:center" scope="col">Alamat</th>
                <th style="text-align:center" scope="col">No HP</th>
                <th style="text-align:center" scope="col">Pendidikan</th>
                <th style="text-align:center" scope="col">Jenis Kelamin</th>
                <th style="text-align:center" scope="col">Berkas Ijazah</th>
                <th style="text-align:center" scope="col">Status</th>
                <th style="text-align:center" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp
              @foreach ($users as $data)
              <tr>
                <th style="text-align:center">{{ $no++ }}</th>
                <td style="text-align:center">{{ $data->namaT }}</td>
                <td style="text-align:center">{{ $data->alamat }}</td>
                <td style="text-align:center">{{ $data->no_hp }}</td>
                <td style="text-align:center">{{ $data->r_pendidikan }}</td>
                <td style="text-align:center">{{ $data->jk }}</td>
                <td style="text-align:center">
                  <a href="{{ asset('tutor/ijazah/'.$data->berkas_ijazah) }}" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i></a>
                </td>
                @if($data->status_akun == 'Daftar')
                <td style="text-align:center"><span class="badge rounded-pill bg-warning">{{ $data->status_akun }}</span></td>
                @elseif($data->status_akun == 'Acc')
                <td style="text-align:center"><span class="badge rounded-pill bg-success">{{ $data->status_akun }}</span></td>
                @else 
                <td style="text-align:center"><span class="badge rounded-pill bg-danger">{{ $data->status_akun }}</span></td>
                @endif
                <td style="text-align:center">
                  @if($data->status_akun == 'Acc')
                  {{-- <button type="button" class="btn btn-success btn-sm" disabled><i class="bi bi-check-circle"></i></button> --}}
                  @else 
                  <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#verifikasi{{ $data->idT }}"><i class="bi bi-check-circle"></i></button>
                  <div class="modal fade" id="verifikasi{{ $data->idT }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian!</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Apakah Anda yakin ingin verifikasi akun?</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                          <a href="verifikasi/{{ $data->idT }}"><button type="button" class="btn btn-success btn-sm">Verifikasi</button></a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endif
                  <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#block{{ $data->idT }}"><i class="bi bi-x-circle"></i></button>
                  <div class="modal fade" id="block{{ $data->idT }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel">Perhatian!</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Apakah Anda yakin ingin block akun?</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                          <a href="block/{{ $data->idT }}"><button type="button" class="btn btn-danger btn-sm">Block</button></a>
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