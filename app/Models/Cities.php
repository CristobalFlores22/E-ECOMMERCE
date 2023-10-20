<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cities extends Model
{
    use HasFactory;
    protected $fillable =[
        'name','states_id'
   ];
    public function states(){

        return $this->belongsTo(states::class); 
    }
}
