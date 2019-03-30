@extends('admin.layout')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Change Magazine
        <small>Good Words..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	{{Form::open([
		'route'	=>	['magazins.update', $magazin->id],
		'files'	=>	true,
		'method'	=>	'put'
	])}}
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Renew Book</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$magazin->name}}" name="name">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Made In</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$magazin->autor}}" name="autor">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Pages</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$magazin->page}}" name="page">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Year</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$magazin->year}}" name="year">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Number</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$magazin->number}}" name="number">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Number Per Year</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$magazin->number_per_year}}" name="number_per_year">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Size</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$magazin->size}}" name="size">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Price</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$magazin->price}}" name="price">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Sub Price</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$magazin->sub_price}}" name="sub_price">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Old Price</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$magazin->old_price}}" name="old_price">
            </div>

            <div class="form-group">
              <img src="{{$magazin->getImage()}}" alt="" class="img-responsive" width="200">
              <label for="exampleInputFile">Image</label>
              <input type="file" id="exampleInputFile" name="img">

              <p class="help-block">Info..</p>
            </div>
            
            <div class="form-group">
              <label for="exampleInputEmail1">Discont</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$magazin->discont_global}}" name="discont_global">
            </div>
            <!-- checkbox -->
            <div class="form-group">
              <label>
                {{Form::checkbox('status', '1', $magazin->status, ['class'=>'minimal'])}}
              </label>
              <label>
                Draft
              </label>
            </div>
          </div>
          
        </div>
          
      </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-warning pull-right">Edit</button>
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
	{{Form::close()}}
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection