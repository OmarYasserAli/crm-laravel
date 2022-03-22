@extends('layouts.app')

@section('content')

<!------ Include the above in your HEAD tag ---------->
 
  

        <div class="col-md-10 content"> 
              <div class="panel panel-default panel-table">
     <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">{{$user->name}}'s Records</h3>
                  </div>
                  <div class="col col-xs-6 text-right">
                   
                  </div>
                </div>
              </div>
<div class="panel-body">
       <div class="col-md-8">
            <div class="card">
                <div class="card-header"><br></div>

                <div class="card-body">
                    <table class="table">
                        <thead></thead>
                            <th>Action Name</th >
                            <th>by</th>
                            <th>Time</th>
                        <tbody>
                            @foreach($user->actions as $action)
                            <tr>
                                <td>{{$action->Action_type->name}}</td>
                                <td>{{$action->maker->name}}</td>
                                <td>{{$action->created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
              </div>
</div>
        </div>
        <footer class="pull-left footer">
            <p class="col-md-12">
                <hr class="divider">
                Copyright &COPY; 2015 <a href="http://www.pingpong-labs.com">Gravitano</a>
            </p>
        </footer>
    
@endsection
