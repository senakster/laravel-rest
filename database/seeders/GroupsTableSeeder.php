<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Seeder;
use App\Models\Group;
use App\Models\Grouplink;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Group::truncate();
        Grouplink::truncate();
        Schema::enableForeignKeyConstraints();

        $groups = file_get_contents('https://omstilmig.nu/gnf-groups/groups/list');
        $groups = json_decode($groups)->data;

        foreach($groups as $i => $g) {
            Group::create([
                'name' => $g->name,
                'municipality' => $g->municipality,
                'grouptype' => $g->grouptype,
                'description' => isset($g->description) ? $g->description : '',
                'status' => $g->status,
            ]);
            $links = json_decode($g->links);
            foreach($links as $l) {
                // die(var_dump($l));
                Grouplink::create([
                    'group_id' => strval($i + 1),
                    'name' => $l->name,
                    'url' => $l->url,
                    'description' => isset($l->description) ? $l->description : '',
                ]);
            }
        }
    }
}
