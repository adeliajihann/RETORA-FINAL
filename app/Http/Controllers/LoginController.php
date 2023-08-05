<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Tutor;
use App\Models\Murid;

class LoginController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (Auth::user()) {
            if ($user->role == "tutor") 
            {
                return redirect("tutor-home");
            } 
            elseif ($user->role == "murid") 
            {
                return redirect("murid-home");
            }
            else
            {
                return redirect("admin-home");
            }
        }
        return view("login");
    }

    public function proses(Request $request)
    {
        $request->validate(
            [
                "username" => "required",
                "password" => "required",
            ],
            [
                "username.required" => "Username tidak boleh kosong",
                "password.required" => "Password tidak boleh kosong",
            ]
        );
        // kredensial = memastikan email dan password benar
        $kredensial = $request->only("username", "password");

        if (Auth::attempt($kredensial)) 
        {
            $request->session()->regenerate();
            $user = Auth::user();
            $id_tutor = Auth()->id();
            $id_murid = Auth()->id();
            $tutor = Tutor::where('tutor_id',$id_tutor)->select('foto')->get();
            $murid = Murid::where('murid_id',$id_murid)->select('foto')->get();
            if (Auth::user()) {
                if ($user->role == "tutor") 
                {
                    foreach($tutor as $t)
                    {
                        if($t->foto == null)
                        {
                            toast('Berhasil Masuk','success')->autoClose(5000);
                            return redirect("pengaturan-tutor");
                        }
                        else
                        {
                            if($t->status_akun == "block")
                            {
                                toast('Anda tidak bisa login karena menyalahi kebijakan RETORA','error')->autoClose(5000);
                                return redirect("login");
                            }
                            else
                            {
                                toast('Berhasil Masuk','success')->autoClose(5000);
                                return redirect("tutor-home");
                            }
                        }
                    }
                } 
                elseif ($user->role == "murid") 
                {
                    foreach($murid as $m)
                    {
                        if($m->foto == null)
                        {
                            toast('Berhasil Masuk','success')->autoClose(5000);
                            return redirect("pengaturan-murid");
                        }
                        else
                        {
                            toast('Berhasil Masuk','success')->autoClose(5000);
                            return redirect("murid-home");
                        }
                    }
                }
                elseif ($user->role == "admin")
                {
                    toast('Berhasil Masuk','success')->autoClose(5000);
                    return redirect("admin-home");
                }
            }
            return redirect("login");
        }

        return back()
            ->withErrors([
                "username" => "Maaf username atau password anda salah",
            ])
            ->onlyInput("username");
    }

    public function register_murid(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email|unique:users,email',
            'username'    => 'required|unique:users,username',
            'password' => 'required|unique:users,password',
            'role'     => 'required',
            'namaM'     => 'required',
        ],
        [
            'email.required' => 'Email tidak boleh kosong!',
            'email.unique' => 'Email sudah ada!',
            'username.required' => 'Username tidak boleh kosong!',
            'username.unique' => 'Username sudah ada!',
            'password.required' => 'Password tidak boleh kosong!',
            'namaM.required' => 'Nama tidak boleh kosong!',
        ]);  
        $user = new User();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        $murid = new Murid();
        $murid->murid_id = $user->id;
        $murid->namaM = $request->namaM;
        $murid->save();

        toast('Berhasil Daftar Akun','success')->autoClose(5000);
        return redirect('login');
    }

    public function register_tutor(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email|unique:users,email',
            'username'    => 'required|unique:users,username',
            'password' => 'required|unique:users,password',
            'role'     => 'required',
            'namaT'     => 'required',
        ],
        [
            'email.required' => 'Email tidak boleh kosong!',
            'email.unique' => 'Email sudah ada!',
            'username.required' => 'Username tidak boleh kosong!',
            'username.unique' => 'Username sudah ada!',
            'password.required' => 'Password tidak boleh kosong!',
            'namaT.required' => 'Nama tidak boleh kosong!',
        ]);  
        $user = new User();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        $status_akun = 'Daftar';
        $tutor = new Tutor();
        $tutor->tutor_id = $user->id;
        $tutor->namaT = $request->namaT;
        $tutor->status_akun = $status_akun;
        $tutor->save();

        toast('Berhasil Daftar Akun','success')->autoClose(5000);
        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        toast('Berhasil Keluar','success')->autoClose(5000);
        return redirect("/");
    }
}