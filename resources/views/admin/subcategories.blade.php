@extends('admin.layouts.app',['page_title' => 'Sub Category','action_title' => 'Add','page_action' => route('create-subcategory'),'manage'=>'Category','manage_action' => route('categories')])

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
                        <th scope="col">Sub Category</th>
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
                    @foreach($subCategories as $subCategory)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $subCategory->subcategory }}</td>
                        <td>{{ $subCategory->category[0]->category }}</td>
                        <td>{{ $subCategory->slug }}</td>
                        <td>{{ Str::limit($subCategory->description, 50) }}</td>
                        <td>{{ $subCategory->status ? "Enabled" : "Disabled" }}</td>
                        <td>{{ $subCategory->order }}</td>
                        <td>{{ $subCategory->visibility ? "Visible" : "Invisible" }}</td>
                        <td>
                            <a href="{{route('edit-subcategory', $subCategory->uuid)}}" title="view"><i class="far fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6">
        {{ $subCategories->links() }}
        </div>
    </div>
    
</div>
@endsection