@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card card-default">

            <div class="card-header">
                My Profile
            </div>
            <div class="card-body">
                @include('partials.errors')
                <form action="{{ route('users.update-profile')}}"
                        method="post">
                        @method('put')
                        @csrf

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" class="form-control", name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" class="form-control", name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="about">About</label>
                        <textarea name="about" id="about" cols="30" rows="10" class="form-control" placeholder="About"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Save Changes</div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
