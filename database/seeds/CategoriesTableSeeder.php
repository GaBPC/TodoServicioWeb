<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=0; $i < 15; $i++) {
        DB::table('categories')->insert([
          'category_name' => 'cat'.$i,
          'created_at' => DB::raw('CURRENT_TIMESTAMP'),
          'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
      }
    }
}
