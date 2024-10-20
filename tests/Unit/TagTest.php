<?php

namespace Tests\Unit;

use App\Models\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_can_create_a_tag()
    {
        $tagData = Tag::factory()->make()->toArray();

        $this->post('/test/tags', $tagData)
            ->assertStatus(201);

        $this->assertDatabaseHas('tags', ['name' => $tagData['name']]);
    }

    /** @test */
    public function it_can_read_a_tag()
    {
        $tag = Tag::factory()->create();

        $this->get('/test/tags/' . $tag->id)
            ->assertStatus(200)
            ->assertJson($tag->toArray());
    }

    /** @test */
    public function it_can_update_a_tag()
    {
        $tag = Tag::factory()->create();

        $updatedData = Tag::factory()->make()->toArray();

        $this->put('/test/tags/' . $tag->id, $updatedData)
            ->assertStatus(200);

        $this->assertDatabaseHas('tags', $updatedData);
    }

    /** @test */
    public function it_can_delete_a_tag()
    {
        $tag = Tag::factory()->create();

        $this->delete('/test/tags/' . $tag->id)
            ->assertStatus(204);

        $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
    }
}
