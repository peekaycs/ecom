@extends('admin.layouts.app',['page_title' => 'Attribute Group','page_action' => route('create-attribute-group'),'manage'=>'Attributes','manage_action' => route('attributes')])

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
                        <th scope="col">Attribute Group</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($attributeGroups as $attributeGroup)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $attributeGroup->name }}</td>
                        
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6">
        {{ $attributeGroups->links() }}
        </div>
    </div>
    
</div>

@endsection