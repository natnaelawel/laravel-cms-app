@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card card-default">

            <div class="card-header">
                {{ isset($tag) ? 'Edit Tag' : 'Create Tag' }}</div>
            <div class="card-body">
                @include('partials.errors')
                <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}"
                        method="post">
                        @if (isset($tag))
                        @method('put')
                        @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                            <input type="text" id="name" class="form-control", name="name" value="{{ isset($tag) ?  $tag->name : ''}}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">
                                    {{ isset($tag) ? 'Update Tag' : 'Add Tag' }}</div>
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection
