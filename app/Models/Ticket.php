<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ticket extends Model implements TranslatableContract
{
    use HasFactory,SoftDeletes,Translatable;

    public $translatedAttributes = ['name','description','owner_name'];


    protected $guarded = [];


    public function getImageAttribute($value)
    {
        return 'https://picsum.photos/800/600'; //todo change to dynamic url
    }
}
