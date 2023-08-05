<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable = [
        'tutor_id',
        'namaT',
        'jk',
        'tgl_lahir',
        'deskripsi',
        'foto',
        'no_hp',
        'alamat',
        'r_pendidikan',
        'nilai_ijazah',
        'berkas_ijazah',
        'status_akun',
    ];

    protected $table = 'tutor';
    protected $primaryKey = 'idT';

    public function les()
    {
        return $this->belongsTo(Les::class, 'id_tutor','id');
    }

    public function detail()
    {
        return $this->belongsTo(Detail::class, 'tutor','id');
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }
    
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
}
