@extends('admin.layout')

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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <a href="{{route('books.create')}}" class="btn btn-success">Add</a>
              </div>
              <div class="form-group">
                <a href="{{route('admin.books.toggleDiscontGLBAll')}}" class="btn btn-success">Del All Gobal Disconts</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>%?</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Author</th>
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
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                <tr>
                  <td>
                    @if($book->author->discont_privat != 1)
                    <a href="books/toggleDiscontGlB/{{$book->id}}" class="fa fa fa-lock"></a> 
                  @else
                      <a href="books/toggleDiscontGLB/{{$book->id}}" class="fa fa-thumbs-o-up"></a> 
                  @endif
                  </td>
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

                  <!-- Discont Book -->
 @if($book->author->status_discont_id == 1 &&  $book->discont_privat != null)<!--!= null equal with != 0?-->
  @if($book->discont_global > $book->author->discont_id)<!--null < then 20 discont_id with if else? why? + include error?-->
  <td>{{$book->discont_global}}</td>
  <td>{{$book->price - ($book->price * $book->discont_global / 100)}}</td>
  @else
  <td>{{$book->author->discont_id}}</td>
  <td>{{$book->price - ($book->price * $book->author->discont_id / 100)}}</td>
  @endif                 
@elseif($book->discont_privat != null)<!--2-->
<td>{{$book->discont_global}}</td><!--null > then 20 discont_id with if ifelse else? why? + include error?-->
<td>{{$book->price - ($book->price * $book->discont_global / 100)}}</td>
@elseif($book->author->status_discont_id == 1)
<td>{{$book->author->discont_id}}</td>
<td>{{$book->price - ($book->price * $book->author->discont_id / 100)}}</td>
@else
<td>0</td>
<td>{{$book->price}}</td>
@endif
                  <!--includeadmin.discontsBook-->
                  <td>                  
                  <a href="{{route('books.edit', $book->id)}}" class="fa fa-pencil"></a> 

                  {{Form::open(['route'=>['books.destroy', $book->id], 'method'=>'delete'])}}
	                  <button onclick="return confirm('are you sure?')" type="submit" class="delete">
	                   <i class="fa fa-remove"></i>
	                  </button>
                  {{ link_to_route('books.show', 'info', [$book->id], ['class' => 'btn btn-success btn-xs']) }}
	                   {{Form::close()}}
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