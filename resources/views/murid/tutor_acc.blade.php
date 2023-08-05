@extends('murid.layout.main', ['title'=>'Daftar Tutor'])

@section('judul')
    <div class="pagetitle">
        <h1 >Daftar Tutor (Diterima)</h1>
    </div><br>
@endsection

@section('isi')

    <section class="section dashboard">
        <div class="row">
            @if ($tutor->isEmpty())
            <div class="text-center" style="justify-content: center">
                <img src="assets/img/not found.png" alt="" style="width: 30%">
            </div>
            @else 
            @foreach ($tutor as $data)
                <div class="card mb-3" style="max-width: 500px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            @if ($data->foto == null)
                            <img src="assets/img/profile.png" style="width: 100%" style="max-height: 300px;" class="img-fluid rounded-start" alt="..."> 
                            @else
                            <img src="{{ asset ('tutor/img/'.$data->foto) }}" style="width: 100%" style="max-height: 300px;" class="img-fluid rounded-start" alt="...">
                            @endif
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $data->namaT }}</h5>
                                <p class="card-text">{{ $data->mapel }} ({{ $data->pendidikan }})</p>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detail-tutor_{{ $data->id }}">Lihat</button>
                                <div class="modal fade" id="detail-tutor_{{ $data->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"><b>Detail Profil Tutor</b></h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Deskripsi</div>
                                                    <div class="col-lg-8 col-md-8">{{ $data->deskripsi }}</div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Berkas Ijazah</div>
                                                    <div class="col-lg-8 col-md-8"><a href="{{ asset('tutor/ijazah/'.$data->berkas_ijazah) }}" class="btn btn-primary btn-sm"><i class="bi bi-file-earmark-pdf"></i></a></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Nama</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->namaT }}</div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Jenis Kelamin</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->jk }}</div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Riwayat Pendidikan</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->r_pendidikan }}</div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Alamat</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->alamat }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">No Handphone</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->no_hp }}</div>
                                                </div><br>
                                                <div class="col-lg-4 col-md-4 label"><b>Detail Les Privat</b></div><br>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Jenis Paket</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->jenis_paket }}</div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Kurikulum</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->kurikulum }}</div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Pendidikan</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->pendidikan }}</div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Mata Pelajaran</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->mapel }}</div>
                                                </div> 
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 label">Kelas</div>
                                                    <div class="col-lg-6 col-md-8">{{ $data->kelas }}</div>
                                                </div><br>
                                                <div class="label" style="text-align: center">Rencana Pembelajaran Semester</div>
                                                <textarea name="rps" id="rps" class="form-control" name="rps" rows="10" disabled>{{ $data->rps }}</textarea>
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
{{-- 
@push('script')

    <script>
        const ratingStars = document.querySelectorAll('.rating-star');
        const ratingValueInput = document.getElementById('rating');

        ratingStars.forEach(star => {
            star.addEventListener('mouseover', function() {
                highlightStars(parseInt(star.getAttribute('data-value')));
            });

            star.addEventListener('mouseout', function() {
                resetStars();
            });

            star.addEventListener('click', function() {
                const selectedValue = parseInt(star.getAttribute('data-value'));
                setRatingValue(selectedValue);
            });
        });

        function highlightStars(value) {
            ratingStars.forEach(star => {
                const starValue = parseInt(star.getAttribute('data-value'));

                if (starValue <= value) {
                    star.classList.add('active');
                } else {
                    star.classList.remove('active');
                }
            });
        }

        function resetStars() {
            ratingStars.forEach(star => {
                star.classList.remove('active');
            });
        }

        function setRatingValue(value) {
            ratingValueInput.value = value;
        }
    </script>

@endpush --}}