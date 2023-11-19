@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">App Data /</span> Products</h4>

        <div class="card">
            <div class="table-header d-flex align-items-center">
                <h5 class="card-header">Products</h5>
                <a href="{{route('admin.products.create')}}" class="btn btn btn-primary ms-auto me-3">Add Product</a>
            </div>
            <div class="card-body pt-0">
                <div class="text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Actions</th>

                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{$product->id}}</td>
                                    <td>{{$product->title}}</td>
                                    <td>

                                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                            @foreach ($product->images as $image)
                                                <li
                                                data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom"
                                                data-bs-placement="top"
                                                class="avatar avatar-xs pull-up"
                                                title="{{$product->title}}"
                                                >
                                                <img src="../images/{{$image->image}}" alt="Avatar" class="rounded-circle" />
                                                </li>
                                            @endforeach

                                        </ul>
                                    </td>
                                    <th>{{$product->price.' LE'}}</th>
                                    <td><span class="badge bg-warning">{{$product->category->title}}</span></td>
                                    <td><span class="badge bg-{{($product->stock != 0)?"success":"danger"}}">{{($product->stock != 0)?"Available":"Out of stock"}}</span></td>
                                    <td>
                                        <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('admin.products.edit',$product->id)}}"
                                            ><i class="bx bx-edit-alt me-1"></i> Edit</a
                                            >
                                            {{-- @if ($product->deleted_at != null)
                                            <form action="{{route('admin.products.restore',$product)}}" method="POST">
                                                @csrf
                                                <button class="dropdown-item" onclick="return confirm('Warning ! The product will be Restored')"><i class="bx bx-archive-out me-1"></i> Restore</button>
                                            </form>
                                            @else
                                                <form action="{{route('admin.products.softDelete',$product)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" onclick="return confirm('Warning ! The product will be Archived')"><i class="bx bx-archive-in me-1"></i> Archive</button>
                                                </form>
                                            @endif --}}
                                            {{-- <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i> Delete</a> --}}
                                            <form action="{{route('admin.products.destroy',$product->id)}}" method="POST">

                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" onclick="return confirm('Warning ! The product will be permanently deleted ')"><i class="bx bx-trash me-1"></i> Delete</button>
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
                {{$products->links('pagination::bootstrap-5')}}
            </div>
        </div>
</div>
@endsection
