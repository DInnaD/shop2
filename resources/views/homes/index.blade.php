@extends('homes.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    
      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listing</h3>
               @include('admin.errors')
            </div>
            <!-- /.box-header -->
            <div class="box-body">
         
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Author Name</th>
                  <th>Page</th>
                  <th>Made in</th>
                  <th>Year</th>
                  <th>Is Hadr</th>
                  <th>Кind</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Image</th>
                  <th>Discont</th>
                  <th>Price-%</th>
                  <th>Status b/m</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                <tr>
                  <td>{{$book->id}}</td>
                  <td>{{$book->name}}</td>
                  <td>{{$book->author_name}}</td>
                  <td>{{$book->page}}</td>
                  <td>{{$book->autor}}</td>
                  <td>{{$book->year}}</td>
                  <td>{{$book->is_hadr_hard}}</td>
                  <td>{{$book->kindof}}</td>
                  <td>{{$book->size}}</td>
                  <td>{{$book->price}}</td>
                  <td>
                    <img src="{{$book->getImage()}}" alt="" width="100">
                  </td>

                  <!--Book discont-->
                  <!--include('admin.discontsBook')-->
                  @if($book->author->status_discont_id == 1 &&  $book->discont_privat != null)
                    @if($book->discont_global >= $book->author->discont_id)
                    <td>{{$book->discont_global}}</td>
                    <td>{{$book->price - ($book->price * $book->discont_global / 100)}}</td>
                    @else
                    <td>{{$book->author->discont_id}}</td>
                    <td>{{$book->price - ($book->price * $book->author->discont_id / 100)}}</td>
                    @endif
                  @elseif($book->discont_privat != null)
                  <td>{{$book->discont_global}}</td>
                  <td>{{$book->price - ($book->price * $book->discont_global / 100)}}</td>
                  @elseif($book->author->status_discont_id == 1)
                  <td>{{$book->author->discont_id}}</td>
                  <td>{{$book->price - ($book->price * $book->author->discont_id / 100)}}</td>
                  @else
                  <td>0</td>
                  <td>{{$book->price}}</td>
                  @endif

                  <td>{{$book->status}}</td>
                  <td>
                    {{ link_to_route('books.show', 'info', [$book->id], ['class' => 'btn btn-success btn-xs']) }}
                    </td>
                    <td>
                @if(Auth::check())
                <form class="form-horizontal contact-form" role="form" method="post" action="/purchase">
                        {{csrf_field()}}
                        <input type="hidden" name="book_id" value="{{$book->id}}">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Quantity</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{old('qty')}}" name="qty" placeholder="Write Quantity">
                  </div>   
                <div class="box-footer">   
                 <button class="btn send-btn btn btn-warning pull-right">Buy</button>
               </div>
                </form>
                @endif 
                  </td>
                </tr>
                @endforeach
                </tfoot>
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Page</th>
                  <th>Made in</th>
                  <th>Number Per Year</th>
                  <th>Year</th>
                  <th>Number</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Sub Price</th>
                  <th>Image</th>
                  <th>Discont</th>
                  <th>Price-%</th>
                  <th>Status b/m</th>
                </tr>
                </thead>
                <tbody>
                @foreach($magazins as $magazin)
                <tr>
                  <td>{{$magazin->id}}</td>
                  <td>{{$magazin->name}}</td>
                  <td>{{$magazin->page}}</td>
                  <td>{{$magazin->autor}}</td>
                  <td>{{$magazin->number_per_year}}</td>
                  <td>{{$magazin->year}}</td>
                  <td>{{$magazin->number}}</td>
                  <td>{{$magazin->size}}</td>
                  <td>{{$magazin->price}}</td>
                  <td>{{$magazin->sub_price}}</td>
                  <td>
                    <img src="{{$magazin->getImage()}}" alt="" width="100">
                  </td>
                  

                  <!--Magazine discont-->
                  <!--@include('admin.discontsMagazin')-->
                                    @if($magazin->author->status_discont_id == 1)
                    @if($magazin->discont_global >= $magazin->author->discont_id)
                    <td>{{$magazin->discont_global}}</td>
                    <td>{{$magazin->price - ($magazin->price * $magazin->discont_global / 100)}}</td>
                    @else
                    <td>{{$magazin->author->discont_id}}</td>
                    <td>{{$magazin->price - ($magazin->price * $magazin->author->discont_id / 100)}}</td>
                    @endif
                  @elseif($magazin->discont_privat != null)
                  <td>{{$magazin->discont_global}}</td>
                  <td>{{$magazin->price - ($magazin->price * $magazin->discont_global / 100)}}</td>
                  @elseif($magazin->author->status_discont_id == 1)
                  <td>{{$magazin->author->discont_id}}</td>
                  <td>{{$magazin->price - ($magazin->price * $magazin->author->discont_id / 100)}}</td>
                  @else
                  <td>0</td>
                  <td>{{$magazin->price}}</td>
                  @endif

                  <td>{{$magazin->status}}</td>                  
                  <td>
                    {{ link_to_route('magazins.show', 'info', [$magazin->id], ['class' => 'btn btn-success btn-xs']) }}
                 </td>
                 <td> 
                 @if(Auth::check())  
                  <form class="form-horizontal contact-form" role="form" method="post" action="/purchase">
                        {{csrf_field()}}
                        <input type="hidden" name="magazin_id" value="{{$magazin->id}}">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Quantity</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{old('qty_m')}}" name="qty_m">
                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer"> 
                    <button class="btn btn-warning pull-right">Buy</button>
                  </div>
               </form>
               @endif
                  </td>
                </tr>
                @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection
