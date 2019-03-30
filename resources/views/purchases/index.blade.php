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
              
                   
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="form-group">
                <a style="margin-left: 30px !important;" href="{{route('purchases.buy')}}">Pay</a></h2>
                <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('purchases.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> Back
            </a>
              </div>
              <div style="margin-left: 0px !important; margin-top: 30px !important;">
               {{--Form::open(['route'=>['purchases.destroyAll', [$purchases, $books, $magazins], 'method'=>'delete'])--}}
                {{--Form::open(['route' => array_merge(['purchases.destroyAll'], compact('books', 'magazins', 'purchases')), 'class' => 'confirm-delete','method' => 'DELETE'])--}}
                      

                      <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                       <i class="fa fa-remove">Del All</i>
                      </button>

                       {{--Form::close()--}}
            </div>
              @if(Auth::check())
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Paid</th>
                  <th>Added to cart</th>
                  <th>Del</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Date</th>
                  <th>Quantity</th>
                  <th>Summa</th>
                  <th>%id or %gl</th>
                  <th>Price-%</th>
                  <th>Item b/m</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($purchases as $purchase)
                 <tr>
                  <td>
                    
                   @if($purchase->status_paied == 1)
                  
                    <button class="btn send-btn"><a href="" class="fa fa-thumbs-o-up"></a></button>
                     
                  @else
                      <a href="" class="fa fa-lock"></a> 
                  @endif
              </td>
              <td>
                 @if($purchase->status_bought == 1)
                  
                    <button class="btn send-btn"><a href="purchases/toggleBeforeToggle/{{$purchase->id}}" class="fa fa-thumbs-o-up"></a></button>
                    </form> 
                  @else
                      <a href="purchases/toggleBeforeToggle/{{$purchase->id}}" class="fa fa-lock"></a> 
                  @endif
              </td>
              <td>
                  {{Form::open(['route'=>['purchases.destroy', $purchase->id], 'method'=>'delete'])}}
                      <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                       <i class="fa fa-remove"></i>
                      </button>
                       {{Form::close()}}
                </td>    
                @if($purchase->book_id != null && $purchase->status_bought == 1)
                 <td>{{$purchase->id}}</td>
                 <td>{{$purchase->first()->book->name}}
                  </td>
                  <td>{{$purchase->first()->book->price}}
                  </td>
                  <td>{{$purchase->created_at}}
                  </td> 
                  <td> 
                 @if(Auth::check())  
                 {!! Form::model($purchase, ['route' => ['purchases.update', $purchase->id], 'method' => 'PUT']) !!}
                  {{--Form::open([
                  'route' =>  ['purchases.update', $purchase->id],
                  'files' =>  true,
                  'method'  =>  'put'
                ])--}}
                    <!-- Default box -->
                    <div class="form-group">
                            <label for="exampleInputEmail1"></label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$purchase->qty}}" name="qty">
                          </div>
                        <!--/div>
                        
                      </div-->
                        
                    </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <button class="btn btn-warning pull-right">Edit</button>
                      </div>
                      <div class="box-header with-border">
                        @include('admin.errors')
                      </div>
                      <!-- /.box-footer-->
                    <!-- /.box -->
                {{Form::close()}}
               @endif
                  </td>                  
                  <td>{{$purchase->first()->book->price * $purchase->qty}}
                  </td>
                      <!-- Discont Book with quantity of book-->  
                      <!--Book discont-->
                  @if($purchase->first()->book->author->status_discont_id == 1 && $purchase->first()->book->discont_privat != null)
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
                  
                  <td>{{$purchase->first()->book->status}}
                  </td>
                @else($purchase->magazin_id != null && $purchase->status_bought == 1)
                <td>{{$purchase->id}}</td>
                   <td>{{$purchase->magazin->name}}
                  </td>
                  <td>{{$purchase->magazin->price}}
                  </td>
                  <td>{{$purchase->created_at}}
                  </td>
                  <td> 
                 @if(Auth::check())  
                  {{Form::open([
                  'route' =>  ['purchases.update', $purchase->id],
                  'files' =>  true,
                  'method'  =>  'put'
                ])}}
                    <!-- Default box -->
                          <div class="form-group">
                            <label for="exampleInputEmail1">Quantity</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" value="{{$purchase->qty_m}}" name="qty_m">
                          </div>
                        <!--/div>
                        
                      </div-->
                        
                    </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <button class="btn btn-warning pull-right">Edit</button>
                      </div>
                      <div class="box-header with-border">
                        @include('admin.errors')
                      </div>
                      <!-- /.box-footer-->
                    <!-- /.box -->
                {{Form::close()}}
                {{--!! Form::model($subscriber, ['route' => ['subscriber.update', $bunch, $subscriber], 'method' => 'PUT']) !!--}}

               @endif
                  </td>                  
                  <td>{{$purchase->magazin->price * $purchase->qty_m}}
                  </td> 
                  <!-- Discont Magazin with quantity of magazines -->
                  
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

                  <td>{{$purchase->magazin->status}}
                  </td>
                  @endif 
                </tr>
                @endforeach
                </tfoot>                
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


    