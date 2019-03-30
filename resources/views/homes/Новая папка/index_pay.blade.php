@foreach($purchases as $purchase)
                <tr>
                  <td>
                  @if($purchase->status_paied == 1)
                  
                    <button class="btn send-btn"><a href="purchases/toggle/{{$purchase->id}}" class="fa fa-thumbs-o-up"></a></button>
                    </form> 
                  @else
                      <a href="purchases/toggle/{{$purchase->id}}" class="fa fa-lock"></a> 
                  @endif
              </td>
              <td>
                  {{Form::open(['route'=>['purchases.destroy', $purchase->id], 'method'=>'delete'])}}
                      <button onclick="return confirm('are you sure?')" type="submit" class="delete">
                       <i class="fa fa-remove"></i>
                      </button>

                       {{Form::close()}}
                   </td>
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
                </tr>
                @endforeach