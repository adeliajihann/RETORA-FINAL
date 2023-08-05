<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Les extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_tutor',
        'jenis_paket',
        'kurikulum',
        'mapel',
        'pendidikan',
        'kelas',
        'harga',
        'jadwal',
        'rps',
        'status_paket',
        'kondisi',
    ];
    
    protected $table = 'les';

    public function users()
    {
        return $this->belongsTo(Les::class, 'id_tutor','id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel','id');
    }

    public function pendidikan()
    {
        return $this->belongsTo(Pendidikan::class);
    }

    public function detail_les()
    {
        return $this->belongsTo(Detail::class,'id_les','id');
    }

    public function tutor()
    {
        return $this->hasOne(Tutor::class,'idT','id');
    }

    public function ratings()
    {
        return $this->belongsTo(Rating::class,'les_id','id');
    }


}
