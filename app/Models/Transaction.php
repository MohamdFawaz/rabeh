<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [];

    public function source()
    {
        return $this->belongsTo(User::class,'source_id');
    }

    public function target()
    {
        return $this->belongsTo(User::class,'target_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class,'currency_id');
    }
}
