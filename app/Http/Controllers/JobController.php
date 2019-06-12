<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Company;
use App\Http\Requests\JobPostRequest;
use Auth;

class JobController extends Controller
{
    public function __construct(){
        $this->middleware(['employer','verified'],['except'=>array('index','show','apply', 'allJobs','searchJobs')]);//indexとshowだけは見ることができる　applyも観ることtが出来る（下のaplly methodを参照）
    }
    //
    public function index(){
        //$jobs = Job::all()->take(10);//10件だけデータを取ってくる
        $jobs = Job::latest()->limit(10)->where('status',1)->get();//statusが1の中から新しい順に10個のリストを取ってくる
        //$companies = Company::latest()->limit(12)->get();//最新から12個
        $companies = Company::get()->random(12);//ランダムに12個表示する
        return view('welcome',compact('jobs', 'companies'));//welcome.blade.phpの内容を持ってきて表示する
    }

    public function show($id,Job $job){//web.phpで宣言したやつ(Job)はモデル　use App\Job
        //$job=Job::find($id);
        //dd($job->id);//jobの情報を持ってくる上のコードでもok idの値を返す　jobモデルから情報を持ってくる
        return view('jobs.show',compact('job'));//sho.blade.phpの内容を表示する
    }

    public function company(){
        return view('company.index');
    }

    public function create(){
        return view('jobs.create');
    }

    public function edit($id)
    { $job = Job::findOrFail($id);
        return view('edit-jobs.edit',compact('job')); }

    public function update(Request $request,$id){
        //dd($request->all());//getする情報を表示する
        $job = JOB::findOrFail($id);
        $job->update($request->all());
        return redirect()->back()->with('message','Job successfully updated!');
    }

    public function store(JobPostRequest $request){
        $user_id = auth()->user()->id;
        $company = Company::where('user_id', $user_id)->first();//company_idと紐ずいてる
        $company_id = $company->id;
        Job::create([
            'user_id' => $user_id,
            'company_id' => $company_id,
            'title'=>request('title'),
            'slug'=>str_slug(request('title')),//titleの名前と紐づいてる
            'description'=>request('description'),
            'roles'=>request('roles'),
            'category_id'=>request('category'),
            'position'=>request('position'),
            'address'=>request('address'),
            'type'=>request('type'),
            'status'=>request('status'),
            'last_date'=>request('last_date'),
        ]);
        return redirect()->back()->with('message', 'Job posted successfully!');
    }

    public function myjob(){
        $jobs = Job::where('user_id', auth()->user()->id)->get();
        return view('jobs.my-job', compact('jobs'));
    }

    public function apply(Request $request,$id){
        $jobId = Job::find($id);
        $jobId->users()->attach(Auth::user()->id);//one job can have many users, one user can apply many jobs(users_job table)->many to many relationship　app/job.phpにいってrelationshipを書く
        return redirect()->back()->with('message', 'Application sent successfully!');
    }

    public function applicant(){
        $applicants = Job::has('users')->where('user_id',auth()->user()->id)->get();
        return view('jobs.applicants',compact('applicants'));
    }

    public function allJobs(Request $request){
        $keyword = $request->get('title');
        $type = $request->get('type');
        $category = $request->get('category_id');
        $address = $request->get('address');
        if($keyword||$type||$category||$address){
            $jobs = Job::where('title','LIKE','%'.$keyword.'%')//部分一致
                ->orWhere('type',$type)
                ->orWhere('category_id',$category)
                ->orWhere('address')
                ->paginate(10);//もしデータが帰ってこなかったら、10件ずつ表示するリザルトページを返す
                return view('jobs.alljobs',compact('jobs'));
        }else{
        //dd($address);
        $jobs = Job::latest()->paginate(10);
        return view('jobs.alljobs',compact('jobs'));
    }

        }
        public function searchJobs(Request $request){
            $keyword = $request->get('keyword');//keywordはvueから持ってきた
            $users = Job::where('title','like','%'.$keyword.'%')
                    ->orWhere('position','like','%'.$keyword.'%')
                    ->limit(5)->get();
            return response()->json($users);
    }

}
