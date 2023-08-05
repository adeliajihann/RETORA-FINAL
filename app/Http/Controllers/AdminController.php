<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Mapel;
use App\Models\Les;
use App\Models\Detail;
use App\Models\Murid;
use App\Models\Tutor;
use App\Models\Pendidikan;
use App\Models\Rating;
use Illuminate\Support\Facades\Redis;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::User();
        $dt_murid = Murid::all()->count();
        $dt_tutor_daftar = Tutor::where("status_akun","=","Daftar")->count();
        $dt_tutor_acc = Tutor::where("status_akun","=","Acc")->count();
        $dt_tutor_block = Tutor::where("status_akun","=","Block")->count();
        $dt_mapel = Mapel::all()->count();
        $dt_les   = Detail::all()->count();
        $dt_pendidikan = Pendidikan::all()->count();

        return view ('admin.layout.home', compact('dt_murid','dt_tutor_daftar','dt_tutor_acc','dt_tutor_block','dt_mapel','dt_les','dt_pendidikan'))->with(["user" => $user]);
    }

    public function cari(Request $request)
    {
        $mapel = Mapel::select('id','mapel')->get();
        $pendidikan = Pendidikan::all();

        $listmapel = $request->get('mapel');
        $listpendidikan = $request->get('pendidikan');
        $listkelas = $request->get('kelas');
        $listjenis = $request->get('jenis_paket');
        $listkurikulum = $request->get('kurikulum');

        $tutor = DB::table('les')
        ->leftJoin('tutor', 'les.id_tutor', '=', 'tutor.idT')
        ->where("kondisi", "=", "kosong")
        ->where("status_paket", "=", "Publikasi")
        ->where("pendidikan", "=", $listpendidikan)
        ->where("kelas", "=", $listkelas)
        ->where("mapel", "=", $listmapel)
        ->where("jenis_paket", "=", $listjenis)
        ->where("kurikulum", "=", $listkurikulum)
        ->select(
            'tutor.idT', 
            'tutor.foto', 
            'tutor.namaT', 
            'tutor.deskripsi', 
            'tutor.berkas_ijazah', 
            'tutor.jk', 
            'tutor.r_pendidikan', 
            'tutor.alamat', 
            'les.id', 
            'les.id_tutor',
            'les.id_user',
            'les.jenis_paket',
            'les.kurikulum',
            'les.mapel',
            'les.pendidikan',
            'les.kelas',
            'les.harga',
            'les.jadwal',
            'les.rps',    
        )
        ->get();

        return view ('cari_tutor', compact("tutor","mapel","pendidikan"));
    }

    public function landing_page_rating($id)
    {
        $ratings = DB::table('rating')->where('t_id', $id)->select('rating','created_at')->get();

        $tutorData = DB::table('rating')
            ->join('tutor', 'tutor.idT', '=', 'rating.t_id')
            ->where('rating.t_id', $id)
            ->select('tutor.foto', 'tutor.namaT')
            ->groupBy('tutor.foto', 'tutor.namaT')
            ->get();

        $ratingData = DB::table('rating')
            ->join('murid', 'murid.idM', '=', 'rating.m_id')
            ->where('rating.t_id', $id)
            ->select('rating.rating', 'rating.ulasan', 'rating.created_at', 'murid.foto', 'murid.namaM')
            ->get();
        $ratingData->transform(function ($record) 
        {
            $record->created_at = Carbon::parse($record->created_at)->format('Y-m-d');
            return $record;
        });

        $totalRatings = $ratings->count();
        $sumRating = 0;
        foreach ($ratings as $rating) {
            $sumRating += $rating->rating;
        }
        if ($totalRatings > 0) {
            $averageRating = $sumRating / $totalRatings;
        } else {
            $averageRating = 0;
        }
        $hasil_rating = number_format($averageRating, 2);
        $hasil_rating = (float) $hasil_rating;

        return view('rating_ulasan', compact('totalRatings','tutorData','ratingData','hasil_rating','ratings'));
    }

    public function updatefoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image',
        ],
        [
            'foto.required' => 'Pilih foto!',
        ]);

        $foto = $request->file('foto');
        $newFoto = 'foto_admin' . '_' . time() . '.' . $foto->extension();

        $path = 'admin/img/';
        $request->foto->move(public_path($path), $newFoto);
        $users = User::find($id);
        $users->foto = $newFoto;
        $users->update();

        toast('Foto telah di update','success')->autoClose(3000);
        return redirect('pengaturan-admin');
    }

    public function data_murid(Request $request)
    {
        $user = Auth::User();
        $keyword = $request->keyword;
        $users = Murid::where('namaM','LIKE','%'.$keyword.'%')
        ->paginate();

        return view('admin.data_siswa', compact('users'))->with([ "user" => $user]);  
    }

    public function verifikasi($id)
    {
        $tutor = Tutor::find($id);
        $tutor->status_akun='Acc';
        $tutor->save();
        toast('Akun tutor telah diverifikasi','success')->autoClose(3000);
        return redirect('data-tutor');
    }

    public function block($id)
    {
        $tutor = Tutor::find($id);
        $tutor->status_akun='Block';
        $tutor->save();
        toast('Akun tutor telah diblock','success')->autoClose(3000);
        return redirect('data-tutor');
    }

    public function data_tutor(Request $request)
    {
        $user = Auth::User();
        $keyword = $request->keyword;
        $users = Tutor::where('namaT','LIKE','%'.$keyword.'%')
        ->where('status_akun','LIKE','%'.$keyword.'%')
        ->orderBy('created_at', 'desc')
        ->paginate();

        return view('admin.data_tutor', compact('users'))->with([ "user" => $user]);  
    }

    public function jadwal_les(Request $request)
    {
        $user = Auth::User();
        $keyword = $request->keyword;
        $jadwal = DB::table("detail_les")
        ->leftjoin("tutor","tutor.idT","=","detail_les.tutor")
        ->leftjoin("murid","murid.idM","=","detail_les.id_murid")
        ->leftjoin("les","les.id","=","detail_les.id_les")
        ->where('tutor.namaT','LIKE','%'.$keyword.'%')
        ->where('murid.namaM','LIKE','%'.$keyword.'%')
        ->where('les.mapel','LIKE','%'.$keyword.'%')
        ->where('les.pendidikan','LIKE','%'.$keyword.'%')
        ->where('detail_les.status','LIKE','%'.$keyword.'%')
        ->select(
            'tutor.namaT',
            'murid.namaM',
            'les.id',
            'les.kurikulum',
            'les.jenis_paket',
            'les.mapel',
            'les.pendidikan',
            'les.kelas',
            'les.harga',
            'les.jadwal',
            'detail_les.tgl_awal',
            'detail_les.tgl_akhir',
            'detail_les.status',
        )
        ->paginate();

        return view('admin.les_privat', compact('jadwal'))->with([ "user" => $user]);  
    }

    public function destroy_murid($id)
    {
        $users = User::where('id',$id)
        ->where("role","murid")
        ->delete();

        return redirect("data-siswa");
    }

    public function index_mapel(Request $request)
    {
        $user = Auth::User();
        $keyword = $request->keyword;
        $mapel = Mapel::where('mapel','LIKE','%'.$keyword. '%')->paginate();
        
        return view ('admin.mapel', compact('mapel'))->with(["user" => $user]);
    }

    public function create_mapel(Request $request)
    {
        $validated = $request->validate([
            'mapel' => 'required',
        ],
        [
            'mapel.required' => 'Mata Pelajaran tidak boleh kosong'
        ]);

        Mapel::create([
            'mapel' => $request->mapel,
        ]);

        toast('Mata pelajaran berhasil tersimpan','success')->autoClose(3000);
        return redirect('data-mapel');
    }

    public function destroy_mapel($id)
    {
        $mapel = Mapel::find($id)->delete();

        toast('Mata pelajaran berhasil dihapus','success')->autoClose(3000);
        return redirect("data-mapel");
    }

    public function index_pendidikan(Request $request)
    {
        $user = Auth::User();
        $keyword = $request->keyword;
        $pendidikan = Pendidikan::where('pendidikan','LIKE','%'.$keyword. '%')
        ->where('kelas','LIKE','%'.$keyword. '%')
        ->paginate();
        
        return view ('admin.pendidikan', compact('pendidikan'))->with(["user" => $user]);
    }

    public function create_pendidikan(Request $request)
    {
        $validated = $request->validate([
            'pendidikan' => 'required',
            'kelas' => 'required',
        ],
        [
            'pendidikan.required' => 'Mata Pelajaran tidak boleh kosong',
            'kelas.required' => 'Kelas tidak boleh kosong'
        ]);

        Pendidikan::create([
            'pendidikan' => $request->pendidikan,
            'kelas' => $request->kelas,
        ]);

        toast('Data berhasil tersimpan','success')->autoClose(3000);
        return redirect('data-pendidikan');
    }

    public function destroy_pendidikan($id)
    {
        $pendidikan = Pendidikan::find($id)->delete();

        toast('Pendidikan & Kelas berhasil dihapus','success')->autoClose(3000);
        return redirect("data-pendidikan");
    }
}
