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
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attributeGroups as $attributeGroup)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $attributeGroup->name }}</td>
                        <td>
                            <a href="{{route('edit-attribute-group',$attributeGroup->id)}}" title="view">
                                <i class="far fa-eye"></i>
                            </a>
                            <form class="delete-form" method="post" action="{{route('delete-attribute-group',$attributeGroup->id)}}" onsubmit="return confirm('Do you want to delete?')" >
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{$attributeGroup->id}}" />
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
        {{ $attributeGroups->links() }}
        </div>
    </div>
    
</div>

@endsection