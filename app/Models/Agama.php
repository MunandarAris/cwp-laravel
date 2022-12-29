<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
    use HasFactory;

    public function detailData() {
        return $this->hasMany(DetailData::class);
    }

    protected $fillable = [
        'name'
    ];
}
