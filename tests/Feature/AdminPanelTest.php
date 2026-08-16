<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['type' => 'admin']);
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/admin/posts/all')->assertRedirect('/login');
    }

    public function test_non_admin_cannot_login(): void
    {
        $user = User::factory()->create(['type' => 'user']);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertSessionHasErrors();

        $this->assertGuest();
    }

    public function test_admin_can_view_posts_list(): void
    {
        $post = Post::factory()->create();

        $this->actingAs($this->admin())
            ->get('/admin/posts/all')
            ->assertStatus(200)
            ->assertSee($post->title);
    }

    public function test_admin_can_create_a_post_with_category(): void
    {
        $category = Category::factory()->create();

        $this->actingAs($this->admin())->post('/admin/posts/save', [
            'title' => 'My Admin Post',
            'content' => 'Some content here.',
            'category_id' => $category->id,
            'is_active' => 'Yes',
        ])->assertRedirect('/admin/posts/all');

        $this->assertDatabaseHas('posts', [
            'title' => 'My Admin Post',
            'category_id' => $category->id,
        ]);
    }

    public function test_unknown_urls_show_custom_404(): void
    {
        $this->get('/this-page-does-not-exist')
            ->assertStatus(404)
            ->assertSee('Page Not Found');
    }
}
