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
        <div class="form-group">
                <a href="{{route('admin.purchases.indexDayBefore')}}" class="btn btn-success">Purchase per Day</a>                
              </div>
              <div class="form-group">
                <a href="{{route('admin.purchases.indexWeekBefore')}}" class="btn btn-success">Purchase per Week</a>
              </div>
              <div class="form-group">
                <a href="{{route('admin.purchases.indexMonthBefore')}}" class="btn btn-success">Purchase per Month</a>
              </div>
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
                  <th>Paid/Unpaid</th>
                  <th>Del</th>
                  <th>Order</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Date</th>
                  <th>Quantity</th>
                  <th>Summa</th>   
                  <th>%id or %gl</th>
                  <th>Price-%</th>
                  <th>Item</th>
                </tr>
                </thead>
                <tbody>
                <!--foreach-->                
                @foreach($purchases as $purchase)
                <tr>
                  <td>
                    @if($purchase->status_bought == 1)
                      @if($purchase->status_paied == 0)
                        <a href="" class="fa fa-lock"></a> 
                      @else
                          <a href="" class="fa fa-thumbs-o-up"></a> 
                      @endif
                    @endif
              </td>
                  <td> {{Form::open(['route'=>['purchases.destroy', $purchase->id], 'method'=>'delete'])}}
                      <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                       <i class="fa fa-remove"></i>
                      </button>
                      <!--a href="{{route('purchases.edit', $purchase->id)}}" class="fa fa-pencil"></a-->

                       {{Form::close()}}
                     </td>
                   @if($purchase->book_id != null)
                   <td>{{($purchase->order_id)}}</td>
                   <td>{{$purchase->id}}</td>
                   <td>{{$purchase->first()->book->name}}
                  </td>
                  <td>{{$purchase->first()->book->price}}
                  </td>
                  <td>{{$purchase->created_at}}
                  </td> 
                  <td>{{$purchase->qty}}</td>
                  <td>{{$purchase->first()->book->price * $purchase->qty}}
                  </td>

                  <!--Book discont-->@if($purchase->first()->book->author->status_discont_id == 1 && $purchase->first()->book->discont_privat != null)
                    @if($purchase->first()->book->discont_global >= $purchase->first()->book->author->discont_id)
                    <td>{{$purchase->first()->book->discont_global}}</td>
                    <td>{{($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->discont_global / 100)) * $purchase->qty}}</td>
                    @else
                    <td>{{$purchase->first()->book->author->discont_id}}</td>
                    <td>{{($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->author->discont_id / 100)) * $purchase->qty}}</td>
                    @endif
                  @elseif($purchase->first()->book->discont_privat != null)
                  <td>{{$purchase->first()->book->discont_global}}</td>
                  <td>{{($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->discont_global / 100)) * $purchase->qty}}</td>
                  @elseif($purchase->first()->book->author->status_discont_id == 1)
                  <td>{{$purchase->first()->book->author->discont_id}}</td>
                  <td>{{($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->author->discont_id / 100)) * $purchase->qty}}</td>
                  @else
                  <td>0</td>
                  <td>{{$purchase->first()->book->price  * $purchase->qty}}</td>
                  @endif
                  <!--include('admin.discontsQtyBook')-->
                  

                  <td>{{$purchase->first()->book->status}}</td>
                @else($purchase->magazin_id != null)
                <td>{{($purchase->order_id)}}</td>
                   <td>{{$purchase->id}}</td>
                   <td>{{$purchase->magazin->name}}
                  </td>
                  <td>{{$purchase->magazin->price}}
                  </td>
                  <td>{{$purchase->created_at}}
                  </td> 
                  <td>{{$purchase->qty_m}}</td>
                  <td>{{$purchase->magazin->price * $purchase->qty_m}}
                  </td> 
                  <!--Magazine discont-->
                  
                  <!--Magazine discont-->
                  @if($purchase->magazin->author->status_discont_id == 1 && $purchase->magazin->discont_privat != null)
                    @if($purchase->magazin->discont_global >= $purchase->magazin->author->discont_id)
                    <td>{{$purchase->magazin->discont_global}}</td>
                    <td>{{($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->discont_global / 100)) * $purchase->qty_m}}</td>
                    @else
                    <td>{{$purchase->magazin->author->discont_id}}</td>
                    <td>{{($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->author->discont_id / 100)) * $purchase->qty_m}}</td>
                    @endif
                  @elseif($purchase->magazin->discont_privat != null)
                  <td>{{$purchase->magazin->discont_global}}</td>
                  <td>{{($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->discont_global / 100)) * $purchase->qty_m}}</td>
                  @elseif($purchase->magazin->author->status_discont_id == 1)
                  <td>{{$purchase->magazin->author->discont_id}}</td>
                  <td>{{($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->author->discont_id / 100)) * $purchase->qty_m}}</td>
                  @else
                  <td>0</td>
                  <td>{{$purchase->magazin->price  * $purchase->qty_m}}</td>
                  @endif
                  <!--include('admin.discontsQtyMagazin')-->

                  <td>{{$purchase->magazin->status}}</td>
                 @endif 
                </tr>
                @endforeach
                <!--endforeach-->
                </tfoot>
                
                </tbody>
              </table> 
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