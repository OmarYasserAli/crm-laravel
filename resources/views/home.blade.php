@extends('layouts.app')

@section('content')

<!------ Include the above in your HEAD tag ---------->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Updat Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{route('customer.update')}}">
        @csrf
      <div class="modal-body" >
           <input id='edit_customer_id' type="hidden" name="customer_id" value="">
           @can('add_action')
               <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Add action</label>
                        <div class="col-md-6">
                            <select  class="col-md-4 form-control" name="action_id">
                                <option value="">...</option>
                                @foreach($action_types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                               
                            </select>

                        </div>
                </div>
            @endcan
            @can('asign_customer_to_employee')
               <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Assign customer</label>
                        <div class="col-md-6">
                            <select  class="col-md-4 form-control" name="employee_id">
                                <option value="">...</option>
                                @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->name}}</option>
                                @endforeach
                            </select>

                        </div>
                </div>
            @endcan
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
  

        <div class="col-md-10 content"> 
              <div class="panel panel-default panel-table">
     <div class="panel-heading">
                <div class="row">
                  <div class="col col-xs-6">
                    <h3 class="panel-title">Customers</h3>
                  </div>
                  
                </div>
              </div>
<div class="panel-body">
                <table class="table table-striped table-bordered table-list">
                  <thead>
                    <tr>
                        <th><em class="fa fa-cog"></em></th>
                         <th>employee</th>
                        <th>Name</th>
                        <th>Email</th>
                       
                        <th>actions</th>
                    </tr> 
                  </thead>
                  <tbody>
                    @foreach($customers as $customer)
                          <tr>
                            <td align="center">
                              <a class="btn btn-default edit-customer" data-toggle="modal" data-target="#exampleModalCenter" data-id='{{$customer->id}}'><em class="fa fa-pencil" ></em></a>
                             <a class="btn btn-default edit-customer" href="{{route('user.show',['id'=>$customer->id])}}"><em class="fa fa-eye" ></em>
                            </td>
                            <td>
                                @foreach($customer->customers_employees as $employee)
                                {{$employee->name}}, 
                                @endforeach
                            </td>
                            
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->email}}</td>
                            
                             <td>
                                @foreach($customer->actions as $action)
                                {{$action->Action_type->name}} - {{$action->created_at}}<br>
                                @endforeach
                            </td>
                          </tr>
                    @endforeach
                        </tbody>
                </table>
            
              </div>
</div>
        </div>
        <footer class="pull-left footer">
            <p class="col-md-12">
                <hr class="divider">
                Copyright &COPY; 2015 <a href="http://www.pingpong-labs.com">Gravitano</a>
            </p>
        </footer>
    

    <script type="text/javascript">
        $('.edit-customer').click(function(){
            $('#edit_customer_id').val($(this).data("id")) ;
        })
    </script>
@endsection
