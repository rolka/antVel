<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('AdminTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('AddressesTableSeeder');
        $this->call('ProductsDetailTableSeeder');
        $this->call('ProductsTableSeeder');
        $this->call('OrdersTableSeeder');
        $this->call('ProductsRatesSeeder');
        $this->call('LogsTableSeeder');
        $this->call('CommentsTableSeeder');
        $this->call('VirtualProductsSeeder');
        $this->call('CompanyTableSeeder');
        $this->call('CompanyFeaturesSeeder');

        if (config('app.offering_free_products')) {
            $this->call('FreeProductsTableSeeder');
        }
    }
}
