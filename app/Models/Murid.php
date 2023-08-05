<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    use HasFactory;

    protected $fillable = [
        'murid_id',
        'namaM',
        'jk',
        'tgl_lahir',
        'deskripsi',
        'foto',
        'no_hp',
        'alamat',
        'r_pendidikan',
        'kurikulum',
    ];

    protected $table = 'murid';
    protected $primaryKey = 'idM';

    public function file()
    {
        return $this->belongsTo(Dokumentasi::class, 'id_m','id');
    }

    public function detail()
    {
        return $this->belongsTo(Detail::class, 'id_murid','id');
    }
}
