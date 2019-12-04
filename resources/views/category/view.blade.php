@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <div class="card mb-3">
                <div class="card-header bg-success">
                    Product List
                </div>
                <div class="card-body">
                   
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>SL No.</th>
                            <th>Category Name</th>
                            <th>Menu Status</th>
                            <th>Created At</th>   
                            <th>Action</th>         
                            </tr>
                        </thead>
                        <tbody>
                          @forelse($categories as $category)
                            <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{ ($category->menu_status == 1 ? "YES":"NO") }}</td>
                            <td>{{$category->created_at->format('d-m-Y h:i:s A')}}
                            <br>
                            {{$category->created_at->diffForHumans()}}
                            </td>
                            <td>
                            <a href="{{ url('change/menu/status') }}/{{$category->id}}" class="btn btn-sm btn-info">Change</a>
                            </td>

                            </tr>
                          @empty
                            <tr>
                            <td colspan="3">No Category Available</td>
                            </tr>
                          @endforelse
                                                       
                        </tbody>
                    </table>
                    
                </div>
            </div>
            
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header bg-success">
                    Add Product Form
                </div>
                <div class="card-body">
                @if(session('status'))
                <!-- <div class="alert alert-success">
                    {{ session('status') }}
                </div> -->
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('status') }}</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if($errors->all())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach   
                    </div>  
                @endif                       
                <form action="{{url('add/category/insert')}}" method="post" >
                @csrf
                    <div class="form-group">
                        <label >Category Name</label>
                        <input type="text" class="form-control" placeholder="Enter your category name" name="category_name" value="{{old('category_name')}}">                        
                    </div>  
                    <div class="form-group">
                        <input type="checkbox" name="menu_status" value="1" id="menu"><label for="menu">Use as menu </label>                     
                    </div>                 
                    
                    <button type="submit" class="btn btn-info">Add Category</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection