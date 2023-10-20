<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Phone extends Model
{
    use HasFactory;
    protected $fillable =[
        'phone_number',
   ];

   public function phone(){
    return $this->morphOne('App\Models\Phone','phoneable');
}

    public function phoneable(){
        return $this->morphTo();
    }
}
