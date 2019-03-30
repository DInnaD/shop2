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
                <a href="{{route('magazins.create')}}" class="btn btn-success">Add</a>
              </div>
              <div class="form-group">
                <a href="{{route('admin.magazins.toggleDiscontGLMAll')}}" class="btn btn-success">Del All Gobal Disconts</a>
              </div>    
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>%?</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Page</th>
                  <th>Made in</th>
                  <th>Year</th>
                  <th>Number</th>
                  <th>Number Per Year</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Sub Price</th>
                  <th>Image</th>
                  <th>Discont</th>
                  <th>Price-%</th>
                  
                </tr>
                </thead>
                <tbody>
                @foreach($magazins as $magazin)
                <tr>
                  <td>
                  @if($magazin->author->discont_privat != 1)
                    <a href="magazins/toggleDiscontGlM/{{$magazin->id}}" class="fa fa fa-lock"></a> 
                  @else
                      <a href="magazins/toggleDiscontGLM/{{$magazin->id}}" class="fa fa-thumbs-o-up"></a> 
                  @endif
                  </td>
                  <td>{{$magazin->id}}</td>
                  <td>{{$magazin->name}}</td>
                  <td>{{$magazin->page}}</td>
                  <td>{{$magazin->autor}}</td>                  
                  <td>{{$magazin->year}}</td>
                  <td>{{$magazin->number}}</td>
                  <td>{{$magazin->number_per_year}}</td>
                  <td>{{$magazin->size}}</td>
                  <td>{{$magazin->price}}</td>
                  <td>{{$magazin->sub_price}}</td>
                  <td>
                    <img src="{{$magazin->getImage()}}" alt="" width="100">
                  </td>
                    
                  <!-- Discont Magazine -->  
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
                  <!--include('admin.discontsMagazin')-->
                  
                  <td>
                  <a href="{{route('magazins.edit', $magazin->id)}}" class="fa fa-pencil"></a> 

                  {{Form::open(['route'=>['magazins.destroy', $magazin->id], 'method'=>'delete'])}}
	                  <button onclick="return confirm('are you sure?')" type="submit" class="delete">
	                   <i class="fa fa-remove"></i>
	                  </button>
                  {{ link_to_route('magazins.show', 'info', [$magazin->id], ['class' => 'btn btn-success btn-xs']) }}
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