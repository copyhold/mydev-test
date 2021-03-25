<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specie extends Model
{
    use HasFactory;

    public function films()
    {
      return $this->belongsToMany(Film::class);
    }
    public function peoples()
    {
      return $this->belongsToMany(People::class);
    }
}
