<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call( SecuritySeeder::class );
        $this->call( ContentSeeder::class );
        $admin = new User();
        $admin->name =  'admin';
        $admin->email =  'admin@admin.com';
        $admin->password =  bcrypt('password');
        $admin->save();
        $adminUser = User::find(1);
        $adminUser->syncRoles('superAdmin');
    }
}
