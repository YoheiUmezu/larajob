@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update a job</div>
                <div class="card-body">
                <form action="{{route('edit-jobs.update',[$job->id])}}" method="POST">@csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$job->title}}" required autocomplete="title" autofocus >
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="" cols="30" rows="10" class="form-control" >{{$job->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <textarea name="roles" id="" cols="30" rows="10" class="form-control" >{{$job->roles}}</textarea>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="" class="form-control">
                    @foreach(App\Category::all() as $cat)
                        <option value="{{$cat->id}}" {{$cat->id==$job->category_id?'selected':''}}>{{$cat->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="position">Position:</label>
                <input type="text" name="position" class="form-control" value="{{$job->position}}">
            </div>
            <div class="form-group">
                <label for="address">Adress:</label>
                <input type="text" name="address" class="form-control" value="{{$job->address}}" >
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <select name="type" class="form-control" id="">
                <option value="fulltime"{{$job->type=='fulltime'?'selected':''}}>fulltime</option>
                <option value="partime"{{$job->type==''?'selected':''}}>partime</option>
                <option value="casual"{{$job->type=='casual'?'selected':''}}>casual</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" class="form-control" id="">
                    <option value="1"{{$job->status=='1'?'selected':''}}>Live</option>
                    <option value="0"{{$job->status=='0'?'selected':''}}>Draft</option>
                </select>
            </div>
            <div class="form-group">
                <label for="lastdate">Last date:</label>
                <input type="date" name="last_date" class="form-control" value="{{$job->last_date}}">
            </div>
            <div class="form-group">
               <button type="submit" class="btn btn-dark">Submit</button>
            </div>
            @if(Session::has('message'))
                <div class="alert alert-dark">
                    {{Session::get('message')}}
                </div>
            @endif
        </div>
        </form>
            </div>
        </div>
    </div>
</div>
@endsection
