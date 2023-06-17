@extends('blog.admin.layouts.app')
@section('title','Makaleler')
@section('css')
<link href="{{asset('blog/admin')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><strong>{{$models->count()}}</strong> silinmiş makale bulundu.</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Resim</th>
                        <th>Başlık</th>
                        <th>Kategori</th>
                        <th>Hit</th>
                        <th>Oluşturma Tarihi</th>
                        <th>Ayarlar</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($models as $model )
                        
                    
                    <tr>
                        <td class="text-center mx-auto"><img src="{{$model->image}}" style="width: 200px;" ></td>
                        <td>{{$model->title}}</td>
                        <td>{{$model->getCategory->name}}</td>
                        <td>{{$model->hit}}</td>
                        <td>{{$model->created_at->diffForHumans()}}</td>
                          <td class="text-center mx-auto">
                           
                              <a href="{{route('admin.soft.recover.articles',$model->id)}}" title="Kurtar" class="btn btn-danger"><i class="fa fa-recycle"></i></a>
                            <a href="{{route('admin.hard.delete',$model->id)}}" title="Sil" class="btn btn-warning"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('blog/admin')}}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('blog/admin')}}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('blog/admin')}}/js/demo/datatables-demo.js"></script>
@endsection