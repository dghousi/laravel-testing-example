<?php
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;

test('authenticated user can store a post', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('/posts', [
        'title' => 'My First Post',
        'body' => 'This is the content of the post.',
    ]);

    $response->assertStatus(302); // Assuming redirect after storing
    $this->assertDatabaseHas('posts', [
        'title' => 'My First Post',
        'body' => 'This is the content of the post.',
        'user_id' => $user->id,
    ]);
});



test('allows a user to update a post', function () {
    // Create a user and a post
    $user = User::factory()->create(); // Create a user using a factory
    $this->actingAs($user); // Set the authenticated user
    $post = Post::factory()->create(['user_id' => $user->id]); // Create a post

    // New data to update the post
    $updatedData = [
        'title' => 'Updated Post Title',
        'content' => 'Updated content for the post.',
    ];

    // Send a PUT request to update the post
    $response = $this->put(route('posts.update', $post->id), $updatedData);

    // Assert the response is a redirect
    $response->assertRedirect(); // Check if it redirects after update

    // Assert the post was updated in the database
    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Updated Post Title',
        'content' => 'Updated content for the post.',
    ]);

    // Optionally, check if the old data no longer exists
    $this->assertDatabaseMissing('posts', [
        'id' => $post->id,
        'title' => $post->title,
        'content' => $post->content,
    ]);
});