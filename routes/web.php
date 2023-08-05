<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\MuridController;
use App\Http\Controllers\LesController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\EmailController;

Route::get('/', function () { return view('welcome'); });
Route::get('login', function () { return view('login'); });
Route::get('role', function () { return view('role'); })->name('role');
Route::get('registrasi-murid', function () { return view('registrasi_murid'); });
Route::get('registrasi-tutor', function () { return view('registrasi_tutor'); });
Route::get('cari-tutor', [AdminController::class, 'cari'])->name('cari.tutor'); 
Route::get('rating/{id}', [AdminController::class, 'landing_page_rating'])->name('rating');

Route::get('/kirim_email', [App\Http\Controllers\EmailController::class, 'kirim']);

Route::controller(LoginController::class)->group(function () 
{
    Route::get("login", "index")->name("login");
    Route::post("login/proses", "proses");
    Route::post("register-murid", "register_murid");
    Route::post("register-tutor", "register_tutor");
    Route::get("logout", "logout");
});

Route::group(["middleware" => ["auth"]], function () {
    //MURID-----------------------------------------------------------------//
    Route::group(["middleware" => ["cekrole:murid"]], function () 
    { 
        Route::get('murid-home', [MuridController::class, 'home'])->name('murid.home'); 

        Route::post('req-tutor', [LesController::class, 'req_tutor']);
        Route::get('batal/{id}', [MuridController::class, 'batal']);      

        Route::get('murid-detail-rating/{id}', [RatingController::class, 'detail_rating']);
        Route::post('murid-rating-selesai', [RatingController::class, 'rate_selesai']);     

        Route::get('murid-daftar-tutor', [MuridController::class, 'tutor_acc']);    
        Route::get('murid-tutor-pending', [MuridController::class, 'tutor_pending']);    
        Route::get('murid-tutor-selesai', [MuridController::class, 'tutor_selesai']);    
        Route::get('pengaturan-murid', [MuridController::class, 'index']);
        Route::post('update/profil/murid/{id}', [MuridController::class, 'updateprofil']);
        Route::post('update/password/murid/{id}', [MuridController::class, 'updatepassword']);
        Route::post('update/foto/murid/{id}', [MuridController::class, 'updatefoto']);
        Route::post('update/detail/murid/{id}', [MuridController::class, 'update']);
        route::delete('delete/akun/murid/{id}', [MuridController::class, 'destroy','index'])->name('murid.destroy');
        route::get('pusat-bantuan-murid', [MuridController::class, 'bantuan']);
    });

    //TUTOR-----------------------------------------------------------------//
    Route::group(["middleware" => ["cekrole:tutor"]], function () 
    {
        Route::get('tutor-home', [TutorController::class, 'home'])->name('tutor.home');
        Route::get('tutor-daftar-murid', [TutorController::class, 'murid_acc']);
        Route::get('tutor-daftar-murid-pending', [TutorController::class, 'murid_pending']);
        Route::get('tutor-daftar-murid-ditolak', [TutorController::class, 'murid_ditolak']);
        Route::get('tutor-daftar-murid-selesai', [TutorController::class, 'murid_selesai']);
        Route::get('acc/{id}', [TutorController::class, 'acc']);
        Route::get('tolak/{id}', [TutorController::class, 'tolak']);
        Route::post('selesai/{id}', [TutorController::class, 'selesai']);

        Route::get('/get-kelas', [MapelController::class, 'getKelas']);
        Route::get('tutor-mapel', [MapelController::class,'index', 'edit'])->name('tutor.mapel');        
        Route::get('tutor-tambah-mapel', [MapelController::class, 'tambahmapel']); 
        Route::get('ubah-mapel/{id}', [MapelController::class, 'edit']); 
        Route::post('/mapel/edit/{id}', [MapelController::class, 'update']);
        Route::post('tutor-mapel-add', [MapelController::class, 'create_mapel'])->name('create.mapel');
        Route::get('publikasi/{id}', [MapelController::class, 'publikasi']); 
        Route::get('sembunyikan/{id}', [MapelController::class, 'sembunyikan']); 

        Route::get('pengaturan-tutor', [TutorController::class, 'index','destroy']);
        Route::post('upload/berkas/{id}', [TutorController::class, 'upload_berkas']);
        Route::post('update/profil/tutor/{id}', [TutorController::class, 'updateprofil']);
        Route::post('update/password/tutor/{id}', [TutorController::class, 'updatepassword']);
        Route::post('update/foto/tutor/{id}', [TutorController::class, 'updatefoto']);
        Route::post('update/detail/tutor/{id}', [TutorController::class, 'update']);
        route::delete('delete/akun/tutor/{id}', [TutorController::class, 'destroy','index'])->name('tutor.destroy');
        route::get('pusat-bantuan', [TutorController::class, 'bantuan']);

        route::get('tutor/keluar/{id}', [LoginController::class, 'logout']);

    });

    //ADMIN-----------------------------------------------------------------//
    Route::group(["middleware" => ["cekrole:admin"]], function () 
    {
        Route::get('admin-home', [AdminController::class, 'index']);    
        Route::get('data-tutor', [AdminController::class, 'data_tutor']);       
        Route::get('verifikasi/{id}', [AdminController::class, 'verifikasi']);       
        Route::get('block/{id}', [AdminController::class, 'block']);       
        Route::get('data-siswa', [AdminController::class, 'data_murid']);       
        Route::get('jadwal-les', [AdminController::class, 'jadwal_les']);       
        Route::get('data-mapel', [AdminController::class, 'index_mapel']);       
        Route::get('data-pendidikan', [AdminController::class, 'index_pendidikan']);       
        Route::post('tambah-mapel', [AdminController::class, 'create_mapel']);       
        Route::post('tambah-pendidikan', [AdminController::class, 'create_pendidikan']);       
        Route::get('pengaturan-admin', [AdminController::class, 'pengaturan']);
        Route::post('update/foto/admin/{id}', [AdminController::class, 'updatefoto']);
        Route::get('hapus/mapel/{id}', [AdminController::class, 'destroy_mapel']);
        Route::get('hapus/pendidikan/{id}', [AdminController::class, 'destroy_pendidikan']);
        Route::get('hapus/akun/murid/{id}', [AdminController::class, 'destroy_murid']);
    });
});