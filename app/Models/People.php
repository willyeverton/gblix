<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method updateOrCreate(array $array, array $people)
 */
class People extends Model
{
    use HasFactory;

    protected $fillable = [
        '_id',
        'name',
        'gender',
        'age',
        'eye_color',
        'hair_color',
    ];

    public function peopleFilm()
    {
        return $this->hasMany(PeopleFilm::class);
    }
}
