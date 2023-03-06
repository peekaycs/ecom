@extends('admin.layouts.app',['page_title' => 'brands','page_action' => route('create-brand'),'manage'=>'Products','manage_action' => route('products')])

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
                        <th scope="col">Brand</th>
                        <th scope="col">Description</th>
                        <th scope="col">Order</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $brand)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $brand->brand }}</td>
                        <td>{{ $brand->description }}</td>
                        <td>{{ $brand->order }}</td>
                        <td><a href="{{route('edit-brand',$brand->id) }}" title="view"><i class="far fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6">
        {{ $brands->links() }}
        </div>
    </div>
    
</div>

@endsection