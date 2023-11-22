@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Special Products/</span> Create</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add Special Products</h5>
                {{-- <small class="text-muted float-end">Default label</small> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('spicial_pro.store')}}" enctype="multipart/form-data">
                    @csrf
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
                        <label class="form-label" for="Name">Name</label>
                        <input type="text" class="form-control" id="Name" placeholder="Name" name="name" required/>
                    </div>
                <div class="mb-3">
                    <label class="form-label" for="title">Image </label>
                    <input type="file" class="form-control" name="image">
                </div>
                    <div class="mb-3">
                        <label class="form-label" for="Desc">Desc</label>
                        <input type="text" class="form-control" id="Desc" placeholder="Desc" name="desc" required/>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
