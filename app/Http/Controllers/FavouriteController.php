<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;

class FavouriteController extends Controller
{
    public function saveJob($id){
        $jobId = Job::find($id);
        $jobId->favourites()->attach(auth()->user()->id);//情報を入れる
        return redirect()->back();
    }

    public function unSaveJob($id){
        $jobId = Job::find($id);
        $jobId->favourites()->detach(auth()->user()->id);//情報をデリートする
        return redirect()->back();
    }
}
