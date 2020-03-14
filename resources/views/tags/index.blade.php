@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('tags.create') }}" class="btn btn-success float-right">Add Tag</a>
        </div>
        <div class="card card-default">
            <div class="card-header">Tags</div>

            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Post Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $loop->index + 1}}</td>
                                <td>{{ $tag->name}}</td>
                                <td>
                                    {{-- if we call the posts() it will give a query builder
                                        for example $tag->posts()->where('id', $tag_id)->get() --}}
                                    {{$tag->posts->count()}}
                                </td>
                                <td class="d-flex justify-content-end">
                                    <a href="{{route('tags.edit', $tag->id)}}" class="btn btn-sm btn-info mx-3 text-white">Edit</a>
                                    <a type="button" class="btn btn-danger btn-sm text-white" onclick="handleDelete({{ $tag->id}})" data-toggle="modal" data-target="#deleteModal">Delete</a>
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
                            <h5 class="modal-title" id="deleteModalLabel">Delete Tag</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body text-center text-bold alert alert-danger">
                                    Are You Sure You want to Delete this tag?
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
@section('scripts')
    <script>
        function handleDelete(id){
            // var form = document.getElementById('#deleteForm');
            // form.action = '/tags/'+id;
            $('#deleteForm').attr('action', '/tags/'+id);
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
