<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        'cname', 'user_id', 'slug', 'address', 'phone', 'website', 'logo', 'cover_photo', 'slogan', 'description'//database上での記述を可能にする
    ];


    public function jobs(){
        return $this->hasMany('App\Job');//comapnyはいくつものjobをpostできる
    }

    public function getRouteKeyName(){
        return 'slug';//slugを持ってこないとidごとに持ってこれない。これで結果が表示される　slugとはファイル名のようなもの
        //slugをidのようなものとして使う
    }
}
