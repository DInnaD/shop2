
@foreach($purchases as $purchase)
  @if($purchase->first()->book->author->status_discont_id == 1)
    @if($purchase->first()->book->discont_global > $purchase->first()->book->author->discont_id)
    <td>{{(($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->discont_global / 100)) * $purchase->qty)->count() + (($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->discont_global / 100)) * $purchase->qty_m)}}</td>
    @else
    <td>{{(($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->author->discont_id / 100)) * $purchase->qty)->count() + (($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->author->discont_id / 100)) * $purchase->qty_m)->count()}}</td>
    @endif
  @endif 
  @if($purchase->first()->book->author->status_discont_id == 1)
    @if($purchase->first()->book->discont_global > $purchase->first()->book->author->discont_id)
    <td>{{(($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->discont_global / 100)) * $purchase->qty)->count()}}</td>
    @else
    <td>{{(($purchase->first()->book->price - ($purchase->first()->book->price * $purchase->first()->book->author->discont_id / 100)) * $purchase->qty)->count()}}</td>
    @endif
  @endif 
  @if($purchase->first()->book->author->status_discont_id == 1)
    @if($purchase->first()->book->discont_global > $purchase->first()->book->author->discont_id)
    <td>{{ (($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->discont_global / 100)) * $purchase->qty_m)}}</td>
    @else
    <td>{{ (($purchase->magazin->price - ($purchase->magazin->price * $purchase->magazin->author->discont_id / 100)) * $purchase->qty_m)->count()}}</td>
    @endif
  @endif
   

{{$purchase->qty->count() + $purchase->qty_m->count()}}
{{$purchase->qty->count()}}
{{$purchase->qty_m->count()}}
@endforeach
