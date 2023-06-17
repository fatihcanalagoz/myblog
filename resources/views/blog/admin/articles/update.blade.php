@extends('blog.admin.layouts.app')
@section('title',$articles->title.' Makalelesini Güncelle')
@section('content')
<div class="card shadow mb-4">

    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success text-center">
           {{session('success')}}
        </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger text-center mx-auto">
                <ul>
                    @foreach ($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
       <form action="{{route('admin.articles.update',$articles->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <label>Başlık</label>
            <input type="text" placeholder="Başlığı giriniz.." class="form-control" name='title' value="{{$articles->title}}" required>
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <select class="form-control" name="category" required id="">
                <option>Kategori Seçin</option>
                @foreach ($category as $item )
                    <option @if ($articles->category_id == $item->id)
                        selected
                    @endif value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
               
            </select>
        </div>
        <div class="form-group">
            <img src="{{$articles->image}}" width="300" class="rounded img-thumbnail mb-2">
            <input type="file" class="form-control" name="image">
        </div>
        <div class="form-group">
            <label>İçerik</label>
           <textarea  class="form-control" id="summernote" name="content" value="">{!!$articles->content!!}</textarea>
        </div>
        <div class="form-group">
            <select name="status" class="form-control">
                <option value="@if($articles->status ==1) 1 @else 1 @endif"@if ($articles->status == 1) selected @endif>Aktif </option>
                <option value="@if($articles->status ==0) 0 @else 0 @endif"@if ($articles->status == 0) selected @endif>Taslak </option>
                
            </select>
        </div>
        <button type="submit" class="btn btn-primary form-control"> Güncelle</button>
       </form>
    </div>
</div>
@endsection
 
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
        'height':300
      });
      
    });
  </script>
@endsection