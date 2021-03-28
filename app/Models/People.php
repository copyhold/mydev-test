<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table = 'peoples';
    use HasFactory;

    public function scopeInHeight($query, $min, $max)
    {
      $max = (int)$max;
      $min = (int)$min;
      return $query->when($min > 0, function($q) use($min) {
        $q->where('height', '>', $min);
      })->when($max, function($q) use($max) {
        $q->where('height', '<', $max);
      });
    }
    public function scopeName($query, $name)
    {
      return $query->when(!(empty($name) || $name=='null'), function($q) use($name) {
        $q->where('name', 'like', "%{$name}%");
      });
    }
    public function scopeGender($query, $gender)
    {
      return $query->when(!(empty($gender) || $gender=='null'), function($q) use($gender) {
        $q->where('gender', $gender);
      });
    }
    public function scopeSkinColor($query, $color)
    {
      return $query->when(!(empty($color) || $color=='null'), function($q) use($color) {
        $q->where('skin_color', $color);
      });
    }
    public function scopeEyeColor($query, $color)
    {
      return $query->when(!(empty($color) || $color=='null'), function($q) use($color) {
        $q->where('eye_color', $color);
      });
    }
    public function films()
    {
      return $this->belongsToMany(Film::class);
    }
    public function species()
    {
      return $this->belongsToMany(Specie::class);
    }
}
