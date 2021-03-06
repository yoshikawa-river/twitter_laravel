<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Post;
use Auth;
use App\Models\Like;
use App\Models\Reply;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function posts() 
    {
        return $this->hasMany(Post::class);
    }

    public function likes() 
    { 
       return $this->hasMany(Like::class);
    }

    public function updateProfile($data, $path)
    {
        $user = \Auth::user();
        $user->name = $data['name'];
        $user->prof_img = $path[1];
        $user->comment = $data['comment'];
        $user->save();
    }

    public function getUserId($id) 
    {
        $user = User::where('id', $id)->first();
        return $user;
    }
}
