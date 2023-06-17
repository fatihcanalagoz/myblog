@extends('blog.frontend.layouts.app')
@section('title',$category->name)
@section('content')
        <!-- Main Content-->
   
        
 
     
        <div class="col-md-9 mx-auto">
            @if (count($articles)>0)
            <!-- Post preview-->
           @foreach ($articles as $article )
           @if($article->status == 1)
           <div class="post-preview">
            <a href="{{route('single',$article->slug)}}">
                <h2 class="post-title">{{$article->title}}</h2>
                <h3 class="post-subtitle">{{Str::limit($article->content,100)}}</h3>
            </a>
            <p class="post-meta">
             
                Kategori: <a href="#!">{{$article->getCategory->name}}</a>
              
               <span class="float-end"> {{$article->created_at->diffForHumans()}}</span>
            </p>
        </div>
      
        <!-- Divider-->
        <hr class="my-4" />
        @endif
           @endforeach
           
            <!-- Pager-->
           @else
           <div class="alert alert-danger text-center">{{$category->name}} kategorisine ait post bulunamadı.</div>
           @endif  
           {{$articles->links('pagination::bootstrap-4')}}
        </div>
        @include('blog.frontend.widgets.CategoryWidget')
        <!-- Footer-->
       
@endsection