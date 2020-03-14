@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                {{ isset($post) ? 'Edit Post' : 'Create Post' }}</div>
            <div class="card-body">
                @include('partials.errors')
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
                        <label for="category">Category</label>
                        <select name="category_id" id="category_id"  class="form-control">
                            @if(isset($categories))
                            @foreach($categories as $category)
                                <option value="{{$category->id}}"
                                    @if(isset($post) && $category->id == $post->category_id)
                                        selected
                                    @endif
                                    >{{ $category->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pub_date">Published Date </label>
                        <input type="date" id="pub_date" class="form-control", name="pub_date" value="{{ isset($post) ?  $post->published_at : now()}}">
                    </div>
                    <div class="form-group">
                        <img src="{{ isset($post) ? asset($post->image) : '#'}}" alt="" style="width:100%">
                    </div>
                    <div class="form-group p-2">
                        <label for="name">Image</label>
                        <input type="file" id="image" class="form-control", name="image" value="{{ isset($post) ?  $post->image : ''}}">
                    </div>
                    @if(isset($tags) && $tags->count()>0)
                        <div class="form-group">
                            <label for="tag">Tags</label>
                            <select name="tags[]" id="tags" class="form-control tag-selector" multiple>
                                @foreach ($tags as $tag)
                                    <option value="{{$tag->id}}"
                                        @if(isset($post))
                                            @if(in_array($tag->id, $post->tags->pluck('id')->toArray()))
                                                selected
                                            @endif
                                        @endif
                                        >{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
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
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
   <script>
       flatpickr("#pub_date",{
           enableTime:true
       });
       $(document).ready(function() {
            $('.tag-selector').select2();
        });
   </script>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.1/trix.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection
