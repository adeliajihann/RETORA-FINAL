<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Murid;
use App\Models\Mapel;
use App\Models\Les;
use App\Models\Detail;
use App\Models\Pendidikan;
use App\Models\Rating;
use Illuminate\Support\Facades\Redis;

class MuridController extends Controller
{
    public function getKelas(Request $request)
    {
        $pendidikan = $request->input('pendidikan');

        $kelass = Pendidikan::where('pendidikan', $pendidikan)->get();
        return response()->json($kelass);
    }

    public function home(Request $request)
    {
        $user = Auth::User();
        $murid = Auth::user()->id;
        $x = Murid::where('murid_id', $murid)->select('namaM','foto')->get();

        $mapel = Mapel::select('id','mapel')->get();
        $murid = Murid::where('murid_id', $murid)->select('idM')->get();
        $pendidikan = Pendidikan::all();

        $listmapel = $request->get('mapel');
        $listpendidikan = $request->get('pendidikan');
        $listkelas = $request->get('kelas');
        $listjenis = $request->get('jenis_paket');
        $listkurikulum = $request->get('kurikulum');

        $tutor = DB::table('les')
        ->leftJoin('tutor', 'les.id_tutor', '=', 'tutor.idT')
        ->where("status_paket", "=", "Publikasi")
        ->where("kondisi", "=", "kosong")
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

        return view('murid.layout.home', compact("mapel","tutor","murid","x","pendidikan"))->with(["user" => $user]);
    }

    public function destroy($id)
    {
        $users = User::findorFail($id);
        $users->delete();
        
        toast('Akun berhasil dihapus','success')->autoClose(3000);
        return redirect("/");
    }

    public function index(Request $request)
    {
        $user = Auth::User();
        $murid = Auth::user()->id;
        $x = Murid::where('murid_id', $murid)->select('namaM','foto')->get();

        $murid = DB::table('murid')
        ->join('users', 'users.id', '=', 'murid_id')
        ->where('murid.murid_id','=',$murid)
        ->select(
            'users.id',
            'users.email',
            'users.username',
            'users.password',
            'murid.idM',
            'murid.murid_id',
            'murid.namaM',
            'murid.foto',
            'murid.jk',
            'murid.tgl_lahir',
            'murid.deskripsi',
            'murid.no_hp',
            'murid.alamat',
            'murid.r_pendidikan',
            'murid.kurikulum',
        )
        ->get();

        return view ('murid.pengaturan', compact('murid','x'))->with(["user" => $user]);
    }

    public function update(Request $request, $id)
    {
        $murid = Murid::find($id);
        $validated = $request->validate([
            'namaM'      => 'required',
            'jk'        => 'required',
            'tgl_lahir' => 'required',
            'deskripsi' => 'nullable',
            'alamat'    => 'required',
            'no_hp'     => 'required|numeric|digits_between:1,13',
            'r_pendidikan'=> 'required',
            'kurikulum'=> 'required',
        ],
        [
            'namaM.required' => 'Nama tidak boleh kosong',
            'jk.required' => 'Jenis Kelamin tidak boleh kosong',
            'tgl_lahir.required' => 'Tanggal Lahir Anak tidak boleh kosong',
            'no_hp.required' => 'No HP tidak boleh kosong',
            'no_hp.digits_between:1,13' => 'No HP tidak boleh lebih dari 13 angka',
            'no_hp.numeric' => 'No HP tidak boleh selain angka',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'r_pendidikan.required' => 'Pendidikan tidak boleh kosong',
            'kurikulum.required' => 'Kurikulum tidak boleh kosong',
        ]);
        $murid->namaM = $request->namaM;
        $murid->jk = $request->jk;
        $murid->tgl_lahir = $request->tgl_lahir;
        $murid->deskripsi = $request->deskripsi;
        $murid->alamat = $request->alamat;
        $murid->no_hp = $request->no_hp;
        $murid->r_pendidikan = $request->r_pendidikan;
        $murid->kurikulum = $request->kurikulum;
        $murid->update();

        toast('Data telah tersimpan','success')->autoClose(3000);
        return redirect('pengaturan-murid');
    }

