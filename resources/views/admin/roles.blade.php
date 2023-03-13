@extends('admin.layouts.app',['page_title' => 'Roles','page_action' => route('create-role'),'manage'=>'Roles','manage_action' => route('roles')])

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
                    @foreach($roles as $role)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->description }}</td>
                        
                        <td><a href="{{route('edit-role',$role->id) }}" title="view"><i class="far fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6">
        {{ $roles->links() }}
        </div>
    </div>
    
</div>

@endsection