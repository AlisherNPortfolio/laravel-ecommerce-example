<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Category\Models\Category;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $categories = [
            [
                'name' => 'Root',
                'order' => 1,
                'lft' => 1,
                'rgt' => 34,
                'parent_id' => null,
                'slug' => 'root',
            ],
            [
                'name' => 'Kiyimlar',
                'order' => 2,
                'position' => 1,
                'lft' => 2,
                'rgt' => 27,
                'parent_id' => 1,
                'slug' => 'kiyimlar',
            ],
            [
                'name' => 'Elektrotexnika',
                'order' => 3,
                'position' => 1,
                'lft' => 28,
                'rgt' => 33,
                'parent_id' => 1,
                'slug' => 'elektrotexnika',
            ],
            [
                'name' => 'Erkaklar',
                'order' => 4,
                'position' => 2,
                'lft' => 3,
                'rgt' => 10,
                'parent_id' => 2,
                'slug' => 'erkaklar',
            ],
            [
                'name' => 'Ayollar',
                'order' => 5,
                'position' => 2,
                'lft' => 11,
                'rgt' => 18,
                'parent_id' => 2,
                'slug' => 'ayollar',
            ],
            [
                'name' => 'Bolalar',
                'order' => 6,
                'position' => 2,
                'lft' => 19,
                'rgt' => 26,
                'parent_id' => 2,
                'slug' => 'bolalar',
            ],
            [
                'name' => 'Ko\'ylaklar',
                'order' => 7,
                'position' => 3,
                'lft' => 4,
                'rgt' => 5,
                'parent_id' => 4,
                'slug' => 'koylaklar',
            ],
            [
                'name' => 'Oyoq kiyimlar',
                'order' => 8,
                'position' => 3,
                'lft' => 6,
                'rgt' => 7,
                'parent_id' => 4,
                'slug' => 'oyoq-kiyimlar',
            ],
            [
                'name' => 'Shimlar',
                'order' => 9,
                'position' => 3,
                'lft' => 8,
                'rgt' => 9,
                'parent_id' => 4,
                'slug' => 'shimlar',
            ],
            [
                'name' => 'Ko\'ylaklar',
                'order' => 10,
                'position' => 3,
                'lft' => 12,
                'rgt' => 13,
                'parent_id' => 5,
                'slug' => 'koylaklar-1',
            ],
            [
                'name' => 'Oyoq kiyimlar',
                'order' => 11,
                'position' => 3,
                'lft' => 14,
                'rgt' => 15,
                'parent_id' => 5,
                'slug' => 'oyoq-kiyimlar-1',
            ],
            [
                'name' => 'Ro\'mollar',
                'order' => 12,
                'position' => 3,
                'lft' => 16,
                'rgt' => 17,
                'parent_id' => 5,
                'slug' => 'romollar',
            ],
            [
                'name' => 'Ko\'ylaklar',
                'order' => 13,
                'position' => 3,
                'lft' => 20,
                'rgt' => 21,
                'parent_id' => 6,
                'slug' => 'koylaklar-2',
            ],
            [
                'name' => 'Oyoq kiyimlar',
                'order' => 14,
                'position' => 3,
                'lft' => 22,
                'rgt' => 23,
                'parent_id' => 6,
                'slug' => 'oyoq-kiyimlar-2',
            ],
            [
                'name' => 'Shimlar',
                'order' => 15,
                'position' => 3,
                'lft' => 24,
                'rgt' => 25,
                'parent_id' => 6,
                'slug' => 'shimlar-1',
            ],
            [
                'name' => 'Kompyuterlar',
                'order' => 16,
                'position' => 2,
                'lft' => 29,
                'rgt' => 30,
                'parent_id' => 3,
                'slug' => 'kompyuterlar',
            ],
            [
                'name' => 'Telefonlar',
                'order' => 17,
                'position' => 2,
                'lft' => 31,
                'rgt' => 32,
                'parent_id' => 3,
                'slug' => 'telefonlar',
            ],
            //  [
            //     'name' => 'Root',
            //     'order' => 1,
            //     'position' => 0,
            //     'lft' => 1,
            //     'rgt' => 14,
            //     'parent_id' => null,
            // 'slug' => 'root'
            // ],
            // [
            //     'name' => 'Kiyimlar',
            //     'order' => 1,
            //     'position' => 1,
            //     'lft' => 2,
            //     'rgt' => 9,
            //     'parent_id' => 1,
            // 'slug' => 'kiyimlar'
            // ],
            // [
            //     'name' => 'Elektrotexnika',
            //     'order' => 2,
            //     'position' => 1,
            //     'lft' => 10,
            //     'rgt' => 13,
            //     'parent_id' => 1,
            // 'slug' => 'elektrotexnika'
            // ],
            // [
            //     'name' => 'Erkaklar',
            //     'order' => 1,
            //     'position' => 2,
            //     'lft' => 3,
            //     'rgt' => 4,
            //     'parent_id' => 2,
            // 'slug' => 'erkaklar'
            // ],
            // [
            //     'name' => 'Ayollar',
            //     'order' => 2,
            //     'position' => 2,
            //     'lft' => 5,
            //     'rgt' => 6,
            //     'parent_id' => 2,
            // 'slug' => 'ayollar'
            // ],
            // [
            //     'name' => 'Bolalar',
            //     'order' => 3,
            //     'position' => 2,
            //     'lft' => 7,
            //     'rgt' => 8,
            //     'parent_id' => 2,
            // 'slug' => 'bolalar'
            // ],
            // [
            //     'name' => 'Telefonlar',
            //     'order' => 1,
            //     'position' => 2,
            //     'lft' => 11,
            //     'rgt' => 12,
            //     'parent_id' => 3,
            // 'slug' => 'telefonlar'
            // ],
        ];

        Category::withoutEvents(function () use ($categories) {
            foreach ($categories as $category) {
                Category::query()->create($category);
            }
        });
    }
}
