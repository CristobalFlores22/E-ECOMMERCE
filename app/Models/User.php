<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Models\Phone;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function profile(){

        return $this->hasOne(Profile::class);
    
    }
    
    public function level(){

        return $this->belongsTo(level::class);
    
    }

    public function groups(){

        return $this->belongsToMany(Group::class)->withTimestamps();

    }

    public function location(){

        return $this->hasOneThrough(Location::class, Profile::class);

    }

    public function tag(){

        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function user(){

        return $this->morphedByMany(User::class, 'taggable');
        
    }
    public function posts():HasMany{

        return $this->hasMany(Post::class);

    }
    public function videos():HasMany{

        return $this->hasMany(Video::class);

    }
    public function comments():HasMany{

        return $this->hasMany(Comemment::class);

    }
    
    public function image():MorphOne{

        return $this->morphOne(Image::class, 'imageable');
        
    }
    public function cities(){

        return $this->belongsTo(Cities::class);
        
    }

    public function githubAccount(){

        return $this->hasOne(GithubAccount::class);
    }

    public function phone()
    {
        return $this->morphOne(Phone::class, 'phoneable');
    }

    public function phoneable()
    {
        return $this->morphTo();
    }

    public function gender(){

        return $this->belongsTo(Gender::class);
    
    }

}
