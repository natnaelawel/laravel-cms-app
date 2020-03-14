<?php

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1 = Category::create([
            'name' =>'News'
        ]);
        $category2 = Category::create([
            'name' =>'Marketing'
        ]);
        $category3 = Category::create([
            'name' =>'Partnership'
        ]);
        $category4 = Category::create([
            'name' =>'Products'
        ]);

        $author1 = User::create([
            'name'=>'Bekele',
            'email'=>'bekele.matiwos@gmail.com',
            'password'=> Hash::make('natiawel'),
        ]);
        $author2 = User::create([
            'name'=>'kebede',
            'email'=>'kebede.matiwos@gmail.com',
            'password'=> Hash::make('natiawel'),
        ]);
        $post1 = Post::create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, incidunt.",
            'content' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore qui pariatur odit exercitationem illum incidunt!",
            'category_id'=> $category1->id,
            'user_id'=>$author1->id,
            'image' => 'posts/6.jpg'
            ]);
        $post2 = Post::create([
            'title' => 'Best practices for minimalist design with example',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, incidunt.",
            'content' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore qui pariatur odit exercitationem illum incidunt!",
            'category_id'=> $category2->id,
            'user_id'=>$author2->id,
            'image' => 'posts/7.jpg'
            ]);
        $post3 = Post::create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, incidunt.",
            'content' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore qui pariatur odit exercitationem illum incidunt!",
            'user_id'=>$author1->id,
            'category_id'=> $category3->id,
            'image' => 'posts/8.jpg'
            ]);
            //we can also create like this
            
        $post4 = $author2->posts()->create([
            'title' => 'This is why it\'s time to ditch dress codes at work',
            'description' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum, incidunt.",
            'content' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore qui pariatur odit exercitationem illum incidunt!",
            'category_id'=> $category4->id,
            'image' => 'posts/9.jpg'
            ]);

        $tag1 = Tag::create([
            'name' => 'Record',
        ]);
        $tag2 = Tag::create([
            'name' => 'Customers',
        ]);
        $tag3 = Tag::create([
            'name' => 'Offer',
        ]);
        $tag4 = Tag::create([
            'name' => 'Job',
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag3->id, $tag4->id]);
        $post3->tags()->attach([$tag4->id, $tag1->id]);
        $post4->tags()->attach([$tag2->id, $tag3->id]);

    }
}
