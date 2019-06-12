<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract; // this is an interface
use Illuminate\Auth\MustVerifyEmail; // this the trait
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Profile;
use App\Company;

class User extends Authenticatable implements MustVerifyEmailContract

{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile(){
        return $this->hasOne(Profile::class);
        }

    public function company(){
        return $this->hasOne(Company::class);
        }

    public function favourites(){//1人のユーザーは複数の仕事セーブ出来るし、複数のユーザーも同様にたくさんセーブできるからmanytomany
        return $this->belongsToMany(Job::class,'favourites','user_id','job_id')->withTimeStamps();//favourites tableにも言及する必要がある
    }


}
