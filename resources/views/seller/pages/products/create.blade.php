@extends('seller.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Product/</span> Create</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add product</h5>
                {{-- <small class="text-muted float-end">Default label</small> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('seller.products.store')}}" enctype="multipart/form-data">
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
                    <label class="form-label" for="title">Title</label>
                    <input type="text" class="form-control" id="title" placeholder="Title with arabic" name="title" required/>
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Description</label>
                    <textarea class="form-control" name="desc" id="desc" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" name="category_id" id="category"  aria-label="Default select example" required>
                                <option value="0" selected disabled>select category</option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->title}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col">
                            <label for="subcategory_id" class="form-label">Subcategory</label>
                            <select class="form-select" name="subcategory_id" id="subcategory"  aria-label="Default select example" required>
                                <option value="0" selected disabled>select subcategory</option>

                            </select>
                        </div>

                        <div class="col">
                            <label for="formFile" class="form-label">Images </label>
                            <input class="form-control" type="file" id="formFile" name="images[]" multiple required/>
                            <div id="defaultFormControlHelp" class="form-text">
                                You can only add 5 images
                            </div>
                        </div>

                    </div>


                </div>




                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="amount">Price</label>
                        <input type="number" class="form-control" id="price" placeholder="Price" name="price" required/>
                    </div>

                    <div class="col">
                        <label class="form-label" for="discount">Discount</label>
                        <input type="number" class="form-control" id="discount" placeholder="Discount" name="discount"/>
                    </div>

                    <div class="col">
                        <label class="form-label" for="duration">Number of Stock</label>
                        <input type="number" class="form-control" id="stock" placeholder="Stock" name="stock" required/>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#category').change(function() {
            var categoryId = $(this).val();

            $.ajax({
                url: '/seller/subcategories/getsubcategory/' + categoryId,
                type: 'GET',
                success: function(data) {
                    $('#subcategory').empty(); // Clear existing options

                    $.each(data, function(index, subcategory) {
                        $('#subcategory').append('<option value="' + subcategory.id + '">' + subcategory.title + '</option>');
                    });
                }
            });
        });
    });
</script>
@endsection
