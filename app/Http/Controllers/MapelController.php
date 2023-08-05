<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Detail;
use App\Models\Les;
use App\Models\Mapel;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Murid;
use App\Models\Pendidikan;
use App\Models\Rating;
use Illuminate\Support\Facades\Redis;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::User();
        $tutor = Auth::user()->id;
        $x = Tutor::where('tutor_id', $tutor)->select('namaT','foto','status_akun')->get();
        
        $keyword = $request->keyword;
        $mapel = Les::with('mapel')
        ->with('pendidikan')
        ->where('id_user','=',$tutor)
        ->where('jenis_paket','LIKE','%'.$keyword. '%')
        ->where('kurikulum','LIKE','%'.$keyword. '%')
        ->where('pendidikan','LIKE','%'.$keyword. '%')
        ->where('kelas','LIKE','%'.$keyword. '%')
        ->where('mapel','LIKE','%'.$keyword. '%')
        ->get();
        $data = array
        (
            'mapel' => $mapel
        );

        return view ('tutor.mapel', compact('mapel','x'))->with([$data,"user" => $user]);
    }

    public function tambahmapel()
    {
        $user = Auth::User();
        $tutor = Auth::user()->id;
        $x = Tutor::where('tutor_id', $tutor)->select('namaT','foto')->get();

        $tutor = Tutor::where('tutor_id', $tutor)->select('idT')->get();
        $les = Les::where('id_user', $tutor)->select('id')->get();
        $mapel = Mapel::all();
        $pendidikan = Pendidikan::groupBy('pendidikan')->get(['pendidikan']);

        return view('tutor.tambahmapel', compact('tutor','mapel','x','pendidikan','les'))->with([ "user" => $user]);  
    }

    public function getKelas(Request $request)
    {
        $pendidikan = $request->input('pendidikan');

        $kelass = Pendidikan::where('pendidikan', $pendidikan)->get();
        return response()->json($kelass);
    }

    public function edit(Request $request, $id)
    {
        $user = Auth::User();
        $tutor = Auth::user()->id;
        $x = Tutor::where('tutor_id', $tutor)->select('namaT','foto')->get();

        $les = Les::findorFail($id);
        $les->join('mapel','mapel.mapel','=','les.mapel')
        ->join('pendidikan','pendidikan.pendidikan','les.pendidikan')
        ->join('pendidikan','pendidikan.kelas','les.kelas')
        ->select('les.pendidikan','les.pendidikan','les.kelas','les.mapel','les.jadwal','les.harga')
        ;
        $mapel = Mapel::all();
        $pendidikan = Pendidikan::all();
        return view('tutor.ubahmapel', compact('les','mapel','x','pendidikan'))->with(["user" => $user]);
    }

    public function create_mapel(Request $request)
    {
        $mapel = Les::where([
            'id_user' => Auth()->id(),
            'id_tutor' => $request->id_tutor,
        ]);

        $validated = $request->validate([
            'jenis_paket' => 'required',
            'kurikulum' => 'required',
            'mapel' => 'required',
            'pendidikan' => 'required',
            'kelas' => 'required',
            'harga' => 'required',
            'jadwal'  => 'required',
            'rps'  => 'required',
        ],
        [
            'jenis_paket.required' => 'Jenis paket tidak boleh kosong',
            'kurikulum.required' => 'Kurikulum paket tidak boleh kosong',
            'mapel.required' => 'Mata pelajaran tidak boleh kosong',
            'pendidikan.required' => 'Pendidikan tidak boleh kosong',
            'kelas.required' => 'Kelas tidak boleh kosong',
            'harga.required' => 'Harga tidak boleh kosong',
            'jadwal.required' => 'Jadwal tidak boleh kosong',
            'rps.required' => 'Rencana Pembelajaran Semester tidak boleh kosong',
        ]);

        $kondisi_les = 'kosong';
        $status = 'Publikasi';
        Les::create([
            'jenis_paket' => $request->jenis_paket,
            'kurikulum' => $request->kurikulum,
            'mapel' => $request->mapel,
            'pendidikan' => $request->pendidikan,
            'kelas' => $request->kelas,
            'harga' => $request->harga,
            'jadwal' => $request->jadwal,
            'rps' => $request->rps,
            'status_paket' => $status,
            'kondisi' => $kondisi_les,
            'id_tutor' => $request->id_tutor,
            'id_user' => Auth::id(),
        ]);

        toast('Jadwal les berhasil tersimpan','success')->autoClose(3000);
        return redirect('tutor-mapel');
    }

    public function update(Request $request, $id)
    {
        $mapel = Les::find($id);

        $validated = $request->validate([
            'jenis_paket' => 'required',
            'kurikulum' => 'required',
            'mapel' => 'required',
            'pendidikan' => 'required',
            'kelas' => 'required',
            'harga' => 'required',
            'jadwal'  => 'required',
            'rps'  => 'required',
        ],
        [
            'jenis_paket.required' => 'Jenis paket tidak boleh kosong',
            'kurikulum.required' => 'Kurikulum paket tidak boleh kosong',
            'mapel.required' => 'Mata pelajaran tidak boleh kosong',
            'pendidikan.required' => 'Pendidikan tidak boleh kosong',
            'kelas.required' => 'Kelas tidak boleh kosong',
            'harga.required' => 'Harga tidak boleh kosong',
            'jadwal.required' => 'Jadwal tidak boleh kosong',
            'rps.required' => 'Rencana Pembelajaran Semester tidak boleh kosong',
        ]);

        $mapel->jenis_paket = $request->jenis_paket;
        $mapel->kurikulum = $request->kurikulum;
        $mapel->mapel = $request->mapel;
        $mapel->pendidikan = $request->pendidikan;
        $mapel->kelas = $request->kelas;
        $mapel->jadwal = $request->jadwal;
        $mapel->harga = $request->harga;
        $mapel->rps = $request->rps;
        $mapel->save();

        toast('Jadwal les berhasil diubah','success')->autoClose(3000);
        return redirect('tutor-mapel');
    }

    public function publikasi($id)
    {
        $publikasi = Les::find($id);
        $publikasi->status_paket = 'Publikasi';
        $publikasi->save();

        toast('Jadwal les berhasil dipublikasi','success')->autoClose(3000);
        return redirect('tutor-mapel');
    }

    public function sembunyikan($id)
    {
        $sembunyikan = Les::find($id);
        $sembunyikan->status_paket = 'Sembunyikan';
        $sembunyikan->save();

        toast('Jadwal les berhasil disembunyikan','success')->autoClose(3000);
        return redirect('tutor-mapel');
    }

}
