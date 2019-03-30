 @extends('purchases.layout')

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
              <h2 class="box-title">
                <a href="{{route('home.index')}}">
                    <i class="fa fa-backward" aria-hidden="true"></i>Back
                    </a></h2>
                    
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
                  <th>ID</th>
                  <th>Date</th>
                  
                </tr>
                </thead>
                <tbody>
                  
                @foreach($orders as $order)
                @if($order->status == 0)
                <tr>  
                   <td>{{$order->id}}</td>
                  <td>{{$order->created_at}}
                  </td> 
                  <td>
                    {{ link_to_route('ordersAll.index', 'ordersAll', [$order->id], ['class' => 'btn btn-success btn-xs']) }}
                  </td>
                </tr>
                @endif
                @endforeach
                
                </tfoot>
                <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  
                </tr>
                </thead>
       
              </table>
           
                </div><!--end leave comment-->
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


    