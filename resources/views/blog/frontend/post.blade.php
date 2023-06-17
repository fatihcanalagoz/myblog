@extends('blog.frontend.layouts.app')
@section('title',$article->title)
@section('bg',$article->image)
@section('content')
        <!-- Main Content-->
      
        <div class="col-md-9  ">
            <h2 class="post-title">{{$article->title}}</h2>
            {!!$article->content!!}
          
           
        </div>
               @include('blog.frontend.widgets.CategoryWidget')
               
               <p class="text-muted float-end">
                {{$article->hit}} kişi tarafından okundu.
            </p>
   
@endsection