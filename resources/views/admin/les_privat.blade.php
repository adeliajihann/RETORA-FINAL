@extends('admin.layout.main', ['title'=>'Les Privat'])

@section('isi')

  <div class="col-lg-15">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Les Privat</h5> 
          <table id="example" class="table table-borderless table-hover">
            <thead>
              <tr>
                <th style="text-align:center" scope="col">No</th>
                <th style="text-align:center" scope="col">Jangka Les</th>
                <th style="text-align:center" scope="col">Tutor</th>
                <th style="text-align:center" scope="col">Murid</th>
                <th style="text-align:center" scope="col">Mapel</th>
                <th style="text-align:center" scope="col">Pendidikan</th>
                <th style="text-align:center" scope="col">Status</th>
                <th style="text-align:center" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no=1; @endphp
              @foreach ($jadwal as $data)
              <tr>
                <th style="text-align:center">{{ $no++ }}</th>
                <td style="text-align:center">{{ $data->tgl_awal }} - {{ $data->tgl_akhir }}</td>
                <td style="text-align:center">{{ $data->namaT }}</td>
                <td style="text-align:center">{{ $data->namaM }}</td>
                <td style="text-align:center">{{ $data->mapel }}</td>
                <td style="text-align:center">{{ $data->pendidikan }}</td>
                <td style="text-align:center"><span class="badge rounded-pill bg-success">{{ $data->status }}</span></td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detail-les{{ $data->id }}"><i class="bi bi-eye"></i></button>
                    <div class="modal fade" id="detail-les{{ $data->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"><b>Detail Les Privat</b></h5>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Jenis Paket</div>
                                        <div class="col-lg-6 col-md-8">{{ $data->jenis_paket }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Kurikulum</div>
                                        <div class="col-lg-6 col-md-8">{{ $data->kurikulum }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Jadwal</div>
                                        <div class="col-lg-6 col-md-8">{{ $data->jadwal }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 label">Harga</div>
                                        <div class="col-lg-6 col-md-8">{{ $data->harga }}</div>
                                    </div>
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