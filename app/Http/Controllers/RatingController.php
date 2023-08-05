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

class RatingController extends Controller
{
    public function detail_rating($id)
    {
        $user = Auth::User();
        $murid = Auth::user()->id;
        $x = Murid::where('murid_id', $murid)->select('namaM','foto')->get();

        $ratings = DB::table('rating')->where('t_id', $id)->select('rating')->get();

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

        return view('murid.tutor_rating', compact('totalRatings','tutorData','ratingData','x','hasil_rating'))->with(["user" => $user]);
    }

    public function rate_selesai(Request $request)
    {
        $cek = Detail::where([
            'id_detail' => $request->id_detail,
        ]);

        $validated = $request->validate([
            'rating'    => 'required',
            'ulasan'    => 'required',
        ],
        [
            'rating.required'   => 'Rating tidak boleh kosong',
            'ulasan.required'   => 'Ulasan tidak boleh kosong',
        ]); 

        Rating::create([
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
            't_id' => $request->t_id,
            'm_id' => $request->m_id,
            'id_detail' => $request->id_detail,
            'les_id' => $request->les_id,
        ]);

        toast('Berhasil menambahkan rate','success')->autoClose(3000);
        return redirect('murid-tutor-selesai');
    }
}
