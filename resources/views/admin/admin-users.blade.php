@extends('admin.layouts.app',['page_title' => 'Admin Users','page_action' => route('create-admin-user'),'manage'=>'Admin Users','manage_action' => route('create-admin-user')])

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
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->mobile }}</td>
                        <td><a href="{{route('edit-admin-user',$user->id) }}" title="view"><i class="far fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6">
        {{ $users->links() }}
        </div>
    </div>
    
</div>

@endsection