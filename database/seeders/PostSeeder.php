<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Database\Factories\Helpers\FactoryHelper;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    use TruncateTable, DisableForeignKeys;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->disableForeignKeys();

        $this->truncate('posts');

        $posts = Post::factory(3)
            ->create();
//        dump(count($posts));

        // seed post_user table
//        $posts->each(function (Post $post){
//           $post->users()->sync([FactoryHelper::getRandomModelId(User::class)]);
//        });
//        foreach ($posts as $post){
//            $post->users()->sync([FactoryHelper::getRandomModelId(User::class)]);
//        }
        $this->enableForeignKeys();


        $this->disableForeignKeys();

        $this->truncate('post_user');
        for ($i = 1; $i <= count($posts) ; $i++ ){
            DB::table('post_user')->insert(
                array(
                    'user_id' => FactoryHelper::getRandomModelId(User::class),
                    'post_id' => FactoryHelper::getRandomModelId(Post::class),
                )
            );
        }
        $this->enableForeignKeys();

    }
}
