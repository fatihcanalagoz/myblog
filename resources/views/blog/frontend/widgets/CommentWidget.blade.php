<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger text-center mx-auto">
                    <ul>
                        @foreach ($errors->all() as $error )
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form action="{{route('make.comment',$article->id)}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">İsim</label>
              <input type="text" class="form-control" id="name" name="name"  placeholder="İsim giriniz.">
         
            </div>
            <div class="form-group">
              <label for="comment">Yorum</label>
              <textarea name="comment" class="form-control" id="comment" name="comment" placeholder="Yorum yap.."  cols="20" rows="5"></textarea>
            </div>
           
            <button type="submit" class="btn btn-primary mt-2">Gönder</button>
          </form>
    </div>
</div>
</div>

</div>

<div class="row m-4">
   
 @foreach (App\Models\Blog\Comment::all() as $comment )
 @if ($comment->article_id == $article->id)

<div class="col-md-10">
    <div class="card">
        <div class="card-body">
                
         
            <span class="text-dark">  <i>{{$comment->name}}</i> | @if (auth()->user()) <a class="float-end btn btn-danger " href="{{route('delete.comment',$comment->id)}}"><i class="fa fa-times"></i></a> @endif</span>

            <span class="text-muted">{{$comment->created_at->diffForHumans()}}</span>
            <p>{{$comment->comment}}</p>
        </div>
    </div>
</div>
@endif
@endforeach
</div>