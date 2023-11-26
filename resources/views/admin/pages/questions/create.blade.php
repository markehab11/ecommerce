@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Questions/</span> Create</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add Questions</h5>
                {{-- <small class="text-muted float-end">Default label</small> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('questions.store')}}" enctype="multipart/form-data">
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
                        <label class="form-label" for="key">title</label>
                        <input type="text" class="form-control" id="key" placeholder="Title with arabic"
                               name="key" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="title">description</label>
                        <textarea class="form-control" name="value" placeholder="description" required rows="7">

                        </textarea>
{{--                        <input type="text" class="form-control" id="value" placeholder="Value"--}}
{{--                               name="value" required />--}}
                    </div>
                <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
