@if($purchase->status_bought == 0)
  
@else<!--$purchase->status_bought == 0 save for later-->
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
                   <td>{{$purchase->order_id}}</td>
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
                   <td>{{$purchase->first()->magazin->name}}
                  </td>
                  <td>{{$purchase->first()->magazin->price}}
                  </td>
                  <td>{{$purchase->created_at}}
                  </td>
                  <td>{{$purchase->qty_m}}</td>                  
                  <td>{{$purchase->first()->magazin->price * $purchase->qty_m}}
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
                