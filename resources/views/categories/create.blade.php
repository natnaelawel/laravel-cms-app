@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">

        <div class="card card-default">

            <div class="card-header">
                {{ isset($category) ? 'Edit Category' : 'Create Category' }}</div>
            <div class="card-body">
                @include('partials.errors')
                <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}"
                        method="post">
                        @if (isset($category))
                        @method('put')
                        @endif
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                            <input type="text" id="name" class="form-control", name="name" value="{{ isset($category) ?  $category->name : ''}}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success">
                                    {{ isset($category) ? 'Update Category' : 'Add Category' }}</div>
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection
