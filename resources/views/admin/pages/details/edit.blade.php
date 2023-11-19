@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">detail/</span> Edit</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Edit detail</h5>
                {{-- <small class="text-muted float-end">Default label</small> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('details.update',$detail->id)}}" enctype="multipart/form-data">
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
                        <label class="form-label" for="title">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Title with arabic"
                               name="title" value="{{ $detail->title }}" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="title">Value</label>
                        <input type="text" class="form-control" id="value" placeholder="Value"
                               name="value" value="{{ $detail->value }}" required />
                    </div>
                <div class="mb-3">
                    <label for="product_id" class="form-label">Product</label>
                    <select class="form-select" name="product_id" id="product_id"
                            aria-label="Default select example" required>
                        <option value="0" selected disabled>select product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"
                                {{ $product->id == $detail->product_id ? 'Selected' : '' }}>
                                {{ $product->title }}</option>
                        @endforeach
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
