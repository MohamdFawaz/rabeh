<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    public $translatedAttributes = ['name', 'description'];

    protected $guarded = [];

    public function getImageAttribute($value)
    {
        return 'https://picsum.photos/800/600'; //todo change to dynamic url
    }
}
