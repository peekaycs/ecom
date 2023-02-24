@extends('admin.layouts.app',['page_title' => 'Attributes','page_action' => route('create-attribute')])

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
                        <th scope="col">Attribute</th>
                        <th>Group</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($attributes as $attribute)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $attribute->name }}</td>
                        <td>{{ $attribute->attributeGroup[0]->name }}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6">
        {{ $attributes->links() }}
        </div>
    </div>
    
</div>

@endsection