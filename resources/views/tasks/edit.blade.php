@extends('layouts.app')

@section('content')
    <br>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('tasks.index')}}">Task list</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit - {{$task->title}}</li>
        </ol>
    </nav>
    <form action="{{route('tasks.update',$task->id)}}" method="post">
        @csrf
        @method('put')
        <div class="form-group">
            <label>Title</label>
            <input type="text" class="form-control" name="title" value="{{old('title',$task->title)}}">
            @if($errors->has('title'))
                <small class="form-text text-danger">{{$errors->first('title')}}</small>
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Description</label>
            <textarea class="form-control" name="description">{{old('description',$task->description)}}</textarea>
            @if($errors->has('description'))
                <small class="form-text text-danger">{{$errors->first('description')}}</small>
            @endif
        </div>
        <div class="form-check">
            <input type="checkbox" class="form-check-input" id="completed" name="completed"
                @checked(old('completed',$task->completed))>
            <label class="form-check-label" for="completed">Completed</label>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
@endsection
