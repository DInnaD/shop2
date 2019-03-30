@extends('admin.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Book
        <small>Good Word..</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
	{{Form::open([
		'route'	=> 'books.store',
		'files'	=>	true
	])}}
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Add Book</h3>
          @include('admin.errors')
        </div>
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="exampleInputEmail1">Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="name" value="{{old('name')}}">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Author Name</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{old('author_name')}}" name="author_name">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Page</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{old('page')}}" name="page">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Made In</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{old('autor')}}" name="autor">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Year</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{old('year')}}" name="year">
            </div>
            <!-- checkbox -->
            <div class="form-group">
              <!--label>
                <input type="checkbox" class="minimal" name="is_hard">
              </label>
              <label>
                Hard
              </label-->
              {!!Form::label('is_hard', 'Is Hard') !!}
              {!!Form::checkbox('Is Hard?', 'is_hard_hard', true) !!}
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Кind</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{old('kindof')}}" name="kindof">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Size</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{old('size')}}" name="size">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Price</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{old('price')}}" name="price">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Old Price</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{old('old_price')}}" name="old_price">
            </div>
            <div class="form-group">
              <label for="exampleInputFile">Image</label>
              <input type="file" id="exampleInputFile" name="img">
              <p class="help-block"></p>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Discont</label>
              <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{old('discont_global')}}" name="discont_global">
            </div>
              <!-- /.input group -->
            <!-- checkbox -->
            <div class="form-group">
              <label>
                <input type="checkbox" class="minimal" name="status">
              </label>
              <label>
                Draft
              </label>
            </div>
          
        <!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-default">Back</button>
          <button class="btn btn-success pull-right">Add</button>
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