 @isset($categories)

   
 <div class="col-md-3 ">
                   <div class="card">
                    <div class="card-header">Kategoriler</div>
                   </div>
                 
                        <div class="list-group">
                  @foreach ($categories as $category )
                  <li class="list-group-item ">
                    <a href="{{route('category',$category->slug)}}" class=" @if(Request::segment(2) === $category->slug) text-info @endif">{{$category->name}}</a>  
                </li>
                  @endforeach
 
                    </div>
                </div>
 

                @endisset