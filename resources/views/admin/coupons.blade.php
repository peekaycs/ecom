@extends('admin.layouts.app',['page_title' => 'Coupons','page_action' => route('create-coupon')])

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
                        <th scope="col">Code</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Description</th>
                        <th scope="col">Discount Type</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coupons as $coupon)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $coupon->name }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->amount }}</td>
                        <td>{{ $coupon->quantity }}</td>
                        <td>{{ $coupon->description }}</td>
                        <td>{{ ucfirst($coupon->discount_type) }}</td>
                        <td>{{ $coupon->start_date }}</td>
                        <td>{{ $coupon->end_date }}</td>
                        <td>
                            <a href="{{route('edit-coupon',$coupon->id) }}" title="view"><i class="far fa-eye"></i></a>
                            <form class="delete-form" method="post" action="{{route('delete-coupon',$coupon->id)}}" onsubmit="return confirm('Do you want to delete?')" >
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{$coupon->id}}" />
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
        {{ $coupons->links() }}
        </div>
    </div>
    
</div>

@endsection