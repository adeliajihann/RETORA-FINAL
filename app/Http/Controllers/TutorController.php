<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
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


class TutorController extends Controller
{
    public function home()
    {
        $user = Auth::User();
        $tutor = Auth::user()->id;
        $x = Tutor::where('tutor_id', $tutor)->select('namaT','foto')->get();

        $m_pending = DB::table("detail_les")
        ->leftjoin("les","les.id","=","detail_les.id_les")
        ->where("les.id_user", $tutor)
        ->where("status", "=", "pending")->count();

        $m_diterima = DB::table("detail_les")
        ->leftjoin("les","les.id","=","detail_les.id_les")
        ->where("les.id_user", $tutor)
        ->where("status", "=", "diterima")->count();

        $m_selesai = DB::table("detail_les")
        ->leftjoin("les","les.id","=","detail_les.id_les")
        ->where("les.id_user", $tutor)
        ->where("status", "=", "selesai")->count();

        $ratings = DB::table('rating')
        ->leftjoin('tutor', 'tutor.idT', '=', 'rating.t_id')
        ->where('tutor.tutor_id', $tutor)
        ->select('tutor.idT', 'tutor.namaT', DB::raw('AVG(rating.rating) as average_rating'))
        ->groupBy('tutor.idT', 'tutor.namaT')
        ->get();

        $tutorData = DB::table('rating')
        ->join('tutor', 'tutor.idT', '=', 'rating.t_id')
        ->where('tutor.tutor_id', $tutor)
        ->select('tutor.foto', 'tutor.namaT')
        ->groupBy('tutor.foto', 'tutor.namaT')
        ->get();

        $ratingData = DB::table('rating')
        ->join('murid', 'murid.idM', '=', 'rating.m_id')
        ->join('tutor', 'tutor.idT', '=', 'rating.t_id')
        ->where('tutor.tutor_id', $tutor)
        ->select('rating.rating', 'rating.ulasan', 'rating.created_at', 'murid.foto', 'murid.namaM')
        ->get();

        $total = DB::table('rating')
        ->leftjoin('tutor', 'tutor.idT', '=', 'rating.t_id')
        ->where('tutor.tutor_id', $tutor)
        ->get();
        $totalRatings = $total->count();
        
        return view('tutor.layout.home', compact("m_pending","m_diterima","m_selesai","x",'ratings','tutorData','ratingData','totalRatings'))->with(["user" => $user]);
    }

    public function destroy($id)
    {
        $tutor = User::findorFail($id);
        $tutor->delete();
        
        toast('Akun berhasil dihapus','success')->autoClose(3000);
        return redirect("/");
    }
    
    public function index()
    {
        $user = Auth::User();
        $tutor = Auth::user()->id;
        $x = Tutor::where('tutor_id', $tutor)->select('namaT','foto')->get();

        $tutor = DB::table('tutor')
        ->join('users', 'users.id', '=', 'tutor_id')
        ->where('tutor.tutor_id','=',$tutor)
        ->select(
            'users.id',
            'users.email',
            'users.username',
            'users.password',
            'tutor.idT',
            'tutor.tutor_id',
            'tutor.namaT',
            'tutor.foto',
            'tutor.jk',
            'tutor.tgl_lahir',
            'tutor.deskripsi',
            'tutor.no_hp',
            'tutor.alamat',
            'tutor.r_pendidikan',
            'tutor.status_akun',
            'tutor.nilai_ijazah',
            'tutor.berkas_ijazah',
        )
        ->get();

        return view ('tutor.pengaturan', compact('tutor','x'))->with(["user" => $user]);
    }

    public function update(Request $request, $id)
    {
        $t = Tutor::find($id);
        $validated = $request->validate([
            'namaT' => 'required',
            'jk' => 'required',
            'tgl_lahir' => 'required',
            'deskripsi' => 'nullable',
            'no_hp' => 'required|numeric|digits_between:1,13',
            'alamat' => 'required',
            'r_pendidikan' => 'required',
        ],
        [
            'namaT.required' => 'Nama tidak boleh kosong!',
            'jk.required' => 'Jenis kelamin tidak boleh kosong!',
            'tgl_lahir.required' => 'Tanggal lahir tidak boleh kosong!',
            'no_hp.required' => 'No HP tidak boleh kosong!',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'r_pendidikan.required' => 'Pendidikan tidak boleh kosong!',
        ]);

        $t->namaT = $request->namaT;
        $t->jk = $request->jk;
        $t->tgl_lahir = $request->tgl_lahir;
        $t->deskripsi = $request->deskripsi;
        $t->alamat = $request->alamat;
        $t->no_hp = $request->no_hp;
        $t->r_pendidikan = $request->r_pendidikan;
        $t->update();
        
        toast('Data telah tersimpan','success')->autoClose(3000);
        return redirect('pengaturan-tutor');
    }

