<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_creates_and_authenticates_a_user(): void
    {
        $response = $this->post(route('register.store'), [
            'name' => 'LuminaShipper',
            'email' => 'fan@example.com',
            'password' => 'secret-password',
            'favorite_actor' => 'mina-park',
            'favorite_genre' => 'romance-fantasy',
            'terms' => '1',
            'updates' => '1',
        ]);

        $user = User::where('email', 'fan@example.com')->firstOrFail();

        $response->assertRedirect(route('profile.edit'));
        $this->assertAuthenticatedAs($user);
        $this->assertSame('LuminaShipper', $user->name);
        $this->assertSame('mina-park', $user->favorite_actor);
        $this->assertTrue($user->updates);
        $this->assertNotNull($user->terms_accepted_at);
    }

    public function test_login_accepts_a_handle(): void
    {
        $user = User::create([
            'name' => 'Fan User',
            'email' => 'fan@example.com',
            'handle' => 'lumina',
            'password' => 'secret-password',
        ]);

        $response = $this->post(route('login.store'), [
            'email' => '@lumina',
            'password' => 'secret-password',
        ]);

        $response->assertRedirect(route('profile.edit'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_profile_update_persists_fields_and_avatar(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(route('profile.update'), [
            'name' => 'Updated Fan',
            'handle' => '@updated_fan',
            'bio' => 'Novelas y fandom.',
            'city' => 'Madrid',
            'avatar' => UploadedFile::fake()->create('avatar.jpg', 100, 'image/jpeg'),
        ]);

        $user->refresh();

        $response->assertRedirect(route('profile.edit'));
        $this->assertSame('updated_fan', $user->handle);
        $this->assertSame('Novelas y fandom.', $user->bio);
        $this->assertSame('Madrid', $user->city);
        $this->assertNotNull($user->avatar_path);
        Storage::disk('public')->assertExists($user->avatar_path);
    }

    public function test_registration_requires_terms_acceptance(): void
    {
        $response = $this->from(route('register'))->post(route('register.store'), [
            'name' => 'LuminaShipper',
            'email' => 'fan@example.com',
            'password' => 'secret-password',
            'favorite_actor' => 'mina-park',
            'favorite_genre' => 'romance-fantasy',
        ]);

        $response->assertRedirect(route('register'));
        $response->assertSessionHasErrors('terms');
        $this->assertDatabaseCount('users', 0);
    }
}