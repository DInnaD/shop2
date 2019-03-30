<div class="panel-body">


        <table class="table table-bordered table-responsive">
            <tr>
                <th width="25%">Quantity</th>
                <th width="25%">Attribute</th>
                <th width="50%">Value</th>
            </tr>
            @foreach ($book->getAttributes() as $attribute => $value)
                <tr>
                    <td>{{$book->orders_product->$qty}}</td>
                    <td>{{$attribute}}</td>
                    <td>{{$value}}</td>
                </tr>
            @endforeach
        </table>
       
        <table class="table table-bordered table-responsive">
            <tr>
                <th width="25%">Quantity</th>
                <th width="25%">Attribute</th>
                <th width="50%">Value</th>
            </tr>
            @foreach ($magazin->getAttributes() as $attribute => $value)
                <tr>
                    <td>{{$magazin->orders_product->$qty_m}}</td>
                    <td>{{$attribute}}</td>
                    <td>{{$value}}</td>
                </tr>
            @endforeach
        </table>
        {{Form::open([
        'route' => 'orders.store'
    ])}}
        <div class="form-group">
                <!-- /.box-body -->
        <div class="box-footer">
          <button class="btn btn-success pull-right">Add  To Cart</button>
        
       </div>
       {{Form::close()}}
    </div>