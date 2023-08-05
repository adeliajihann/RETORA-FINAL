<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pendidikan',
        'kelas',
    ];
    protected $table = 'pendidikan';

    public function les()
    {
        return $this->hasMany(Les::class);
    }
}
