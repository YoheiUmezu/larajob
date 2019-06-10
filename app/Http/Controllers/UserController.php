<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
class UserController extends Controller
{
    //
    public function __construct(){
        $this->middleware('seeker');//会社側はユーザーのページをいじれない
    }

    public function index(){
        return view('profile.index');
    }

    

    public function store(Request $request){
        $this->validate($request,[//validationに関する記述
            'address'=>'required',
            'bio'=>'required|min:20',
            'experience'=>'required|min:20',//最低でも20文字以上
            'phone_number'=>'required|min:10|numeric'//数字の時はnumeric使う
            //'phone_number'=>'required|regex:/(01)[0-9]{9}'//01から始まって全部で9個の文字にしないとinvalid
        ]);
        $user_id = auth()->user()->id;//クエリを書く
        Profile::where('user_id',$user_id)->update([//profileテーブルに付け足す情報
            'address'=>request('address'),
            'experience'=>request('experience'),
            'bio'=>request('bio'),
            'phone_number'=>request('phone_number')
        ]);
        return redirect()->back()->with('message','Profile Successfully Updated !');
    }

    public function coverletter(Request $request){
        // $this->validate($request,[
        //     'cover_letter'=>'required|mimes:pdf,doc,docx|max:20000'//fileの形式とデータ容量を指定する
        // ]);
        $user_id = auth()->user()->id;
        $cover = $request->file('cover_letter')->store('public/files');//public ディレクトリにファイルを入れる
        Profile::where('user_id',$user_id)->update([
            'cover_letter'=>$cover
        ]);
        return redirect()->back()->with('message','Cover letter Successfully Updated !');
    }

    public function resume(Request $request){
        // $this->validate($request,[
        //     'resume'=>'required|mimes:pdf,doc,docx|max:20000'//fileの形式とデータ容量を指定する
        // ]);
        $user_id = auth()->user()->id;
        $resume = $request->file('resume')->store('public/files');//public ディレクトリにファイルを入れる
        Profile::where('user_id',$user_id)->update([
            'resume'=>$resume
        ]);
        return redirect()->back()->with('message','Resume Successfully Updated !');
    }

    public function avatar(Request $request){
        // $this->validate($request,[
        //     'avatar'=>'required|mimes:png, jpg, jpeg|max:20000'//fileの形式とデータ容量を指定する
        // ]);
        $user_id = auth()->user()->id;
        if($request->hasfile('avatar')){
            $file = $request->file('avatar');
            $ext = $file->getClientOriginalExtension();//original nameでファイルが登録される
            $filename = time().'.'.$ext;
            $file->move('uploads/avatar/', $filename);
            Profile::where('user_id',$user_id)->update([
                'avatar'=>$filename
            ]);
            return redirect()->back()->with('message','Profile Picture Successfully Updated !');
        }
    }
}
