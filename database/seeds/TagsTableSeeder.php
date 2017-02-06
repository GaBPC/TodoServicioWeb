<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
  /**
  * Run the database seeds.
  *
  * @return void
  */
  public function run()
  {
    $names = array(
      "Selladores", "Jardines", "Herramientas", "Caños", "PVC", "Galvanizados",
      "Cocinas", "Baños", "Estufas", "Calefones", "Impermeabilizantes", "Interiors",
      "Exteriores", "Mangueras", "Piletas"
    );
    foreach ($names as $name) {
      DB::table('tags')->insert([
        'name' => $name,
        'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
      ]);
    }
  }
}
