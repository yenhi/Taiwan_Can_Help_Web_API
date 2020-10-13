<?php

use App\Entities\UnitType;
use Illuminate\Database\Seeder;

class UnitTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $items = [
            ['government', '政府機關'],
            ['enterprise', '公司企業'],
            ['non-government', '民間團體'],
            ['social-enterprise', '社創組織'],
        ];
        foreach ($items as $item) {
            UnitType::create([
                'mapping_code' => $item[0],
                'name' => $item[1],
            ]);
        }
    }
}
