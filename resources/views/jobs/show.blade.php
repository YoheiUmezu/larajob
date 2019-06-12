@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
                @if(Session::has('message'))
                <div class="alert alert-dark">
                    {{Session::get('message')}}
                </div>
                @endif
            <div class="card">
                <div class="card-header">{{$job->title}}</div>
                <p></p>
                    <h3>Description</h3>
                    <p>{{$job->description}}</p>
                    <p>
                        <h3>Duties</h3>{{$job->roles}}
                    </p>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Short Info</div>

                <div class="card-body">
                    <p>Company:<a href="{{route('company.index',[$job->company->id, $job->company->slug])}}">{{$job->company->cname}}</a></p>
                    <p>Address:{{$job->address}}</p>
                    <p>Employment Type:{{$job->type}}</p>
                    <p>Position:{{$job->position}}</p>
                    <p>Posted:{{$job->created_at->diffForHumans()}}</p>
                    <p>Last Date to apply:{{date('F d, Y', strtotime($job->last_date))}}</p>
                </div>
            </div>
            @if(Auth::check()&&Auth::user()->user_type=='seeker')


            @if(!$job->checkApplication())
            <apply-component :jobid={{$job->id}}></apply-component>
            @endif
            <br>
            <favourite-component :jobid={{$job->id}} :favourited={{$job->checkSaved()?'true':'false'}}></favourite-component>
            @endif
        </div>

    </div>
</div>
@endsection
