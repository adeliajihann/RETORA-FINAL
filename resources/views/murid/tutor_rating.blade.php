@extends('murid.layout.main', ['title'=>'Rating & Ulasan'])

@section('judul')
    <div class="pagetitle">
        <h1><a href="{{ route('murid.home') }}"><i class="bi bi-arrow-left-circle-fill"></i></a> Detail Rating & Ulasan</h1>
    </div><br>
@endsection

@section('isi')

    <section class="section profile">
        <div class="row">
            @empty($ratingData)
            <div class="text-center" style="justify-content: center">
                <img src="assets/img/not found.png" alt="" style="width: 30%">
            </div>
            @else 
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
                                    <label><i class="bi bi-star-fill text-warning"></i>{{ $hasil_rating }} ({{ $totalRatings }} votes)</label>
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
            @endempty
        </div>
    </section>

@endsection