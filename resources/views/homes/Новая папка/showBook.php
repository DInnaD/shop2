<div class="panel-body">

        <table class="table table-bordered table-responsive">
            <tr>
                <th width="25%">Attribute</th>
                <th width="75%">Value</th>
            </tr>
            @foreach ($book->getAttributes() as $attribute => $value)
                <tr>
                    <td>{{$attribute}}</td>
                    <td>{{$value}}</td>
                </tr>
            @endforeach
        </table>

    </div>
    @if(!$book->orders->isEmpty())
                    @foreach($book->getOrders() as $order)
                        <div class="bottom-comment"><!--bottom comment-->
                            <div class="comment-img">
                                <img class="img-circle" src="{{$order->author->getImage()}}" alt="" width="75" height="75">
                            </div>

                            <div class="comment-text">
                                <h5>{{$order->author->name}}</h5>

                                <p class="comment-date">
                                    {{$order->created_at->diffForHumans()}}
                                </p>


                                <p class="para">{{$order->qty}}</p>
                            </div>
                        </div>
                    @endforeach
                @endif