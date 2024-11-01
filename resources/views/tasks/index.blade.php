@extends('layouts.app')

@section('content')
    <br>
    <a class="btn btn-primary" href="{{route('tasks.create')}}" role="button">Create</a>
    <br>
    <br>

    <form>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <input type="text" name="query" class="form-control" value="{{request('query')}}"
                           placeholder="Search by title,id ">
                </div>
            </div>
            <div class="col">
                <select class="form-control" name="option">
                    <option value="all" selected>All</option>
                    <option value="1" @selected(request('option',false) == 1)>выполнена</option>
                    <option value="0" @selected(request('option',false) == 0 && is_numeric(request('option')))>не
                        выполнена</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <div class="table-responsive mt-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Completed</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($tasks as $task)
                <tr>
                    <th scope="row">{{$task->id}}</th>
                    <td>{{$task->title}}</td>
                    <td>{{$task->description}}</td>
                    <td>
                        @if($task->completed)
                            <span class="badge badge-success">выполнена</span>
                        @else
                            <span class="badge badge-danger">не выполнена</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{route('tasks.edit',$task)}}" class="btn btn-sm btn-info">Edit</a>
                            @if(!$task->completed)
                                <a href="{{route('tasks.complete',$task)}}" class="btn btn-outline-success btn-sm ml-2">
                                    Done</a>
                            @endif
                            <form action="{{route('tasks.destroy',$task)}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="ml-2 btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
