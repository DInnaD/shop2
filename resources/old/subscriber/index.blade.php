@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Subscribers for <b>{{ $bunch->name_bunch }}</b></div>
                     <div class="centered-child col-md-9 col-sm-7 col-xs-6"></div>
                   
                    <div class="panel-body">
                        <div style="padding-bottom:10px;">
                        <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('bunch.index', compact('bunch'))}}">
                        <i class="fa fa-backward" aria-hidden="true"></i> back
                        </a> 
                         <div class="col-md-2 col-sm-3 col-xs-4">
                <div class="pull-right">
                 
                {{ link_to_route('subscriber.create', 'create', [$bunch->id_bunch], ['class' => 'btn btn-info btn-xs']) }} 

                {{Form::open(['class' => 'confirm-delete', 'route' => ['bunch.destroy', $bunch->id_bunch], 'method' => 'DELETE'])}}
                    
                    {{ link_to_route('bunch.edit', 'edit', [$bunch->id_bunch], ['class' => 'btn btn-primary btn-xs']) }} |
                    
                    {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                    {{Form::close()}}
                                    
                                    
                </div>
            </div>
                      

                        

                        <div class="text-right"><i class="badge">{{ $bunch->subscribers->count() }}</i></div><br>
                        <hr>
                        <table class="table table-bordered table-responsive table-striped">
                            <tr>
                            <!--95%-->
                                <th width="5%">id</th>
                                <th width="15%">First Name</th>
                                <th width="15%">Last Name</th>
                                <th width="15%">Email</th>
                                <th width="5%">Viewed</th>
                                <th width="5%">Unsubscribe</th>
                                <th width="5%">Because</th>

                                
                                <th width="15%">Time</th>
                                <!--Actions-->
                                <th width="15%">Actions</th>
                            </tr>
                            <tr>
                            <!--colspan="4" id not-->
                                <td colspan="9" class="light-green-background no-padding" title="Create new template">
                                    <div class="row centered-child">
                                        <div class="col-md-12">

                                        </div>
                                    </div>
                                </td>
                            </tr>
                          
                            
                        @foreach ($bunch->subscribers as $subscriber)
                            <tr>
                            
                                <td>{{$subscriber->id_subscriber}}</td>
                                

                                <td>{{$subscriber->firstname_subscriber}}</td>
                                <td>{{$subscriber->lastname_subscriber}}</td>
                                <td>{{$subscriber->email_subscriber}}</td>
                                <td>{{$subscriber->report_id}}</td>
                                <td>{{$subscriber->report_id}}</td>
                                <td>{{$subscriber->report_id}}</td>
                                
                                <td>{{$subscriber->created_at}}</td>
                                <td>
                                 
                                    
                                    {{Form::open(['route' => array_merge(['subscriber.destroy'], compact('bunch', 'subscriber')), 'class' => 'confirm-delete','method' => 'DELETE'])}}

                                    {{ link_to_route('subscriber.edit', 'edit', ['bunch' => $bunch, 'subscriber' => $subscriber], ['class' => 'btn btn-success btn-xs']) }}

                                    
                                   
                                    
 |
                                    {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                                    {{Form::close()}}
                                </td>

                            </tr>
                        @endforeach
                        <div class="text-center">
                            { !! $subscribers->render() !!}

                        </div>
                             
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
