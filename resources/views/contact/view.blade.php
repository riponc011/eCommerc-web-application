@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header bg-success">
                    Contact Messages List
                </div>
                <div class="card-body">
                    @if(session('deletestatus'))
                    <!-- <div class="alert alert-danger">
                        {{ session('deletestatus') }}
                    </div> -->
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('deletestatus') }}</strong> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th>SL No.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Subject</th> 
                            <th>Message</th>              
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contactmessages as $contactmessage)
                            <tr class={{($contactmessage->read_status==1)?"bg-info":""}}>
                            <td>{{$loop->index + 1}}</td>
                            <td>{{$contactmessage->first_name}}</td>  
                            <td>{{$contactmessage->last_name}}</td> 
                            <td>{{$contactmessage->subject}}</td>   
                            <td>{{$contactmessage->message}}</td>   
                            <!-- <td>
                            <div class="btn-group" role="group">
                                <a href="{{url('delete/product')}}/{{$contactmessage->id}}" class="btn btn-sm btn-danger">Delete</a>
                                <hr>
                                <a href="{{url('edit/product')}}/{{$contactmessage->id}}" class="btn btn-sm btn-info">Edit</a>
                            </div>                                
                            </td>                        -->
                            </tr> 
                            @empty
                            <tr class="text-center text-danger">
                                <td colspan="6">No Message Available</td>
                            </tr>
                            @endforelse
                                                       
                        </tbody>
                    </table>
                </div>
            </div>
        </div>        
    </div>
</div>
@endsection