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