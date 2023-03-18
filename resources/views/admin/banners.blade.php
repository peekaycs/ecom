@extends('admin.layouts.app',['page_title' => 'Banners','page_action' => route('create-banner'),'manage'=>'Products','manage_action' => route('products')])

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
                        <th scope="col">Banner Name</th>
                        <th scope="col">Banner Type</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($banners as $banner)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $banner->name }}</td>
                        <td>{{ ucfirst($banner->type) }}</td>
                        <td>{{ $banner->description }}</td>
                        <td>{{ $banner->status }}</td>
                        <td><a href="{{route('edit-banner',$banner->id) }}" title="view"><i class="far fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6">
        {{ $banners->links() }}
        </div>
    </div>
    
</div>

@endsection