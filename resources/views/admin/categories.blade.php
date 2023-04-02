@extends('admin.layouts.app',['page_title' => 'Category','action_title' => 'Add','page_action' => route('create-category'),'manage'=>'Sub Category','manage_action' => route('subcategories')])

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
                            <form class="delete-form" method="post" action="{{route('delete-category',$category->uuid)}}" onsubmit="return confirm('Do you want to delete?')" >
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{$category->uuid}}" />
                                <button type="submit" name="delete" class="delete-button" value="" ><i class="fa- fa-trash fa-trash-alt far m-3"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6">
        {{ $categories->links() }}
        </div>
    </div>
    
</div>
@endsection