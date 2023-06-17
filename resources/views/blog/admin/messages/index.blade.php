@extends('blog.admin.layouts.app')
@section('title', 'Mesajlar')
@section('css')
    <link href="{{ asset('blog/admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="row">
       
        <div class="col-md-12">
            <div class="card shadow mb-8">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Mesajlar</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Isim</th>
                                    <th>Email</th>
                                    <th>Mesaj</th>
                                    <th>Tarih</th>
                                    <th>Ayarlar</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($messages as $message)
                                    <tr>
                                        <td>{{ Str::title($message->name) }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{Str::limit($message->message,'30')}}</td>
                                        <td>{{ $message->created_at->diffForHumans() }}</td>
                                        <td class="text-center mx-auto">
                                              <!-- Modal content-->
                                              <div id="myModal__{{ $message->id }}"
                                                class="modal fade " role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Mesaj sil</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h3><strong class="text-danger">"{{Str::title($message->name)}}"</strong> kişisinin mesajını silmek istediğinizden emin misiniz?</h3>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a  href="{{route('admin.message.delete',$message->id)}}" class="btn btn-danger"
                                                                >Sil</a>
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Kapat</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            {{-- Modal Content End --}}
                                            <a href="{{route('admin.message.read',$message->id)}}" title="Mesajı Göster"
                                            class="btn btn-primary"><i class="fa fa-book-reader"></i></a>
                                            <a href="#" data-toggle="modal"="" data-target="#myModal__{{ $message->id }}" title="Sil"
                                                class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                              
                                            
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('blog/admin') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('blog/admin') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('blog/admin') }}/js/demo/datatables-demo.js"></script>

@endsection
