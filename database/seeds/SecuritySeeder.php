<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SecuritySeeder extends Seeder
{

  protected $roles = array(
      'superAdmin',
      'admin',
      'editor'
  );
  protected $permissions = array(
      'super_manage',
      'create_event',
      'manage_users',
  );
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach ($this->permissions as $permission) {
          Permission::create(['name' => $permission ]);
       }
       foreach ($this->roles as $role) {
           Role::create(['name' => $role ]);
       }

       $editor = Role::where('name','editor')->first();
       $editor->givePermissionTo( Permission::where( 'name', 'create_event' )->first() );


       $superAdminRole = Role::where('name','superAdmin')->first();
       $adminRole = Role::where('name','admin')->first();

       $AdminPermissions = Permission::all();
       $superAdminPermissions = Permission::where('name','!=','manage_users')->get();
       $adminRole->syncPermissions( $AdminPermissions );
       $superAdminRole->syncPermissions( $superAdminPermissions );
    }
}
