@extends('admin.layouts.app',['page_title' => 'Coupons','action_title' => 'Coupons','page_action' => route('coupons')])

@section('content')
<div class="col-md-12">
    <div class="card">
    <form class="form-horizontal" id="" method="post" action="{{route('store-coupon')}}">
        <div class="card-header">
            <!-- <div class="card-title">Hoverable Table</div> -->
        </div>
        @csrf
        <div class="card-body">
            
            <div class="form-group form-floating-label @error('name') has-error @enderror">
                <input id="" name="name" value="{{old('name')}}" type="text" class="form-control input-border-bottom " required>
                <label for="inputFloatingLabel" class="placeholder">Coupon name</label>
                @error('name')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
           
            <div class="form-group form-floating-label @error('code') has-error @enderror">
                <input id="" name="code" value="{{old('code')}}" type="text" class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Code</label>
                @error('code')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group form-floating-label @error('amount') has-error @enderror">
                <input id="" name="amount" value="{{old('amount')}}" type="number" step="0.1" class="form-control input-border-bottom" required>
                <label for="inputFloatingLabel" class="placeholder">Amount</label>
                @error('amount')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('quantity') has-error @enderror">
                <input id="" name="quantity" value="{{old('quantity')}}" type="number" step="1" class="form-control input-border-bottom">
                <label for="inputFloatingLabel" class="placeholder">Quantity</label>
                @error('quantity')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('discount_type') has-error @enderror">
                <select class="form-control input-border-bottom" name="discount_type" id="discount_type" >
                    <option value=""></option>
                    <option value="fixed">Fixed</option>
                    <option value="percent">Percent</option>
                </select>
                <label for="selectFloatingLabel" class="placeholder">Discount Type</label>
                @error('discount_type')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group form-floating-label @error('description') has-error @enderror">
                <textarea name="description"   class="form-control input-border-bottom @error('name')  @enderror" >{{old('description')}}</textarea>
                <label for="inputFloatingLabel" class="placeholder">Description</label>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="row">
            <div class="form-group col-md-3 col-sm-12 col-lg-6 form-floating-label @error('start_date') has-error @enderror">
                <input id="start_date" name="start_date" value="{{old('start_date')}}" type="date"  class="form-control input-border-bottom">
                <label for="inputFloatingLabel" class="placeholder">Start date</label>
                @error('start_date')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-md-3 col-sm-12 col-lg-6 form-floating-label @error('end_date') has-error @enderror">
                <input id="end_date" name="end_date" value="{{old('end_date')}}" type="date"  class="form-control input-border-bottom">
                <label for="inputFloatingLabel" class="placeholder">End date</label>
                @error('end_date')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            </div>
            <div class="form-group form-floating-label @error('status') has-error @enderror">
                <select class="form-control input-border-bottom" name="status" id="status" required>
                    <option value="1">Enable</option>
                    <option value="0">Disable</option>
                </select>
                <label for="selectFloatingLabel" class="placeholder">Status</label>
                @error('status')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="card-action text-right">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{route('attribute-groups')}}" class="btn btn-danger">Cancel</a>
        </div>
        </form>
    </div>
</div>
@endsection
