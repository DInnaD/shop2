@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Bunches</div>

                    <div class="panel-body">
                        {{ link_to_route('bunch.create', 'create', null, ['class' => 'btn btn-info btn-xs']) }}
                        

                    <hr>
                        <table class="table table-bordered table-responsive table-striped">
                            <tr>
                                <th width="5%">id</th>
                                <th width="25%">Name</th>
                                <th width="5%">Email Count</th>
                                <th width="25%">Description</th>
                                
                                <th width="10%">Time</th>
                                <th width="25%">Action</th>
                            </tr>
                            <tr>
                                <td colspan="6" class="light-green-background no-padding" title="Create new template">
                                    <div class="row centered-child">
                                        <div class="col-md-12">

                                        </div>
                                    </div>
                                </td>
                            </tr>
                             
                          
                        @foreach ($bunches as $model)
                            <tr>
                                <td>{{$model->id_bunch}}</td>
                                
                                <td>{{$model->name_bunch}}</td>
                                <td>{{$model->subscribers->count()}}</td>
                                <td>{{$model->description_bunch}}</td>
                                <td>{{$model->created_at}}</td> 
                                <td>
                                    {{Form::open(['class' => 'confirm-delete', 'route' => ['bunch.destroy', $model->id_bunch], 'method' => 'DELETE'])}}

                                    {{ link_to_route('subscriber.index', 'subscriber', [$model->id_bunch], ['class' => 'btn btn-success btn-xs']) }} |
                                    {{ link_to_route('bunch.edit', 'edit', [$model->id_bunch], ['class' => 'btn btn-success btn-xs']) }} |
                                    {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                                    {{Form::close()}}
                                </td>

                            </tr>
                        @endforeach
                       
                        <div class="text-center">
                            { !! $bunches->render() !!}

                        </div>
                          

                    
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
