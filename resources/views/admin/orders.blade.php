@extends('admin.layouts.app',['page_title' => 'Orders'])

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
                        <th scope="col">Order Id</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Mobile</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Order Amount</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Payment Mode</th>   
                        <th scope="col">Shipping Status</th>
                        <!-- <th scope="col">Order Status</th>                      -->
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $order->user?->order_code }}</td>
                        <td>{{ $order->user?->first_name }}</td>
                        <td>{{ $order->user?->email }}</td>
                        <td>{{ $order->user?->mobile }}</td>
                        <td>{{ $order->created_at }}</td>
                        <td>{{ $order->payable_amount }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->payment_mode }}</td>
                        <td></td>
                        <td>
                        <a href="{{route('order-detail',$order->id) }}" title="view"><i class="far fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6">
        {{ $orders->links() }}
        </div>
    </div>
    
</div>

@endsection