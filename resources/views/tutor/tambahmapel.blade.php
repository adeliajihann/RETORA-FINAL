@extends('tutor.layout.main', ['title'=>'Tambah Jadwal Les'])

@section('judul')
    <div class="pagetitle">
        <h1>Tambah Jadwal Les</h1>
    </div><br>
@endsection

@section('isi')

<form action="tutor-mapel-add" method="POST" enctype="multipart/form-data">
@csrf
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                @foreach ($tutor as $t)
                <input hidden type="text" name="id_tutor" id="id_tutor" class="form-control" value="{{ $t->idT }}">
                @endforeach
                <div class="row">
                    <div class="col-3"><br>
                        <div class="form-group">
                            <label for="jenis_paket" class="form-label">Jenis Paket</label>
                            <select name="jenis_paket" id="jenis_paket" class="form-select
                            @error('jenis_paket')
                            is-invalid
                            @enderror
                            " id="jenis_paket" placeholder="-- Pilih --"> 
                                <option>-- Pilih --</option>
                                <option value="Paket Pagi">Paket Pagi</option>
                                <option value="Paket Siang">Paket Siang</option>
                                <option value="Paket Sore">Paket Sore</option>
                                <option value="Paket Malam">Paket Malam</option>
                            </select>
                            @error('jenis_paket')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3"><br>
                        <div class="form-group">
                            <label for="kurikulum" class="form-label">Kurikulum</label>
                            <select name="kurikulum" id="kurikulum" class="form-select
                            @error('kurikulum')
                            is-invalid
                            @enderror
                            " id="kurikulum" placeholder="-- Pilih --"> 
                                <option>-- Pilih --</option>
                                <option value="2013">2013</option>
                                <option value="Merdeka">Merdeka</option>
                            </select>
                            @error('kurikulum')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3"><br>
                        <div class="form-group">
                            <label for="mapel" class="form-label">Mata Pelajaran</label>
                            <select name="mapel" id="mapel" class="form-select
                            @error('mapel')
                            is-invalid
                            @enderror
                            " id="mapel" placeholder="-- Pilih --"> 
                                <option>-- Pilih --</option>
                                @foreach ($mapel as $data)
                                    <option value="{{ $data->mapel }}">{{ $data->mapel }}</option>
                                @endforeach
                            </select>
                            @error('mapel')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3"><br>
                        <div class="form-group">
                            <label for="pendidikan" class="form-label">Pendidikan</label>
                            <select name="pendidikan" id="pendidikan" class="form-select
                            @error('pendidikan')
                            is-invalid
                            @enderror
                            " id="pendidikan" placeholder="-- Pilih --"> 
                                <option>-- Pilih --</option>
                                @foreach ($pendidikan as $data)
                                    <option value="{{ $data->pendidikan }}">{{ $data->pendidikan }}</option>
                                @endforeach
                            </select>
                            @error('pendidikan')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select name="kelas" id="kelas" class="form-select
                            @error('kelas')
                            is-invalid
                            @enderror
                            " id="kelas" placeholder="-- Pilih --"> 
                                <option>-- Pilih --</option>
                                {{-- @foreach ($pendidikan as $data)
                                    <option value="{{ $data->kelas }}">{{ $data->kelas }}</option>
                                @endforeach --}}
                            </select>
                            @error('kelas')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="harga" class="form-label">Harga Pertemuan</label>
                            <input type="text" name="harga" id="harga" class="form-control
                            @error('harga')
                            is-invalid
                            @enderror
                            " id="harga" placeholder="Contoh : 15000">
                            @error('harga')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="jadwal" class="form-label">Jadwal Paket Les</label>
                            <input type="text" name="jadwal" id="jadwal" class="form-control
                            @error('jadwal')
                            is-invalid
                            @enderror
                            " id="jadwal" placeholder="Contoh : Senin, Kamis, Jumat (14.00 - 13.00)">
                            @error('jadwal')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="rps" class="form-label">Rencana Pembelajaran Semester</label>
                            <textarea type="text" name="rps" id="rps" class="form-control
                            @error('rps')
                            is-invalid
                            @enderror
                            " id="rps" rows="7" placeholder="Masukkan rencana pembelajaran semester"></textarea>
                            @error('rps')
                                <div class='invalid-feedback'>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-xl-7">
            <div class="alert border-primary alert-dismissible fade show" role="alert">
                Silahkan pilih <button type="button" class="btn btn-primary btn-sm" disabled><i class="bi bi-plus-circle"></i></button> untuk menambah hari dan jam
            </div>
            <div class="card">
                <div class="card-body"><br>
                    <table id="example" class="table table-borderless table-hover table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Hari dan Jam</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>                 
                                <td>
                                    <input type="text" name="jadwal[]" id="jadwal"
                                    placeholder="Masukkan jadwal" class="form-control 
                                    @error('jadwal.0') 
                                    is-invalid 
                                    @enderror"
                                    value="{{ old('jadwal.0') }}">
                                    @error('jadwal.0')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <span style="color: red">*Contoh: Senin (14.00 - 15.30)</span>
                                </td>
                                <td style="text-align:center">
                                    <button type="button" name="tambah_jadwal" id="tambah_jadwal" class="btn btn-primary btn-sm" onClick="onClick()">
                                        <i class="bi bi-plus-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
        <a href="tutor-mapel" class="btn btn-secondary btn-sm">Batal</a>
    </div>
</form>
    
@endsection

@push('scripts')
    {{-- <script>
    var appendedRows = [];
    $('#tambah_jadwal').click(function() {
        var newRow = 
            '<tr>' +
            '<td style="text-align:center">' +
            '<input type="text" name="jadwal[]" placeholder="Masukkan jadwal" class="form-control"value="{{ old('jadwal.+$no+') }}">' +
            '</td>' +
            '<td style="text-align:center">' +
            '<button type="button" class="btn btn-danger btn-sm remove-table-row"><i class="bi bi-dash-circle"></i></button>' +
            '</td>' +
            '</tr>';

        appendedRows.push(newRow);

        $('.card-body .table tbody').append(newRow);

        renumberRows();
        updateRowCountSpan();
    });

    $(document).on('click', '.remove-table-row', function() {
        $(this).parents('tr').remove();
        renumberRows();
        updateRowCountSpan();
    });

    function renumberRows() {
        $(".card-body .table tbody > tr").each(function(i, v) {
            $(this).find(".rownumber").text(i + 1);
        });
    }

    function updateRowCountSpan() {
        var rowCount = $(".card-body .table tbody tr").length;
        $(".rowcount-span").text(rowCount);
    }
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#pendidikan').change(function() {
                var pendidikan = $('#pendidikan').val();

                $.ajax({
                    url: '/get-kelas',
                    method: 'GET',
                    data: {
                        pendidikan: pendidikan,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var kelasSelect = $('#kelas');
                        kelasSelect.empty();
                        $.each(response, function(key, value) {
                            var option = $('<option></option>').attr('value', value
                                .kelas).text(value.kelas);
                            kelasSelect.append(option);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush