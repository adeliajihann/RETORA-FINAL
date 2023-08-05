@extends('tutor.layout.main', ['title'=>'Daftar Tutor'])

@section('judul')
    <div class="pagetitle">
        <div class="text-center">
            @foreach($x as $t)
            <h1>Selamat Datang, {{$t->namaT}}!</h1><br>
            @endforeach
        </div>
    </div>
@endsection

@section('isi')

    <div class="row" style="justify-content: center">
        <div class="col-xxl-4 col-md-3">
            <div class="card info-card sales-card">
                <div class="card-body">
                    <h5 class="card-title">Murid Pending</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-hourglass"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $m_pending }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-3">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Murid Diterima</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $m_diterima }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-4 col-md-3">
            <div class="card info-card customers-card">
                <div class="card-body">
                    <h5 class="card-title">Murid Selesai</h5>
                    <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-clipboard-check"></i>
                        </div>
                        <div class="ps-3">
                            <h6>{{ $m_selesai }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section profile">
        <div class="container-fluid">
            <div class="row">
                @if ($totalRatings < 0)
                <div class="text-center" style="justify-content: center">
                    <img src="assets/img/rating dan ulasan.png" alt="" style="width: 30%">
                </div> 
                @endif
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-3">
                            <div class="card">
                                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                                    @foreach($tutorData as $data)
                                    @if ($data->foto == null)
                                    <img src="assets/img/profile.png" alt="Profile" class="rounded-circle" style="width: 120px; height: 120px;"> 
                                    @else 
                                    <img src="{{ asset('tutor/img/'.$data->foto) }}" alt="Profile" class="rounded-circle" style="width: 120px; height: 120px;">
                                    @endif
                                    <h5>{{$data->namaT}}</h5>
                                    @endforeach
                                    <div class="text-center">
                                        @foreach($ratings as $data)
                                            <label><i class="bi bi-star-fill text-warning"></i>{{ $data->average_rating }} ({{ $totalRatings }} votes)</label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body pt-3">
                                    <ul class="nav nav-tabs nav-tabs-bordered">
                                        <li class="nav-item">
                                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ulasan">Ulasan ({{ $totalRatings }})</button>
                                        </li>             
                                    </ul>
                                    <div class="tab-content pt-2">
                                        <div class="tab-pane fade show active ulasan" id="ulasan">
                                            @foreach ($ratingData as $data)
                                            <div class="row">
                                                <img src="{{ asset ('murid/img/'.$data->foto) }}" alt="Profile" class="rounded-circle" style="width: 78px; height: 50px;">
                                                <div class="col-md-8 col-lg-10">
                                                    <label for="nama" class="col-md-3 col-lg-10 col-form-label"><b>{{ $data->namaM }}</b> ({{$data->created_at}}) <i class="bi bi-star-fill" style="color: #FFDA43"></i>{{ $data->rating }}</label>
                                                    <textarea name="ulasan" class="form-control" id="ulasan" style="height: 50px" disabled>{{ $data->ulasan }}</textarea><br>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection