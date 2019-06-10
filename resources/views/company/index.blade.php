@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
       <div class="company-profile">
            @if(empty($company->cover_photo))
            <img src="{{asset('cover/gtalent.png')}}" alt="" style="width: 100%;">
            @else
            <img src="{{asset('uploads/coverphoto/')}}/{{$company->cover_photo}}" style="width: 100%;" alt="">
            @endif
            <div class="company-desc">
                 @if(empty($company->company_logo))
                    <img src="{{asset('avatar/man.jpg')}}" width="100"  alt="">
                @else
                    <img src="{{asset('uploads/logo/')}}/{{$company->company_logo}}"  alt="">
                @endif
                <p>{{$company->description}}</p>
                <h1>{{$company->cname}}</h1>
                    <p>Slogan-{{$company->slogan}}&nbsp;Address-{{$company->address}}
                    &nbsp; Phone-{{$company->phone}}&nbsp; Website-{{$company->website}}</p>
            </div>
       </div>
       <table class="table">
            <thead>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                @foreach($company->jobs as $job)
                <tr>
                    <td><img src="{{asset('avatar/man.jpg')}}" width="80"></td>
                    <td>Position:{{$job->position}}
                        <br>
                        <i class="fa fa-clock" aria-hidden="true"></i>&nbsp;{{$job->type}}
                    </td>
                    <td><i class="fa fa-map-marker" aria-hidden="true"></i>Address:{{$job->address}}</td>
                    <td>
                        <i class="fa fa-globe" aria-hidden="true"></i>&nbsp;Date:{{$job->created_at->diffForHumans()}}
                    </td>
                    <td><a href="{{route('jobs.show',[$job->id,$job->slug])}}"><button class="btn btn-success">Apply</button></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
