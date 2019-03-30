@extends('admin.layout')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blank page
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Listing</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               @if(Auth::check())
                    <div class="leave-comment">
              <div class="form-group">

                <a href="{{route('users.create')}}" class="btn btn-success">Add</a>
              </div>
              <div class="form-group">
                <a href="{{route('admin.users.toggleDiscontIdAll')}}" class="btn btn-success">Del All Privat Disconts</a>
              </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Is Admin?</th>
                  <th>Bun?</th>
                  <th>%?</th>
                  <th>ID</th>
                  <th>Name</th>
                  <th>E-mail</th>
                  <th>Privat %</th>
                  
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
	                <tr>
                     <td>
                  @if($user->is_admin == 0)
                    <a href="users/toggleAdmin/{{$user->id}}" class="fa fa-lock"></a> 
                  @else
                      <a href="users/toggleAdmin/{{$user->id}}" class="fa fa-thumbs-o-up"></a> 
                  @endif
              </td>
              <td>
                  @if($user->status == 0)
                    <a href="users/toggleBan/{{$user->id}}" class="fa fa-thumbs-o-up"></a> 
                  @else
                      <a href="users/toggleBan/{{$user->id}}" class="fa fa fa-lock"></a> 
                  @endif
              </td>
              <td> 
                  @if($user->status_discont_id == 0)
                    <a href="users/toggleDiscontId/{{$user->id}}" class="fa fa fa-lock"></a> 
                  @else
                      <a href="users/toggleDiscontId/{{$user->id}}" class="fa fa-thumbs-o-up"></a> 
                  @endif
              </td>
	                  <td>{{$user->id}}</td>
	                  <td>{{$user->name}}</td>
	                  <td>{{$user->email}}</td>
                    @if($user->status_discont_id == 0)
                    <td>{{0}}</td>
                    @else
                    <td>{{$user->discont_id}}</td>
                    @endif
	                  <td> 
	                  <a href="{{route('users.edit', $user->id)}}" class="fa fa-pencil"></a> 
	                  {{Form::open(['route'=>['users.destroy', $user->id], 'method'=>'delete'])}}
	                  <button onclick="return confirm('are you sure?')" type="submit" class="delete">
	                   <i class="fa fa-remove"></i>
	                  </button>
                    <!--trash ?for user create book magaz->purch->order-->
                    {{--Form::open(['route' => array_merge(['subscriber.destroy'], compact('bunch', 'subscriber')), 'class' => 'confirm-delete','method' => 'DELETE'])--}}

                                    {{-- link_to_route('subscriber.edit', 'edit', ['bunch' => $bunch, 'subscriber' => $subscriber], ['class' => 'btn btn-success btn-xs']) --}}
                                    {{--Form::close()--}}<!--trash-->
	                   {{Form::close()}}
	                  </td>
	                </tr>
                @endforeach

                </tfoot>
              </table>
              @endif
 
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection