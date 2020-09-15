<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeopleFilm extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'film_id',
    ];

    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function film()
    {
        return $this->belongsTo(Film::class);
    }
}
