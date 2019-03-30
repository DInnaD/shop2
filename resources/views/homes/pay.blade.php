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
              <h2 class="box-title">
                <a style="margin-left: 30px !important;" href="{{route('home.index')}}">Continue Shopping</a></h2>
                <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('home.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> Back
            </a>
            </div>
            <div style="margin-left: 30px !important;">
               {{--Form::open(['route'=>['purchases.destroyAll', [$purchases, $books, $magazins], 'method'=>'delete'])--}}
                {{--Form::open(['route' => array_merge(['purchases.destroyAll'], compact('books', 'magazins', 'purchases')), 'class' => 'confirm-delete','method' => 'DELETE'])--}}
                      <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                       <i class="fa fa-remove">Del All</i>
                      </button>

                       {{--Form::close()--}}
            </div>
            
            <div>
              {{isset($order->purchase->summa)}}
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
                  
                  <th>Add to cart</th>
                  <th>Del</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Date</th>
                  <th>Summa</th>
                  <th>Discont</th>
                  <th>Price-%</th>
                  <th>Status b/m</th>
                </tr>
                </thead>
                <tbody>
                 <tr>
                   @foreach($purchases as $purchase)
                   @if($purchase->status_bought == 1)
              <td>
                  @if($purchase->status_bought == 1)
                  
                    <button class="btn send-btn"><a href="purchases/toggleBeforeToggle/{{$purchase->id}}" class="fa fa-thumbs-o-up"></a></button>
                     
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
                   @if($purchase->book_id == 1)
                   <td>{{$purchase->id}}</td>
                   <td>{{$purchase->book->name}}
                  </td>
                  <td>{{$purchase->book->price}}
                  </td>
                  <td>{{$purchase->qty}}</td>
                  <td>{{$purchase->created_at}}
                  </td>
                  <td>{{$purchase->book->price * $purchase->qty}}
                  </td> 
                  
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
                  
                  <td>{{$purchase->first()->book->status}}</td>
                  @else($purchase->magazin_id == null)
                  <td>{{$purchase->id}}</td>
                   <td>{{$purchase->magazin->name}}
                  </td>
                  <td>{{$purchase->magazin->price}}
                  </td>
                  <td>{{$purchase->qty_m}}</td>
                  <td>{{$purchase->created_at}}
                  </td>
                  <td>{{$purchase->magazin->price * $purchase->qty_m}}
                  </td>
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
                @else<!--$purchase->status_bought == 0-->
                <tr>
                  <td>
                  @if($purchase->status_bought == 0)
                  
                    <a href="purchases/toggleBeforeToggle/{{$purchase->id}}" class="fa fa-lock"></a> 
                  @else
                    <button class="btn send-btn"><a href="purchases/toggleBeforeToggle/{{$purchase->id}}" class="fa fa-thumbs-o-up"></a></button>
                       
                  @endif
              </td>
              <td>
                  {{Form::open(['route'=>['purchases.destroy', $purchase->id], 'method'=>'delete'])}}
                      <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                       <i class="fa fa-remove"></i>
                      </button>
                       {{Form::close()}}
                </td>    
                @if($purchase->book_id != null)
                   <td>{{$purchase->id}}</td>
                   <td>{{$purchase->first()->book->name}}
                  </td>
                  <td>{{$purchase->first()->book->price}}
                  </td> 
                  <td>{{$purchase->qty}}</td>
                  <td>{{$purchase->created_at}}
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
                  @else($purchase->magazin_id != null)
                  <td>{{$purchase->id}}</td>
                  <td>{{$purchase->magazin->name}}
                  </td>
                  <td>{{$purchase->magazin->price}}
                  </td>
                  <td>{{$purchase->qty_m}}
                  </td>
                  <td>{{$purchase->created_at}}</td>                  
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
                @endif<!--$purchase->status_bought == 0-->
                @endforeach
              
              </tbody></tfoot></table>
                 
           
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


    