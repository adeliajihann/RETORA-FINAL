<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_les',
        'tutor',
        'id_murid',
        'tgl_awal',
        'tgl_akhir',
        'status',
        'rating',
        'ulasan',
    ];
    protected $table = 'detail_les';

    public function detail()
    {
        return $this->belongsTo(Tutor::class, 'id_murid','id');
        return $this->belongsTo(Tutor::class, 'tutor','id');
    }
}
