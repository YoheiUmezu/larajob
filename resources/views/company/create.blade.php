@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @if(empty(Auth::user()->company->company_logo))
                <img src="{{asset('avatar/man.jpg')}}" width="100" style="width: 100%;" alt="">
            @else
                <img src="{{asset('uploads/logo/')}}/{{Auth::user()->company->company_logo}}" style="width: 100%;" alt="">
            @endif
            <br>
            <br>
            <form action="{{route('company.logo')}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="card">
                    <div class="card-header">
                        Upadate logo
                    </div>
                    <div class="card-body">
                        <input type="file" class="form-controller" name="company_logo"><br><br>
                        <button class="btn btn-dark float-right" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>



        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Update Your Company Information
                </div>
                <form action="{{route('company.store')}}" method="POST">@csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Address</label>
                        <input type="text" class="form-control" name="address" value="{{Auth::user()->company->address}}">
                        @if($errors->has('address'))
                            <div class="error" style="color: red;">{{$errors->first('address')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone"  value="{{Auth::user()->company->phone}}">
                        @if($errors->has('phone'))
                            <div class="error" style="color: red;">{{$errors->first('phone')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Website</label>
                        <input type="text" class="form-control" name="website"  value="{{Auth::user()->company->website}}">
                        @if($errors->has('website'))
                            <div class="error" style="color: red;">{{$errors->first('website')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Slogan</label>
                        <input type="text" class="form-control" name="slogan"  value="{{Auth::user()->company->slogan}}">
                        @if($errors->has('slogan'))
                            <div class="error" style="color: red;">{{$errors->first('slogan')}}</div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control" >{{Auth::user()->company->description}}</textarea>
                    </div>



                    <div class="form-group">
                        <button class="btn btn-dark" type="submit">Update</button>
                    </div>
                </div>
            </div>
            @if(Session::has('message'))
            <div class="alert alert-dark">
                {{Session::get('message')}}
            </div>
            @endif
        </div>
        </form>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    About your company
                </div>
                <div class="card-body">
                    <p>Name:{{Auth::user()->company->cname}}</p>
                    <p>Address:{{Auth::user()->company->address}}</p>
                    <p>Phone :{{Auth::user()->company->phone}}</p>
                    <p>Website:<a href="{{Auth::user()->company->website}}">{{Auth::user()->company->website}}</a></p>
                    <p>Slogan:{{Auth::user()->company->slogan}}</p>
                    <p>Company page:<a href="company/{{Auth::user()->company->slug}}">View</a></p>
                </div>
            </div>
            <br>
            <form action="{{route('cover.photo')}}" method="POST" enctype="multipart/form-data">@csrf
            <div class="card">
                <div class="card-header">
                    Upadate cover photo
                </div>
                <div class="card-body">
                    <input type="file" class="form-controller" name="cover_photo"><br><br>
                    @if($errors->has('cover_letter'))
                        <div class="error" style="color: red;">{{$errors->first('cover_letter')}}</div>
                    @endif
                    <button class="btn btn-dark float-right">Upadate</button>
                </div>
            </div>
            </form>


            </div>
            </div>
            </form>

        </div>
    </div>
</div>
@endsection
