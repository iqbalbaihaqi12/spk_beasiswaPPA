<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $table = 'kriteria';
    protected $guarded = [];
    protected $fillable = ['id'];

    public function crips()
    {
        return $this->hasMany(Crips::class,'kriteria_id');
    }
}

