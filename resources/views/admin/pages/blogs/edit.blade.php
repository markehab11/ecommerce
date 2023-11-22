@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Blogs/</span> Edit</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit Blog</h5>
                {{-- <small class="text-muted float-end">Default label</small> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('blogs.update',$blogs->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="form-row">
                                    <div class="col-lg-12">
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <strong>Error!</strong> {{$error}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                            </div>
                        @endforeach
                    @endif
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" class="form-control"  placeholder="name" name="name" value="{{ $blogs->name }}">
                        </div>
                    <br>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file" class="form-control" name="image">
                        </div>
                    <br>
                    <div>
                            <input type="hidden" name="old_image" value="{{ $blogs->image }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" class="form-control" placeholder="title" name="title" value="{{ $blogs->title }}">
                        </div>
                    <br>
                    <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <input type="text" class="form-control" placeholder="description" name="description" value="{{ $blogs->description }}">
                        </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
