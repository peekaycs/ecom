@extends('admin.layouts.app',['page_title' => 'My Profile'])

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <!-- <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead> -->
                <tbody>
                    <tr>
                        <td>First Name</td>
                        <td>{{ $user->first_name ?? '' }}</td>
                        <td>Last Name</td>
                        <td>{{ $user->last_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $user->email ?? '' }}</td>
                        <td>Mobile</td>
                        <td>{{ $user->mobile ?? '' }}</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection