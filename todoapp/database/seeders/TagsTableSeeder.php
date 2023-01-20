<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = ['item' => '家事'];
        Tag::create($param);
        $param = ['item' => '勉強'];
        Tag::create($param);
        $param = ['item' => '運動'];
        Tag::create($param);
        $param = ['item' => '食事'];
        Tag::create($param);
        $param = ['item' => '移動'];
        Tag::create($param);

    }
}
