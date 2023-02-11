@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>Update task</h2></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif




                        <div class="row">
                            <div class="col-md-8">
                                <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                                    <form method="POST" action="{{ route('update.task', $todo->id) }}">
                                        <input name="_method" type="hidden" value="PUT">
                                        @csrf
                                        <div class="form-group pb-4">
                                            <label for="name">Task Name</label>
                                            <input type="text" name="name" value="{{$todo->name}}" class="form-control">
                                        </div>
                                        <div class="form-group pb-4">
                                            <label for="description">Description</label>
                                            <input type="text" name="description" value="{{$todo->description}}" class="form-control">
                                        </div>
                                        <div class="form-group pb-4">
                                            <label for="description">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="pending" {{$todo->status == 'pending'? 'selected': ''}}>Pending</option>
                                                <option value="in-progress" {{$todo->status == 'in-progress'? 'selected': ''}}>In-Progress</option>
                                                <option value="completed" {{$todo->status == 'completed'? 'selected': ''}}>Completed</option>
                                            </select>
                                        </div>
                                        <a href="{{route('dashboard')}}" class="btn btn-primary">Back</a>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
