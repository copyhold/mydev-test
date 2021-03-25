<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = ['title','episode_id','release_date'];
    public function peoples()
    {
      return $this->hasMany(People::class);
    }

    public function species()
    {
      return $this->hasMany(Specie::class);
    }
}
