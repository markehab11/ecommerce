@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">SubCategory/</span> Edit</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit SubCategory</h5>
                {{-- <small class="text-muted float-end">Default label</small> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.subcategories.update',$subcategory)}}" enctype="multipart/form-data">
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
                <div class="mb-3">
                    <label class="form-label" for="title">Title Ar</label>
                    <input type="text" class="form-control" id="title" placeholder="Title with arabic" value="{{$subcategory->title}}" name="title"/>
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" name="category_id" id="category_id"  aria-label="Default select example" required>
                        <option value="0" selected disabled>select category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $category->id == $subcategory->category_id ? 'Selected' : '' }}>
                            {{ $category->title }}</option>                        @endforeach
                    </select>
            </div>
                <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
