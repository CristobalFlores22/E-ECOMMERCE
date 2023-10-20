<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;
    protected $fillable =[
        'instagram',
        'github',
        'web',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function location(){

        return $this->hasOne(Location::class);

    }
}
