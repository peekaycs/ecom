@extends('admin.layouts.app',['page_title' => 'Order Detail','action_title' => 'Orders','page_action' => route('orders')])

@section('content')
<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('order-update',$order->id)}}">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        @method('put')
        <div class="card-body">
           
            <div class="card-sub">
                <h3>Customer Detail</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Sign Up Date</th>
                            <th>Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$order?->user?->first_name }} {{$order?->user?->last_name }}</td>
                            <td>{{$order?->user?->email }}</td>
                            <td>{{$order?->user?->mobile }}</td>
                            <td>{{$order?->user?->created_at }}</td>
                            <td><a href="{{route('edit-admin-user', $order->user?->id)}}">View Detail</a></td>
                            
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            <div class="card-sub">
                <h3>Shipping Detail</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    
                    <tbody>
                        <tr>
                            <td>{{$order->shipping_address}}</td>
                            
                            
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            <div class="card-sub">
                <h3>Order Detail</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Order Date</th>
                        <th scope="col">Order Amount</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Payment Mode</th>   
                        <th scope="col">Shipping Status</th>
                        <!-- <th>Action</th>   -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td>{{ $order->created_at }}</td>
                        <td>₹ {{ $order->payable_amount }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->payment_mode }}</td>
                        <td>{{ucfirst(strtolower($order->shipping_status))}}</td>
                            <!-- <td><a href="{{route('admin-profile', $order->user?->uuid)}}">View Detail</a></td> -->
                            
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            <div class="card-sub">
                <h3>Products</h3>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>   
                        <th scope="col">Discount</th>
                        <th scope="col">Shipping cost</th>
                        <th scope="col">Commission</th>
                        <th scope="col">Total cost</th>
                        <!-- <th>Action</th>   -->
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($order->orderDetails) > 0)
                        @foreach($order->orderDetails as $orderDetail)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$order['products'][$orderDetail->product_id]?->product}}</td>
                            <td>{{ $orderDetail->quantity }}</td>
                            <td>₹ {{ $orderDetail->price }}</td>
                            <td>{{ $orderDetail->discount }}</td>
                            <td>₹ {{ $orderDetail->shipping }}</td>
                            <td>₹ {{ $orderDetail->commission ?? 0 }}</td>
                            <td>₹ {{ $orderDetail->total_price }}</td>
                                <!-- <td><a href="{{route('admin-profile', $order->user?->uuid)}}">View Detail</a></td> -->
                            
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <!-- <div class="card-sub">
                <h3>Payment Detail</h3>
            </div>
            <div class="table-responsive">
                
            </div> -->
        </div>
        <div class="card-action text-right">
            <!-- <button type="submit" class="btn btn-success">Submit</button> -->
            <!-- <a href="{{route('orders')}}" class="btn btn-danger">Cancel</a> -->
        </div>
        </form>
    </div>
</div>
@endsection
