<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 2) as $i) {
            $root = Tag::create([
                'name' => "Root Tag $i",
                'slug' => "root-tag-$i",
                'parent_id' => null,
            ]);

            foreach (range(1, 2) as $j) {
                $child = Tag::create([
                    'name' => "Child Tag $i.$j",
                    'slug' => "child-tag-$i-$j",
                    'parent_id' => $root->id,
                ]);

                foreach (range(1, 2) as $k) {
                    Tag::create([
                        'name' => "Grandchild Tag $i.$j.$k",
                        'slug' => "grandchild-tag-$i-$j-$k",
                        'parent_id' => $child->id,
                    ]);
                }
            }
        }
    }
}
