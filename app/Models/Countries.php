<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    use HasFactory;
    protected $fillable =[
        'name','states_id'
   ];

   public function states(){
       return $this->hasMany(States::class);
   }
}
