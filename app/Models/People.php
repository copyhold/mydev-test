<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'peoples';
    use HasFactory;

    public function films()
    {
      return $this->belongsToMany(Film::class);
    }
    public function species()
    {
      return $this->belongsToMany(Specie::class);
    }
}
