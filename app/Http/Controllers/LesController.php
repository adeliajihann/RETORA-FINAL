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
use Illuminate\Support\Facades\Redis;

class LesController extends Controller
{
    public function req_tutor(Request $request)
    {
        $status_cek = ['pending', 'diterima'];
        $cek = Detail::where([
            'id_les' => $request->id_les,
            'tutor' => $request->tutor,
            'id_murid' => $request->id_murid,
            'status' => $status_cek,
        ]);

        if ($cek->count() > 0) {
            toast('Anda hanya dapat mengirim 1 kali', 'error')->autoClose(3000);
            return redirect('murid-home');
        } 
        else 
        {
            $validated = $request->validate([
                'id_les' => 'required',
            ]);
            // Mulai transaksi
            DB::beginTransaction();
            try {
                $status = 'pending';
                Detail::create([
                    'id_les' => $request->id_les,
                    'tutor' => $request->tutor,
                    'id_murid' => $request->id_murid,
                    'tgl_awal' => $request->tgl_awal,
                    'status' => $status,
                ]);
                $lesId = $request->id_les; 
                $statusBaru = 'penuh'; 
                DB::table('les')
                    ->where('id', $lesId)
                    ->update(['kondisi' => $statusBaru]);
                DB::commit();

                toast('Permintaan berhasil terkirim', 'success')->autoClose(3000);
                return redirect('murid-tutor-pending');
            } 
            catch (\Exception $e) 
            {
                DB::rollback(); // Rollback transaksi jika terjadi kesalahan

                toast('Terjadi kesalahan saat mengirim permintaan', 'error')->autoClose(3000);
                return redirect('murid-home');
            }
        }
    }
}