    public function updatefoto(Request $request, $id)
    {
        $murid = Murid::find($id);
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:20148',
        ],
        [
            'foto.required' => 'Pilih foto!',
        ]);

        $foto = $request->file('foto');
        $newFoto = 'foto_murid' . '_' . time() . '.' . $foto->extension();
        $path = 'murid/img/';
        $request->foto->move(public_path($path), $newFoto);

        $murid->foto = $newFoto;
        $murid->update();

        toast('Foto telah di update','success')->autoClose(3000);
        return redirect('pengaturan-murid');
    }

    public function updateprofil(Request $request, $id)
    {
        $request->validate([
            "email" => "required|unique:users,email",
            "username" => "required|uunique:users,username",
        ],
        [
            "email.required" => "Email tidak boleh kosong",
            "email.unique" => "Email sudah ada!",
            "username.required" => "Username tidak boleh kosong",
            "username.unique" => "Username sudah ada!",
        ]);

        $users = User::find($id);
        $users->email = $request->email;
        $users->username = $request->username;
        $users->update();

        toast('Data telah tersimpan','success')->autoClose(3000);
        return redirect("pengaturan-murid");
    }

    public function updatepassword(Request $request, $id)
    {
        $users = User::find($id);
        $password = auth()->user()->password;
        $password_lama = request('password_lama');
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required',
            'password_konfirmasi' => 'same:password_baru'
        ],
        [
            'password_lama.required' => 'Password tidak boleh kosong',
            'password_baru.required' => 'Password baru tidak boleh kosong!',
            'password_konfirmasi.same' => 'Password baru dan konfirmasi password harus sama!'
        ]);
        if(Hash::check($password_lama, $password)){
        } else {
            return back()->withErrors(['password_lama'=>'Password tidak sesuai!']);
        }

        User::whereId(auth()->User()->id)->update([
            'password' => Hash::make($request->password_baru)
        ]);

        toast('Password telah diubah','success')->autoClose(3000);
        return redirect("pengaturan-murid");
    }

    public function tutor_acc()
    {
        $user = Auth::User();
        $murid = Auth::user()->id;
        $x = Murid::where('murid_id', $murid)->select('namaM','foto')->get();

        $tutor = DB::table("detail_les")
        ->leftjoin("tutor","tutor.idT","=","detail_les.tutor")
        ->leftjoin("murid","murid.idM","=","detail_les.id_murid")
        ->leftjoin("les","les.id","=","detail_les.id_les")
        ->where("murid.murid_id","=",$murid)
        ->where("detail_les.status","=","diterima")
        ->orderBy('detail_les.tgl_awal', 'desc')
        ->select(
            "tutor.foto",
            "tutor.namaT",
            "tutor.jk",
            "tutor.deskripsi",
            "tutor.alamat",
            "tutor.r_pendidikan",
            "tutor.no_hp",
            "tutor.berkas_ijazah",
            "detail_les.id",
            "les.jenis_paket",
            "les.kurikulum",
            "les.pendidikan",
            "les.kelas",
            "les.mapel",
            "les.jadwal",
            "les.harga",
            "les.rps",
        )->paginate();
        return view('murid.tutor_acc', compact('tutor','x'))->with([ "user" => $user]);
    }

    public function tutor_pending()
    {
        $user = Auth::User();
        $murid = Auth::user()->id;
        $x = Murid::where('murid_id', $murid)->select('namaM','foto')->get();

        $tutor = DB::table("detail_les")
        ->leftjoin("tutor","tutor.idT","=","detail_les.tutor")
        ->leftjoin("murid","murid.idM","=","detail_les.id_murid")
        ->leftjoin("les","les.id","=","detail_les.id_les")
        ->where("murid.murid_id","=",$murid)
        ->where("detail_les.status","=","pending")
        ->orderBy('detail_les.tgl_awal', 'desc')
        ->select(
            "tutor.foto",
            "tutor.namaT",
            "tutor.jk",
            "tutor.deskripsi",
            "tutor.alamat",
            "tutor.r_pendidikan",
            "tutor.no_hp",
            "tutor.berkas_ijazah",
            "detail_les.id",
            "les.jenis_paket",
            "les.kurikulum",
            "les.pendidikan",
            "les.kelas",
            "les.mapel",
            "les.jadwal",
            "les.harga",
            "les.rps",
        )->paginate();
        return view('murid.tutor_pending', compact('tutor','x'))->with([ "user" => $user]);  
    }

    public function tutor_selesai()
    {
        $user = Auth::User();
        $murid = Auth::user()->id;
        $x = Murid::where('murid_id', $murid)->select('namaM','foto')->get();

        $tutor = DB::table("detail_les")
        ->leftjoin("tutor","tutor.idT","=","detail_les.tutor")
        ->leftjoin("murid","murid.idM","=","detail_les.id_murid")
        ->leftjoin("rating","rating.id_detail","=","detail_les.id")
        ->leftjoin("les","les.id","=","detail_les.id_les")
        ->where("murid.murid_id","=",$murid)
        ->where("detail_les.status","=","selesai")
        ->orderBy('detail_les.created_at', 'desc')
        ->select(
            "tutor.foto",
            "tutor.namaT",
            "tutor.jk",
            "tutor.deskripsi",
            "tutor.alamat",
            "tutor.r_pendidikan",
            "tutor.no_hp",
            "tutor.berkas_ijazah",
            "detail_les.tutor",
            "detail_les.id_murid",
            "detail_les.id",
            "detail_les.id_les",
            "detail_les.tgl_awal",
            "detail_les.tgl_akhir",
            "rating.id_detail",
            "rating.rating",
            "rating.ulasan",
            "les.jenis_paket",
            "les.kurikulum",
            "les.pendidikan",
            "les.kelas",
            "les.mapel",
            "les.jadwal",
            "les.harga",
            "les.rps",
        )->paginate();
        return view('murid.tutor_selesai', compact('tutor','x'))->with([ "user" => $user]);  
    }

    public function batal($id)
    {
        DB::beginTransaction();
        try 
        {
            $batal = Detail::find($id);
            $lesId = $batal->id_les;
            $batal->delete();

            $statusBaru = 'kosong';
            DB::table('les')
                ->where('id', $lesId)
                ->update(['kondisi' => $statusBaru]);

            DB::commit();

            toast('Permintaan telah dibatalkan','success')->autoClose(3000);
            return redirect('murid-tutor-pending');

        } catch (\Exception $e) 
        {
            DB::rollback(); // Rollback transaksi jika terjadi kesalahan

            toast('Terjadi kesalahan saat membatalkan permintaan', 'error')->autoClose(3000);
            return redirect('murid-tutor-pending');
        }
    }

    public function bantuan()
    {
        $user = Auth::User();
        $murid = Auth::user()->id;
        $x = Murid::where('murid_id', $murid)->select('namaM','foto')->get();

        return view('murid.pusat_bantuan', compact('x'))->with([ "user" => $user]);
    }
}
