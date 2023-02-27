@extends('admin.layouts.app',['page_title' => 'Products','action_title' => 'Add product','page_action' => route('create-product'),'manage'=>'Add attribute','manage_action' => route('create-attribute')])

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Order</th>
                        <th scope="col">Show in menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{--
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $category->category }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ Str::limit($category->description, 50) }}</td>
                        <td>{{ $category->status ? "Enabled" : "Disabled" }}</td>
                        <td>{{ $category->order }}</td>
                        <td>{{ $category->visibility ? "Visible" : "Invisible" }}</td>
                        <td>
                            <a href="{{route('edit-category', $category->uuid)}}" title="view"><i class="far fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    --}}
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6">
        {{-- {{ $categories->links() }} --}}
        </div>
    </div>
    
</div>
@endsection