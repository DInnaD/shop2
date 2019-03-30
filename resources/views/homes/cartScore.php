@if ($purchases->any())
        @foreach($purchases->all() as purchase)
                {{$sumQty = 0}}
                @if($purchase->status_bought == 1)
                        {{$sumQty += $purchase->qty->count() + $purchase->qty_m->count()}}
                @endif
        @endforeach     
@endif