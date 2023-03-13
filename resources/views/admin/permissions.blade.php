@extends('admin.layouts.app',['page_title' => 'Permission','page_action' => route('create-permission'),'manage'=>'Roles','manage_action' => route('roles')])

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
                        <th scope="col">Role</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($permissions as $permission)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->description }}</td>
                        
                        <td><a href="{{route('edit-permission',$permission->id) }}" title="view"><i class="far fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6">
        {{ $permissions->links() }}
        </div>
    </div>
    
</div>

@endsection