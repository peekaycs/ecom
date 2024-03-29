@extends('admin.layouts.app',['page_title' => 'Attributes','page_action' => route('create-attribute'),'manage'=>'Attribute Groups','manage_action' => route('attribute-groups')])

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
                        <th scope="col">Group</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attributes as $attribute)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $attribute->name }}</td>
                        <td>{{ $attribute->attributeGroup->name ?? '' }}</td>
                        <td>
                            <a href="{{route('edit-attribute',$attribute->id) }}" title="view"><i class="far fa-eye"></i></a>
                            <form class="delete-form" method="post" action="{{route('delete-attribute',$attribute->id)}}" onsubmit="return confirm('Do you want to delete?')" >
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{$attribute->id}}" />
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
        {{ $attributes->links() }}
        </div>
    </div>
    
</div>

@endsection