@extends('murid.layout.main', ['title'=>'RPS'])

@section('judul')
    <div class="pagetitle">
        <h1>Rencana Pembelajaran Semester</h1>
    </div><br>
@endsection

@section('isi')

    <section class="section dashboard">
        <div class="row">
            @if ($tutor->isEmpty())
            <div class="text-center">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-octagon me-1"></i>Belum ada data
                </div>
            </div>
            @else 
            @foreach ($tutor as $data)
                <div class="card mb-2" style="max-width: 500px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset ('tutor/img/'.$data->foto) }}" style="width: 100%" style="max-height: 300px;" class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $data->namaT }}</h5>
                                <p class="card-text">{{ $data->mapel }}&nbsp;({{ $data->pendidikan }})</p>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#lihat-rps{{ $data->id }}"><i class="bi bi-eye"></i> Lihat RPS</button>
                                <div class="modal fade" id="lihat-rps{{ $data->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="labelmodal"><b>Lihat RPS</b></h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <textarea name="rps" id="rps" class="form-control" name="rps" rows="10" readonly>{{ $data->rps }}</textarea>
                                                    </div><br> 
                                                </div><br>
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