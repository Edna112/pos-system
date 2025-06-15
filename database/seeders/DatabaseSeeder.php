<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\Purchase;
use App\Models\User;
use App\Models\Customer;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            CategorySeeder::class,
            UnitSeeder::class,
            ProductSeeder::class,
            SuperAdminSeeder::class,
            UserSeeder::class,
        ]);

        // Create orders first
        $orders = Order::factory(50)->create();
        
        // Create customers with orders
        $customers = Customer::factory(30)
            ->recycle($orders)
            ->create();

        // Create suppliers first
        $suppliers = Supplier::factory(20)->create();
        
        // Create purchases with suppliers
        $purchases = Purchase::factory(60)
            ->recycle($suppliers)
            ->create();

        // Create users last
        User::factory(10)
            ->recycle($suppliers)
            ->recycle($purchases)
            ->create();

        /*
        for ($i=0; $i < 10; $i++) {
            Product::factory()->create([
                'product_code' => IdGenerator::generate([
                    'table' => 'products',
                    'field' => 'product_code',
                    'length' => 4,
                    'prefix' => 'PC'
                ]),
            ]);
        }
        */

    }
}
