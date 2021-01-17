<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom','annee','acteurs'
    ];

    public function getActeursAttribute($value)
    {
        return unserialize($value);
    }

}
