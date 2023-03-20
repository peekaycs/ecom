@extends('admin.layouts.app',['page_title' => 'Pages','page_action' => route('create-page')])

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
                        <th scope="col">Slug</th>
                        <th scope="col">Page Title</th>
                        <th scope="col">Meta Keywords</th>
                        <th scope="col">Published</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pages as $page)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{ $page->name }}</td>
                        <td>{{ $page->slug }}</td>
                        <td>{{ $page->title }}</td>
                        <td>{{ $page->meta_keywords }}</td>
                        <td>{{ ucfirst($page->published) }}</td>
                        
                        <td><a href="{{route('edit-page',$page->id) }}" title="view"><i class="far fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
        <div class="col-sm-12 col-md-6"></div>
        <div class="col-sm-12 col-md-6">
        {{ $pages->links() }}
        </div>
    </div>
    
</div>

@endsection