@extends('homes.layout')

@section('content')
<div class="panel-body">

        <table class="table table-bordered table-responsive">
            <tr>
                <th width="25%">Attribute</th>
                <th width="75%">Value</th>
            </tr>
            @foreach ($magazin->getAttributes() as $attribute => $value)
                <tr>
                    <td>{{$attribute}}</td>
                    <td>{{$value}}</td>
                </tr>
            @endforeach
        </table>

    </div>
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
         
             
             
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Author</th>
                  <th>Number Per Year</th>
                  <th>Year</th>
                  <th>Number</th>
                  <th>Size</th>
                  <th>Price</th>
                  <th>Sub Price</th>
                  <th>Old Price</th>
                  <th>Image</th>
                  <th>Discont</th>
                  
                </tr>
                </thead>
                <tbody>
                
                <tr>
                  <td>{{$magazin->id}}</td>
                  <td>{{$magazin->name}}</td>
                  <td>{{$magazin->autor}}</td>
                  <td>{{$magazin->number_per_year}}</td>
                  <td>{{$magazin->year}}</td>
                  <td>{{$magazin->number}}</td>
                  <td>{{$magazin->size}}</td>
                  <td>{{$magazin->price}}</td>
                  <td>{{$magazin->sub_price}}</td>
                  <td>{{$magazin->old_price}}</td>
                  <td>
                    <img src="{{$magazin->getImage()}}" alt="" width="100">
                  </td>
                  <td>{{$magazin->discont_privat}}</td>
              
                  
                  <td>
                    {{ link_to_route('home.showMagazin', 'info', [$magazin->id], ['class' => 'btn btn-success btn-xs']) }}
                     {{--Form::open([
    'route' =>  ['orders_products.store', $orders_product->id],
    'method'  =>  'put'
  ])--}}
                  <div class="form-group">
                    <label for="exampleInputEmail1">Quantity</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{--old('qty_m')--}}" name="qty_m">
                  </div>
                  </td>
                  <td>
                  
                  
                  <!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-warning pull-right">Buy</button>
        </div>
                     {{--Form::close()--}}
                  </td>
                </tr>
               
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