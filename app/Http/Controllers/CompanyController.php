<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\Job;
class CompanyController extends Controller
{
    //
    // public function index($id, Company $name){
    //     return view('company.index',compact('name'));//compactは全部持ってくる
    // }
    public function __construct(){
        $this->middleware('employer',['except'=>array('index')]);//indexだけは見ることができる
    }

    public function index($id, Company $company){
        return view('company.index',compact('company'));//companyの情報全部持ってくる
    }

    public function create(){
        return view('company.create');
    }

    public function store(Request $request){

        $user_id = auth()->user()->id;
        Company::where('user_id',$user_id)->update([
            'address'=>request('address'),
            'phone'=>request('phone'),
            'website'=>request('website'),
            'slogan'=>request('slogan'),
            'description'=>request('description')
        ]);
        return redirect()->back()->with('message','Company Successfully Updated !');
    }

    public function coverPhoto(Request $request){
        $user_id = auth()->user()->id;//今ログインしてるユーザーのid
        if($request->hasfile('cover_photo')){//もしファイルがあって
            $file = $request->file('cover_photo');//ファイルがcover photoだったら
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;//ファイル名をnumericで保存しますよ
            $file->move('uploads/coverphoto/', $filename);//public folder配下
            Company::where('user_id',$user_id)->update([
                'cover_photo'=>$filename//テーブルのcover photoのところに入れますよ
            ]);
            return redirect()->back()->with('message','Company cover photo successfully updated!');
        }

    }
    public function companyLogo(Request $request){
        $user_id = auth()->user()->id;//今ログインしてるユーザーのid
        if($request->hasfile('company_logo')){//もしファイルがあって
            $file = $request->file('company_logo');//ファイルがcover photoだったら
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;//ファイル名をnumericで保存しますよ
            $file->move('uploads/logo/', $filename);//public folder配下
            Company::where('user_id',$user_id)->update([
                'company_logo'=>$filename//テーブルのcompany logoのところに入れますよ
            ]);
            return redirect()->back()->with('message','Company logo photo successfully updated!');
        }

    }
}
