@extends('tutor.layout.main', ['title'=>'Ubah Jadwal Les'])

@section('judul')
    <div class="pagetitle">
        <h1>Ubah Jadwal Les</h1>
    </div><br>
@endsection

@section('isi')

    <div class="card">
        <div class="card-body">
            <form action="/mapel/edit/{{ $les->id }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="row">
                    <div class="col-md-3"><br>
                        <div class="form-group">
                            <label for="jenis_paket" class="form-label">Jenis Paket</label>
                            <select name="jenis_paket" id="jenis_paket" class="form-select
                            @error('jenis_paket')
                            is-invalid
                            @enderror
                            " id="jenis_paket" placeholder="-- Pilih --" value="{{ old('jenis_paket') }}"> 
                                <option value="Paket Pagi" {{ $les->jenis_paket == "Paket Pagi" ? 'selected' : '' }}>Paket Pagi</option>
                                <option value="Paket Siang" {{ $les->jenis_paket == "Paket Siang" ? 'selected' : '' }}>Paket Siang</option>
                                <option value="Paket Sore" {{ $les->jenis_paket == "Paket Sore" ? 'selected' : '' }}>Paket Sore</option>
                                <option value="Paket Malam" {{ $les->jenis_paket == "Paket Malam" ? 'selected' : '' }}>Paket Malam</option>
                            </select>
                            @error('jenis_paket')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3"><br>
                        <div class="form-group">
                            <label for="kurikulum" class="form-label">Kurikulum</label>
                            <select name="kurikulum" id="kurikulum" class="form-select
                            @error('kurikulum')
                            is-invalid
                            @enderror
                            " id="kurikulum" placeholder="-- Pilih --" value="{{ old('kurikulum') }}"> 
                                <option value="2013" {{ $les->kurikulum == "2013" ? 'selected' : '' }}>2013</option>
                                <option value="Merdeka" {{ $les->kurikulum == "Merdeka" ? 'selected' : '' }}>Merdeka</option>
                            </select>
                            @error('kurikulum')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3"><br>
                        <div class="form-group">
                            <label for="mapel" class="form-label">Mata Pelajaran</label>
                            <select name="mapel" id="mapel" class="form-select
                            @error('mapel')
                            is-invalid
                            @enderror
                            " id="mapel" placeholder="-- Pilih --" value="{{ old('mapel') }}"> 
                                @foreach ($mapel as $data)
                                    <option value="{{ $data->mapel }}" {{ ($les->mapel == $data->mapel)? 'selected': ''; }}>{{ $data->mapel }}</option>
                                @endforeach
                            </select>
                            @error('mapel')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3"><br>
                        <div class="form-group">
                            <label for="pendidikan" class="form-label">Pendidikan</label>
                            <select name="pendidikan" id="pendidikan" class="form-select
                            @error('pendidikan')
                            is-invalid
                            @enderror
                            " id="pendidikan" placeholder="-- Pilih --" value="{{ old('pendidikan') }}"> 
                                <option value="SD" {{ $les->pendidikan == "SD" ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{ $les->pendidikan == "SMP" ? 'selected' : '' }}>SMP</option>
                                <option value="SMA/sederajat" {{ $les->pendidikan == "SMA/sederajat" ? 'selected' : '' }}>SMA/sederajat</option>
                            </select>
                            @error('pendidikan')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select name="kelas" id="kelas" class="form-select
                            @error('kelas')
                            is-invalid
                            @enderror
                            " id="kelas" placeholder="-- Pilih --" value="{{ old('kelas') }}"> 
                                <option value="1" {{ $les->kelas == "1" ? 'selected' : '' }}>1</option>
                                <option value="2" {{ $les->kelas == "2" ? 'selected' : '' }}>2</option>
                                <option value="3" {{ $les->kelas == "3" ? 'selected' : '' }}>3</option>
                                <option value="4" {{ $les->kelas == "4" ? 'selected' : '' }}>4</option>
                                <option value="5" {{ $les->kelas == "5" ? 'selected' : '' }}>5</option>
                                <option value="6" {{ $les->kelas == "6" ? 'selected' : '' }}>6</option>
                                <option value="7" {{ $les->kelas == "7" ? 'selected' : '' }}>7</option>
                                <option value="8" {{ $les->kelas == "8" ? 'selected' : '' }}>8</option>
                                <option value="9" {{ $les->kelas == "9" ? 'selected' : '' }}>9</option>
                                <option value="10" {{ $les->kelas == "10" ? 'selected' : '' }}>10</option>
                                <option value="11" {{ $les->kelas == "11" ? 'selected' : '' }}>11</option>
                                <option value="12" {{ $les->kelas == "12" ? 'selected' : '' }}>12</option>
                            </select>
                            @error('kelas')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="harga" class="form-label">Harga Pertemuan</label>
                            <input type="text" name="harga" id="harga" class="form-control
                            @error('harga')
                            is-invalid
                            @enderror
                            " id="harga" value="{{ $les->harga }}">
                            @error('harga')
                            <div class='invalid-feedback'>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jadwal" class="form-label">Jadwal Paket</label>
                            <input type="text" name="jadwal" id="jadwal" class="form-control
                            @error('jadwal')
                            is-invalid
                            @enderror
                            " id="jadwal" value="{{ $les->jadwal }}">
                            @error('jadwal')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label for="rps" class="form-label">Rencana Pembelajaran Semester</label>
                        <textarea type="text" name="rps" id="rps" class="form-control
                        @error('rps')
                        is-invalid
                        @enderror
                        " id="rps" rows="7">{{ $les->rps }}</textarea>
                        @error('rps')
                            <div class='invalid-feedback'>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div><br>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a href="{{ route ('tutor.mapel') }}" class="btn btn-secondary btn-sm">Batal</a>
                </div>
            </form>
        </div>
    </div>

@endsection