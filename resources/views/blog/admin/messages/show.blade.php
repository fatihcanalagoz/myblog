@extends('blog.admin.layouts.app')
@section('title', 'Mesajlar')
 
@section('content')

    <div class="row">
       
        <div class="col-md-8 mx-auto">
            <div class="card shadow mb-8">
                
                <div class="card-header py-3">
                    @foreach ($messages as $message )
                    <h6 class="m-0 font-weight-bold text-primary">{{$message->name}} <span class="text-dark">kişisinin mesajı.</span></h6>
                </div>
                <div class="card-body  ">
                   
                        
                    
                    <span class="text-dark font-weight-bold">Email:</span> 
                    <div class="card border-secondary mb-3 p-2" style="max-width: 100%;">{{$message->email}}</div>
                    <hr>
                    <h6 class="m-0 font-weight-bold text-dark mb-2">  <span class="text-dark">Mesaj</span></h6>
                    <div class="card border-secondary mb-3 p-2"> <p class="text-center"> {{$message->message}}</p></div>
                     
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection

 
