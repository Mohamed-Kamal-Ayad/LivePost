<?php

namespace Tests\Feature\Api\V1\Post;

use App\Events\Models\Post\PostCreated;
use App\Events\Models\Post\PostDeleted;
use App\Events\Models\Post\PostUpdated;
use App\Models\Post;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        //load some data in db
        $posts = Post::factory(10)->create();
        $postIds = $posts->map(fn($post) => $post->id);
        //$postIds = array_map(fn($post) => $post['id'], $posts->toArray());

        //call index endpoint
        $response = $this->json('get', '/api/v1/posts');
        //assert status
        $response->assertStatus(200);
        //verify records
        $data = $response->json('data');
        collect($data)->each(fn($post) => $this->assertTrue(in_array($post['id'], $postIds->toArray())));
        //each ->> loop without making new array
        //map ->> loop with making new collection with new vars *array_map* ->> return array not collection
        //dump($data);
    }

    public function test_show()
    {
        $dummy = Post::factory()->create();
        $response = $this->json('get', '/api/v1/posts/' . $dummy->id);
        $result = $response->assertStatus(200)->json('data'); //array
        $this->assertEquals(data_get($result, 'id'), $dummy->id, 'Respone Id not the same in model');
    }

    public function test_create()
    {
        Event::fake();
        $dummy = Post::factory()->make();
        //echo gettype($dummy); ->> object
        $response = $this->json('post', '/api/v1/posts', $dummy->toArray());
        $result = $response->assertStatus(201)->json('data');
        Event::assertDispatched(PostCreated::class);
        $result = collect($result)->only(array_keys($dummy->getAttributes()));

        $result->each(function ($value, $key) use ($dummy) {
            $this->assertSame(data_get($dummy, $key), $value, 'Fillable is not the same');
        });
    }

    public function test_update()
    {
        $dummy = Post::factory()->create();
        $dummy2 = Post::factory()->make();
        Event::fake();
        $fillables = collect((new Post())->getFillable());

        $fillables->each(function ($toUpdate) use ($dummy, $dummy2) {
            $response = $this->json('patch', '/api/v1/posts/' . $dummy->id, [
                $toUpdate => data_get($dummy2, $toUpdate)
            ]);

            $result = $response->assertStatus(200)->json('data');
            Event::assertDispatched(PostUpdated::class);
            $this->assertSame(data_get($dummy2, $toUpdate), data_get($dummy->refresh(), $toUpdate), 'Failed to update model');
        });

    }

    public function test_delete()
    {
        Event::fake();
        $dummy = Post::factory()->create();
        $response = $this->json('delete', '/api/v1/posts/' . $dummy->id);
        $result = $response->assertStatus(200);
        Event::assertDispatched(PostDeleted::class);
        $this->expectException(ModelNotFoundException::class);
        Post::query()->findOrFail($dummy->id);
    }
}
