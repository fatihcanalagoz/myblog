@extends('blog.admin.layouts.app')
@section('title', 'Kategoriler')
@section('css')
    <link href="{{ asset('blog/admin') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@section('content')

    <div class="row">
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kategori Oluştur</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Kategori Adi</label>
                            <input type="text" class="form-control mb-3" placeholder="Kategori ismi giriniz."
                                name="category" required>
                            <button type="submit" class="btn btn-primary form-control">Oluştur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow mb-8">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Kategoriler</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Makale Sayısı</th>
                                    <th>Ayarlar</th>

                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->articleCount() }}</td>
                                        <td class="text-center mx-auto">
                                              <!-- Modal content-->
                                              <div id="myModal__{{ $category->id }}"
                                                class="modal fade inputClass_{{ $category->id }}" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Kategori Sil</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h3><strong class="text-danger">"{{$category->name}}"</strong> kategorisini silmek istediğinizden emin misiniz?</h3>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a  href="{{ route('admin.category.delete', $category->id) }}" class="btn btn-danger"
                                                                >Sil</a>
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Kapat</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            {{-- Modal Content End --}}
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" title="Düzenle"
                                                data-toggle="modal" data-target="#myModal_{{ $category->id }}"
                                                class="btn btn-warning"><i class="fa fa-pen"></i></a>
                                            <a href="#" data-toggle="modal"="" data-target="#myModal__{{ $category->id }}" title="Sil"
                                                class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                            <!-- Modal content-->
                                            <div id="myModal_{{ $category->id }}"
                                                class="modal fade inputClass_{{ $category->id }}" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Kategori Duzenle</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('admin.categories.update', $category->id) }}"
                                                                method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control mb-4"
                                                                        value="{{ $category->name }}" name="categoryName"">

                                                                    <button type="submit"
                                                                        class="btn btn-primary form-control">Düzenle</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            {{-- Modal Content End --}}
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
