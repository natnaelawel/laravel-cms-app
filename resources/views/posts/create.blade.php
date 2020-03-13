@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card card-default">

                <div class="card-header">
                    {{ isset($post) ? 'Edit Post' : 'Create Post' }}</div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-group">
                                @foreach ($errors->all() as $error)
                                    <li class="list-group-item text-danger">{{ $error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}"
                         method="post" enctype="multipart/form-data">
                         @if (isset($post))
                            @method('put')
                         @endif
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" id="title" class="form-control", name="title" value="{{ isset($post) ?  $post->title : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" id="description" class="form-control", name="description" value="{{ isset($post) ?  $post->title : ''}}">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <input id="content" type="hidden" name="content" value="{{ isset($post) ?  $post->content : ''}}">
                            <trix-editor input="content"></trix-editor>
                        </div>
                        <div class="form-group">
                            <label for="pub_date">Published Date </label>
                            <input type="date" id="pub_date" class="form-control", name="pub_date" value="{{ isset($post) ?  $post->published_at : ''}}">
                        </div>
                        <div class="form-group">
                        <img src="{{ asset($post->image)}}" alt="" style="width:100%">
                        </div>
                        <div class="form-group p-2">
                            <label for="name">Image</label>
                            <input type="file" id="image" class="form-control", name="image" value="{{ isset($post) ?  $post->image : ''}}">
                        </div>

                        <div class="form-group">
                            <button class="btn btn-success">
                                {{ isset($post) ? 'Update Post' : 'Add Post' }}</div>
                            </button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
   <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
   <script>
       flatpickr("#pub_date",{
           enableTime:true
       });
   </script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
@endsection
