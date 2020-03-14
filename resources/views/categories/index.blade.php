@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="d-flex justify-content-end mb-2">
            <a href="{{ route('categories.create') }}" class="btn btn-success float-right">Add Category</a>
        </div>
        <div class="card card-default">
            <div class="card-header">Categories</div>

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
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->index + 1}}</td>
                                <td>{{ $category->name}}</td>
                                <td>
                                    {{-- if we call the posts() it will give a query builder
                                        for example $category->posts()->where('id', $category_id)->get() --}}
                                    {{$category->posts->count()}}
                                </td>
                                <td class="d-flex justify-content-end">
                                    <a href="{{route('categories.edit', $category->id)}}" class="btn btn-sm btn-info mx-3 text-white">Edit</a>
                                    <a type="button" class="btn btn-danger btn-sm text-white" onclick="handleDelete({{ $category->id}})" data-toggle="modal" data-target="#deleteModal">Delete</a>
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
                            <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body text-center text-bold alert alert-danger">
                                    Are You Sure You want to Delete this category?
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
            // form.action = '/categories/'+id;
            $('#deleteForm').attr('action', '/categories/'+id);
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
