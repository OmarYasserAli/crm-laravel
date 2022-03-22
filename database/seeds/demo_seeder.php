<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Action_type;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
class demo_seeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name' => 'add_action']);
        Permission::create(['name' => 'asign_customer_to_employee']);
        Permission::create(['name' => 'create_customer']);
        Permission::create(['name' => 'create_employee']);
        Permission::create(['name' => 'show_all_customers']);
        Permission::create(['name' => 'show_customers']);
        
        //Create Employee admin
        $role1 = Role::create(['name' => 'admin']);
        $role1->givePermissionTo('add_action');
        $role1->givePermissionTo('asign_customer_to_employee');
        $role1->givePermissionTo('create_customer');
        $role1->givePermissionTo('create_employee');
        $role1->givePermissionTo('show_all_customers');
        $role1->givePermissionTo('show_customers');

        //Create Employee role
        $role2 = Role::create(['name' => 'employee']);
        $role2->givePermissionTo('add_action');
        $role2->givePermissionTo('create_customer');
        $role2->givePermissionTo('show_customers');

        //Create Employee customer
        $role3 = Role::create(['name' => 'customer']);


        //create Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('123456'),
        ]);
        $admin->assignRole($role1);


        //create employees
        $employee1 = User::create([
            'name' => 'Employee1',
            'email' => 'employee1@mail.com',
            'password' => Hash::make('123456'),
        ]);
        $employee1->assignRole($role2);
        $employee2 = User::create([
            'name' => 'Employee2',
            'email' => 'employee2@mail.com',
            'password' => Hash::make('123456'),
        ]);
        $employee2->assignRole($role2);
        $employee3 = User::create([
            'name' => 'Employee3',
            'email' => 'employee3@mail.com',
            'password' => Hash::make('123456'),
        ]);
        $employee3->assignRole($role2);


        //create Customers
        $customer1 = User::create([
            'name' => 'Customer1',
            'email' => 'customer1@mail.com',
            'password' => Hash::make('123456'),
        ]);
        $customer1->assignRole($role3);
        $customer2 = User::create([
            'name' => 'Customer2',
            'email' => 'customer2@mail.com',
            'password' => Hash::make('123456'),
        ]);
        $customer2->assignRole($role3);
        $customer3 = User::create([
            'name' => 'Customer3',
            'email' => 'customer3@mail.com',
            'password' => Hash::make('123456'),
        ]);
        $customer3->assignRole($role3);
        $customer4 = User::create([
            'name' => 'Customer4',
            'email' => 'customer4@mail.com',
            'password' => Hash::make('123456'),
        ]);
        $customer4->assignRole($role3);




        //assign customer to  employee
        $employee1->assigned_cutomers()->sync([$customer1->id,$customer2->id,$customer3->id]);
        $employee2->assigned_cutomers()->sync([$customer1->id,$customer4->id]);


        $type = Action_type::create([
            'name' => 'call',
        ]);
        $type = Action_type::create([
            'name' => 'visit',
        ]);
        $type = Action_type::create([
            'name' => 'follow',
        ]);

    }
}
