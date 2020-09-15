<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        '_id',
        'title',
        'description',
        'director',
        'producer',
        'release_date',
        'rt_score',
    ];

    public function peopleFilm()
    {
        return $this->hasMany(PeopleFilm::class);
    }
}