    public function upload_berkas(Request $request, $id)
    {
        $berkas = Tutor::find($id);
        $validated = $request->validate([
            'nilai_ijazah' => 'required',
            'berkas_ijazah' => 'required|mimes:jpg,jpeg,png,pdf,doc,docx,docs',
        ],
        [
            'nilai_ijazah.required' => 'Tidak boleh kosong!',
            'berkas_ijazah.required' => 'Tidak boleh kosong!',
        ]);

        $newBerkas = $berkas->nilai_ijazah;
        $pathBerkas = public_path('tutor/ijazah/ . $newFile'); 

        if($request->hasFile('berkas_ijazah'))
        {
            @unlink($pathFile);
            $berkas_ijazah = $request->file('berkas_ijazah');
            $berkas_ext = $berkas_ijazah->getClientOriginalExtension();
            $newBerkas = 'file_ijazah'  . '.' . $berkas_ext;
            $pathBerkas = 'tutor/ijazah/';
            $berkas_ijazah->move(($pathBerkas), $newBerkas);
            $berkas->berkas_ijazah = $newBerkas;
        }
        else
        {
            $berkas->berkas_ijazah = $request->old_ijazah;
        }

        $berkas->nilai_ijazah = $request->nilai_ijazah;
        $berkas->update();

        toast('Berkas Ijazah telah disimpan','success')->autoClose(3000);
        return redirect('pengaturan-tutor');
    }
    
