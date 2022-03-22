<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Action;
use App\Action_type;


class ManagementsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->isCustomer())
            return redirect('show');
        if(!auth()->user()->can('show_customers') )
            return abort(404);
     
        $employees = User::whereHas("roles", function($q){
            $q->where("name", "employee"); 
        })->get();
        if(auth()->user()->can('show_all_customers') )
            $customers = User::whereHas("roles", function($q){
                $q->where("name", "customer"); 
            })->get();
        else
            $customers=auth()->user()->assigned_cutomers()->get();
       $action_types= Action_type::all();
        return view('home' ,compact('customers','employees','action_types'));
    }

    public function show(int $id=null){

        $user=auth()->user();
        if(isset($id)){
            if($user->isCustomer())
                return abort(404);
            $user= User::findOrFail($id);
        }
        if(!$user->isCustomer() )
            return abort(404);
        return view('user.show',compact('user'));
    }
    public function createCustomer()
    {

        if(auth()->user()->can('create_customer') )
            return view('user.create',['userType'=>'customer']);
        else
            return abort(404);
      
    }
    public function createEmployee()
    {   
        if(auth()->user()->can('create_employee') )
            return view('user.create',['userType'=>'employee']);
        else
            return abort(404);

    }
    public function storeUser(Request $request)
    {
        $permission = "create_".$request->user_Type;
        $role = '';
       
        ($request->user_Type =='customer')? $role='customer': 
            (($request->user_Type =='employee')? $role = 'employee' 
                : (dd(404))     );
        $this->validate($request, [
        'name' => 'required|min:3|max:50',
        'email' => 'required|email',
        'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        'password_confirmation' => 'min:6',
        'user_Type' =>'required'
        ]);
        //dd($role);
        if( !auth()->user()->can($permission))
           return abort(404);

        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($role);
        return redirect('home'); 
    }

    public function updateCustomer(Request $request){
        //dd($request->all());
         $this->validate($request, [
            'customer_id' => 'required',
        ]);
         //create action
        if(isset($request->action_id)){
            if(!auth()->user()->can('add_action') )
            return abort(404);
        $action=Action::create([
            'type_id' => $request->action_id,
            'employee_id' => auth()->user()->id,
            'customer_id' => $request->customer_id,
        ]);
            
        }

        //assign cutomer to employee
        if(isset($request->employee_id)){
            if(!auth()->user()->can('asign_customer_to_employee') || !isset($request->customer_id))
                return abort(404);    
            $employee = User::findOrFail($request->employee_id);
            $employee->assigned_cutomers()->attach([$request->customer_id]);
        }
        return back();
        
    }

}
