<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailData extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function agama() {
        return $this->belongsTo(Agama::class);
    }

    protected $fillable = [
        'id_user',
        'address',
        'birth_place',
        'birth_date',
        'id_agama',
        'foto_ktp',
        'age',
    ];
}
