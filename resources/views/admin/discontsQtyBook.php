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