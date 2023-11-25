<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Role::truncate();

        Role::factory(1)->create();
        Role::factory(1)->create(['name'=>"admin"]);


        $routes=Route::getRoutes();
        $permissions_id=[];

        // insertion de toutes les url d'admin dans la table permission
        foreach ($routes as $route){
            if (strpos($route->getName(),'app')!==false)
            {
                $permission=Permission::create(['name'=>$route->getName()]);
                $permissions_id[]=$permission->id;
                //var_dump($route->getName());
            }

        }

        Role::where('name','admin')->first()->permissions()->sync($permissions_id);

        User::factory(1)->create();


        User::factory()->create([
            'name'=>'Chot',
            'sname'=>'Apend',
            'lname'=>'Rodrigue',
            'gender'=>'m',
            'phone'=>'243992522582',
            'email'=>'rodriguechot@gmail.com',
            'role_id'=>2,
        ]);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
