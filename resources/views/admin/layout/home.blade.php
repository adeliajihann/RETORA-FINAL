@extends('admin.layout.main', ['title'=>'Dashboard Admin'])

@section('judul')
<div class="pagetitle">
    <h1>Dashboard</h1><br>
</div><!-- End Page Title -->
@endsection

@section('isi')

    <div class="row">
        <div class="col-xxl-4 col-md-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Data Murid</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $dt_murid }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-3">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Data Pendidikan</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $dt_pendidikan }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-3">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Data Mapel</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-book"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $dt_mapel }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-3">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Data Les Privat</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-card-list"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $dt_les }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-3">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Data Tutor <span class="badge rounded-pill bg-warning" style="color: white">Daftar</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $dt_tutor_daftar }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-3">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Data Tutor <span class="badge rounded-pill bg-success" style="color: white">Acc</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $dt_tutor_acc }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-3">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Data Tutor <span class="badge rounded-pill bg-danger" style="color: white">Block</span></h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $dt_tutor_block }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection