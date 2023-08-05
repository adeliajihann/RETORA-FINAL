<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        't_id',
        'm_id',
        'id_detail',
        'les_id',
        'rating',
        'ulasan',
    ];

    protected $table = 'rating';

    public function tutor()
    {
        return $this->belongsTo(Tutor::class, 't_id', 'idT');
    }
}
