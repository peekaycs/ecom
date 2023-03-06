@extends('admin.layouts.app',['page_title' => 'My Profile','manage'=>'Update','manage_action' => route('admin-profile-edit')])

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
                        <td><strong>First Name</strong></td>
                        <td>{{ $user->first_name ?? '' }}</td>
                        <td><strong>Last Name</strong></td>
                        <td>{{ $user->last_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Email</strong></td>
                        <td>{{ $user->email ?? '' }}</td>
                        <td><strong>Mobile</strong></td>
                        <td>{{ $user->mobile ?? '' }}</td>
                    </tr>

                    <tr>
                        <td><strong>Age</strong></td>
                        <td>{{ $user->userProfile->age ?? '' }}</td>
                        <td><strong>Gender</strong></td>
                        <td>{{ $user->userProfile->gender ?? '' }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center"><strong>Address</strong></td>
                        
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td>{{ $user->userAddress[0]->address ?? '' }}</td>
                        <td><strong>City</strong></td>
                        <td>{{ $user->userAddress[0]->city ?? '' }}</td>
                    </tr>
                    <tr>
                        <td><strong>State</strong></td>
                        <td>{{ $user->userAddress[0]->state ?? '' }}</td>
                        <td colspan="2"><a href="{{route('admin-profile-edit')}}" class="btn btn-warning">Update</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection