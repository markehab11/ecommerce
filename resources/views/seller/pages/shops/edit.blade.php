@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Shop/</span> Edit</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Shop</h5>
                        {{-- <small class="text-muted float-end">Default label</small> --}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.shops.update', $seller->id) }}"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <strong>Error!</strong> {{ $error }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if (session()->has('message'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ session()->get('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Seller Name" name="name" value="{{$seller->name}}" required/>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password"/>
                            </div>




                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label" for="shop_name">Shop Name</label>
                                    <input type="text" class="form-control" id="shop_name" placeholder="Shop Name" name="shop_name" value="{{$seller->shop->name}}" required/>
                                </div>

                                <div class="col">
                                    <label class="form-label" for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" placeholder="Phone Number" value="{{$seller->shop->phone_number}}" name="phone_number"/>
                                </div>

                                <div class="col">
                                    <label class="form-label" for="address">Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="{{$seller->shop->address}}" required/>
                                </div>
                            </div>



                    <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
        integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection
