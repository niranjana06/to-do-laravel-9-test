@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <h2>Add new task</h2>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
                                    <form method="POST" action="{{ route('store.task') }}">
                                        @csrf
                                        <div class="form-group pb-4">
                                            <label for="name">Task Name</label>
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                        <div class="form-group pb-4">
                                            <label for="description">Description</label>
                                            <input type="text" name="description" class="form-control">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
