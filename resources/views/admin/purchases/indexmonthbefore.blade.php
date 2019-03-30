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
                
              </div>
              @if(Auth::check())
                    <div class="leave-comment"><!--leave comment-->
                        


    

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Not Pay</th>
                  <th>Del/Edit</th>
                  <th>ID</th>
                  <th>Book</th>
                  <th>Summa</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($purchases as $purchase)
                <tr>
                  <td>
                  @if($purchase->status_paied == 0)
                    <a href="" class="fa fa-lock"></a> 
                  @else
                      <a href="" class="fa fa-thumbs-o-up"></a> 
                  @endif
              </td>
                  <td> {{Form::open(['route'=>['purchases.destroy', $purchase->id], 'method'=>'delete'])}}
                      <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                       <i class="fa fa-remove"></i>
                      </button>
                      <a href="{{route('purchases.edit', $purchase->id)}}" class="fa fa-pencil"></a>

                       {{Form::close()}}
                     </td>
                  <td>{{$purchase->id}}</td>
                  <td>{{$purchase->order_id}}
                  </td>
                  <td>{{$purchase->sum}}</td>
                  <td>{{$purchase->created_at}}
                  </td>
                </tr>
                @endforeach
                </tfoot>
                
                   
                @endif
 
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection


    