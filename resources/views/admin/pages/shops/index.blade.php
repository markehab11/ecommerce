@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">App Data /</span> Shops</h4>

        <div class="card">
            <div class="table-header d-flex align-items-center">
                <h5 class="card-header">Shops</h5>
                <a href="{{route('admin.shops.create')}}" class="btn btn btn-primary ms-auto me-3">Add Shop</a>
            </div>
            <div class="card-body pt-0">
                <div class="text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Owner</th>
                            <th>Phone Number</th>
                            <th>No.Pro</th>
                            <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($sellers as $seller)
                                <tr>
                                    <td>{{$seller->id}}</td>
                                    <td>{{$seller->shop->name}}</td>
                                    <th>{{$seller->name}}</th>
                                    <th>{{$seller->shop->phone_number}}</th>

                                    <td ><span class="badge bg-warning">{{count($seller->products)}}</span></td>
                                    <td>
                                        <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('admin.shops.edit',$seller->id)}}"
                                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                            >

                                            <form action="{{route('admin.shops.destroy',$seller->id)}}" method="POST">

                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" onclick="return confirm('Warning ! The shop will be permanently deleted ')"><i class="bx bx-trash me-1"></i> Delete</button>
                                            </form>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-0">
                {{$sellers->links('pagination::bootstrap-5')}}
            </div>
        </div>



</div>
@endsection
