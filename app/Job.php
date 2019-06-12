<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    protected $fillable = ['user_id', 'company_id', 'title', 'slug', 'description', 'roles', 'category_id', 'position', 'address', 'type', 'status', 'last_date'];
    //全部編集してok company_idとuser_idは他のテーブルから来てる

    public function getRouteKeyName(){
        return 'slug';//slugを持ってこないとidごとに持ってこれない。これで結果が表示される　slugとはファイル名のようなもの
        //slugをidのようなものとして使う
    }

    public function company(){
        return $this->belongsTo('App\company');//jobsがcompany_idに紐づいてる
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimeStamps();//1つのjobは複数のuserを持つ。
    }

    public function checkApplication(){
        return \DB::table('job_user')->where('user_id',auth()->user()->id)->where('job_id',$this->id)->exists();//もしjob_userテーブルにuser_idが入ってたら
    }

    public function favourites(){//1人のユーザーは複数の仕事セーブ出来るし、複数のユーザーも同様にたくさんセーブできるからmanytomany
        return $this->belongsToMany(Job::class,'favourites','job_id','user_id')->withTimeStamps();//favourites tableにも言及する必要がある
    }

    public function checkSaved(){
        return \DB::table('favourites')->where('user_id',auth()->user()->id)->where('job_id',$this->id)->exists();//もしfavoriteテーブルにuser_idが入ってたら
    }
}
