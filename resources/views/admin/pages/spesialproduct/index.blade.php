@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">App Data /</span> Special Products</h4>

        <div class="card">
            <div class="table-header d-flex align-items-center">
                <h5 class="card-header">Special Products</h5>
                <a href="{{route('spicial_pro.create')}}" class="btn btn btn-primary ms-auto me-3">Add Special Product</a>
            </div>
            <div class="card-body pt-0">
                <div class="text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>#</th>
                                <th class="col-9">Name</th>
                                <th class="col-9">Image</th>
                                <th class="col-9">Desc</th>
                                <th class="col-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($spesial_products as $spesial_product)
                                <tr>
                                    <td>{{$spesial_product->id}}</td>
                                    <td>{{$spesial_product->name}}</td>
                                    <td><img src="{{asset('images/specialpro/'. $spesial_product->image ) }}" alt="" width="60" height="60"></td>
                                    <td>{{$spesial_product->desc}}</td>
                                    <td>
                                        <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('spicial_pro.edit',$spesial_product->id)}}"
                                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                            >
                                            {{-- @if ($category->deleted_at != null)
                                                <form action="{{route('admin.categories.restore',$category)}}" method="POST">
                                                    @csrf
                                                    <button class="dropdown-item" onclick="return confirm('Warning ! The category will be Restored')"><i class="bx bx-archive-out me-1"></i> Restore</button>
                                                </form>
                                            @else
                                                <form action="{{route('admin.categories.softDelete',$category)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" onclick="return confirm('Warning ! The category will be Archived')"><i class="bx bx-archive-in me-1"></i> Archive</button>
                                                </form>
                                            @endif --}}

                                            {{-- <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a> --}}
                                            <form action="{{route('spicial_pro.destroy',$spesial_product->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" onclick="return confirm('Warning ! The category will be permanently deleted ')"><i class="bx bx-trash me-1"></i> Delete</button>
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
            </div>
        </div>



</div>
@endsection