    public function updatefoto(Request $request, $id)
    {
        $tutor = Tutor::find($id);
        $validated = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:20148',
        ],
        [
            'foto.required' => 'Pilih foto!',
        ]);
        
        $foto = $request->file('foto');
        $newFoto = 'foto_tutor' . '_' . time() . '.' . $foto->extension();
        $path = 'tutor/img/';
        $request->foto->move(public_path($path), $newFoto);

        $tutor->foto = $newFoto;
        $tutor->update();

        toast('Foto telah di update','success')->autoClose(3000);
        return redirect('pengaturan-tutor');
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
        return redirect("pengaturan-tutor");
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
        return redirect("pengaturan-tutor");
    }
    
    public function murid_acc()
    {
        $user = Auth::User();
        $tutor = Auth::user()->id;
        $x = Tutor::where('tutor_id', $tutor)->select('namaT','foto')->get();

        $murid = DB::table("detail_les")
        ->leftjoin("murid","murid.idM","=","detail_les.id_murid")
        ->leftjoin("les", "les.id", "=", "detail_les.id_les")
        ->where("les.id_user", "=", $tutor) 
        ->where("detail_les.status","=","diterima")
        ->orderBy('detail_les.tgl_awal', 'desc')
        ->select(
            "murid.foto",
            "murid.namaM",
            "murid.jk",
            "murid.deskripsi",
            "murid.alamat",
            "murid.r_pendidikan",
            "murid.no_hp",
            "detail_les.id",
            "les.id_user",
            "les.id_tutor",
            "les.jenis_paket",
            "les.kurikulum",
            "les.mapel",
            "les.pendidikan",
            "les.kelas",
            "les.harga",      
            "les.jadwal",      
            "les.rps",  
        )->paginate();
        return view('tutor.murid_acc', compact('murid','x'))->with([ "user" => $user]);
    }

    public function murid_pending()
    {
        $user = Auth::User();
        $tutor = Auth::user()->id;
        $x = Tutor::where('tutor_id', $tutor)->select('namaT','foto')->get();

        $murid = DB::table("detail_les")
        ->leftjoin("murid", "murid.idM", "=", "detail_les.id_murid")
        ->leftjoin("les", "les.id", "=", "detail_les.id_les")
        ->where("les.id_user", "=", $tutor) 
        ->where("detail_les.status", "=", "pending") 
        ->orderBy('detail_les.tgl_awal', 'desc')
        ->select(
            "murid.foto",
            "murid.namaM",
            "murid.jk",
            "murid.deskripsi",
            "murid.alamat",
            "murid.r_pendidikan",
            "murid.no_hp",
            "detail_les.id",
            "les.id_user",
            "les.id_tutor",
            "les.jenis_paket",
            "les.kurikulum",
            "les.mapel",
            "les.pendidikan",
            "les.kelas",
            "les.harga",      
            "les.jadwal",      
            "les.rps",  
        )->paginate();
        return view('tutor.murid_pending', compact('murid','x'))->with([ "user" => $user]);  
    }

    public function murid_selesai()
    {
        $user = Auth::User();
        $tutor = Auth::user()->id;
        $x = Tutor::where('tutor_id', $tutor)->select('namaT','foto')->get();

        $murid = DB::table("detail_les")
        ->leftjoin("murid","murid.idM","=","detail_les.id_murid")
        ->leftjoin("les", "les.id", "=", "detail_les.id_les")
        ->leftjoin("rating","rating.id_detail","=","detail_les.id")
        ->where("les.id_user", "=", $tutor) 
        ->where("detail_les.status","=","selesai")
        ->orderBy('detail_les.tgl_awal', 'desc')
        ->select(
            "murid.foto",
            "murid.namaM",
            "murid.jk",
            "murid.deskripsi",
            "murid.alamat",
            "murid.r_pendidikan",
            "murid.no_hp",
            "detail_les.id",
            "detail_les.tgl_awal",
            "detail_les.tgl_akhir",
            "rating.rating",
            "rating.ulasan",
            "les.id_user",
            "les.id_tutor",
            "les.jenis_paket",
            "les.kurikulum",
            "les.mapel",
            "les.pendidikan",
            "les.kelas",
            "les.harga",      
            "les.jadwal",      
            "les.rps",  
        )->paginate();
        return view('tutor.murid_selesai', compact('murid','x'))->with([ "user" => $user]);  
    }

    public function acc($id)
    {
        $acc = Detail::find($id);
        $acc->status='diterima';
        $acc->save();

        toast('Permintaan telah diterima','success')->autoClose(3000);
        return redirect('tutor-daftar-murid');
    }

    public function tolak($id)
    {
        DB::beginTransaction();
        try 
        {
            $tolak = Detail::find($id);
            $lesId = $tolak->id_les;
            $tolak->delete();

            $statusBaru = 'kosong';
            DB::table('les')
                ->where('id', $lesId)
                ->update(['kondisi' => $statusBaru]);

            DB::commit();

            toast('Permintaan telah ditolak', 'success')->autoClose(3000);
            return redirect('tutor-daftar-murid');

        } catch (\Exception $e) 
        {
            DB::rollback(); // Rollback transaksi jika terjadi kesalahan

            toast('Terjadi kesalahan saat menolak permintaan', 'error')->autoClose(3000);
            return redirect('tutor-murid-pending');
        }
    }

    public function selesai(Request $request ,$id)
    {   
        DB::beginTransaction();
        try 
        {
            $selesai = Detail::find($id);
            $lesId = $selesai->id_les;

            $validated = $request->validate([
            'tgl_akhir'    => 'required',
            ]);

            $selesai->tgl_akhir = $request->tgl_akhir;
            $selesai->status='selesai';
            $selesai->save();

            $statusBaru = 'kosong';
            DB::table('les')
                ->where('id', $lesId)
                ->update(['kondisi' => $statusBaru]);
            DB::commit();

            toast('Les Privat telah selesai','success')->autoClose(3000);
            return redirect('tutor-daftar-murid-selesai');

        } catch (\Exception $e) 
        {
            DB::rollback(); // Rollback transaksi jika terjadi kesalahan

            toast('Terjadi kesalahan saat membatalkan permintaan', 'error')->autoClose(3000);
            return redirect('murid-daftar-murid-selesai');
        }
    }

    public function bantuan()
    {
        $user = Auth::User();
        $tutor = Auth::user()->id;
        $x = Tutor::where('tutor_id', $tutor)->select('namaT','foto')->get();

        return view('tutor.pusat_bantuan', compact('x'))->with([ "user" => $user]);
    }
}
