@extends('layouts.app')

@section('content')
<div class="row justify-content-center col-md-12">
    <div class="col-md-12">
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('posts.create') }}" class="btn btn-success float-right">Add Post</a>
        </div>
        <div class="card card-default">
            <div class="card-header">Posts</div>

            <div class="card-body">
                <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                {{-- <td>{{ $loop->index + 1}}</td> --}}
                                <td><img width="120px" height="100px"  src="{{ asset($post->image) }}" alt="post-image"></td>
                                <td>{{ $post->title}}</td>
                                <td class="d-flex justify-content-center">
                                    <a href="{{route('posts.edit', $post->id)}}" class="btn btn-sm btn-info mx-3 text-white">Edit</a>
                                    <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger btn-sm text-white" >Trash</button>
                                    </form>
                                    {{-- <a type="button" class="btn btn-danger btn-sm text-white" onclick="handleDelete({{ $post->id}})" data-toggle="modal" data-target="#deleteModal">Trash</a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Button trigger modal -->
                        <!-- Modal -->
                <form action="" id="deleteForm" method="post">
                    @csrf
                    @method('delete')
                    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Post</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body text-center text-bold alert alert-danger">
                                    Are You Sure You want to Delete this post?
                            </div>
                            <div class="modal-footer">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Close</button>
                                <button type="submit" class="btn btn-danger" >Yes, Delete</button>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
