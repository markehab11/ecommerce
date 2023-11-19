@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Shop/</span> Create</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Add Shop</h5>
                {{-- <small class="text-muted float-end">Default label</small> --}}
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.shops.store')}}" enctype="multipart/form-data">
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
                    <label class="form-label" for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Seller Name" name="name" required/>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" required/>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password" required/>
                </div>




                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label" for="shop_name">Shop Name</label>
                        <input type="text" class="form-control" id="shop_name" placeholder="Shop Name" name="shop_name" required/>
                    </div>

                    <div class="col">
                        <label class="form-label" for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" placeholder="Phone Number" name="phone_number"/>
                    </div>

                    <div class="col">
                        <label class="form-label" for="address">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="Address" name="address" required/>
                    </div>
                </div>



                <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
{{-- <script>
    function toggleFields() {
        var switchRadio = document.getElementById("switch");
        var rentRadio = document.getElementById("rent");
        var switchFields = document.getElementById("switchFields");
        var rentFields = document.getElementById("rentFields");

        if (switchRadio.checked == true) {
            switchFields.style.display = "block";
            rentFields.style.display = "none";
            // Add code to perform action when switch radio is checked
        } else if (rentRadio.checked == true) {
            switchFields.style.display = "none";
            rentFields.style.display = "block";
            // Add code to perform action when rent radio is checked
        }
    }

    $('#governorate').change(function(){
    var governorate_id = $(this).val();

    $.ajax({
        type: 'GET',
        url: '{{ route("getCities", ["governorate_id" => ":governorate_id"]) }}'.replace(':governorate_id', governorate_id),
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            var cities = response.cities;

            $('#city').empty();
            $.each(cities, function(index, city) {
                $('#city').append('<option value="' + city.id + '">' + city.city_name_ar + '</option>');
            });
        }
            });
    });


</script> --}}
@endsection
