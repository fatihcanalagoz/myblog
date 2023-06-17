@extends('blog.admin.layouts.app')
@section('title','Makalele Oluştur')
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
       <form action="{{route('admin.articles.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Başlık</label>
            <input type="text" placeholder="Başlığı giriniz.." class="form-control" name='title' required>
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <select class="form-control" name="category" required id="">
                <option>Kategori Seçin</option>
                @foreach ($category as $item )
                <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="file" class="form-control" name="image">
        </div>
        <div class="form-group">
            <label>İçerik</label>
           <textarea  class="form-control" id="summernote" name="content" ></textarea>
        </div>
        <div class="form-group">
            <select name="status" class="form-control">
                <option value="1">Aktif</option>
                <option value="0">Taslak</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary form-control"> Oluştur</button>
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