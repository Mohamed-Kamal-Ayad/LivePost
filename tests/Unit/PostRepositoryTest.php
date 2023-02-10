<?php

namespace Tests\Unit;

use App\Exceptions\GeneralJsonException;
use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_create()
    {
        //1. define the goal
        //test if create() will actually create a record in the DB

        //2.replicate the env / restriction
        //we need instance of PostRepo class
        $repository = new PostRepository();

        //3. define the source of truth "result"
        $payload = [
            'title' => 'kimya',
            'body' => []
        ];
        //4. comapre result
        $result = $repository->create($payload);

        $this->assertSame($payload['title'], $result->title, 'Post Created failed');
    }

    public function test_update()
    {
        //goal : update is work

        //env
        $repository = $this->app->make(PostRepository::class);

        $dummyPost = Post::factory(1)->create()[0];

        //source of truth
        $payload = [
            'title' => 'title1'
        ];

        //compare
        $updated = $repository->update($dummyPost, $payload);
        $this->assertSame($payload['title'], $updated->title, 'updated post faild');

    }

    public function test_delete()
    {
        //goal : delete is work

        //env
        $repository = $this->app->make(PostRepository::class);

        $dummyPost = Post::factory(1)->create()[0];


        //compare
        $deleted = $repository->forceDelete($dummyPost);

        $found = Post::query()->find($dummyPost->id);
        $this->assertSame(null, $found, 'deleted post faild');
    }

    public function test_delete_will_throw_exception_when_delete_post_that_doesnt_exist()
    {
        //env
        $repository = $this->app->make(PostRepository::class);

        $dummyPost = Post::factory(1)->make()->first();
        $this->expectException(GeneralJsonException::class);
        $deleted = $repository->forceDelete($dummyPost);
    }
}
