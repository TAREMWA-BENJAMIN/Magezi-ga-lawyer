<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_submission_saves_to_database(): void
    {
        $contactData = [
            'name'    => 'John Doe',
            'email'   => 'john@example.com',
            'phone'   => '+256777000000',
            'subject' => 'Inquiry about land law',
            'message' => 'Hello, I have a dispute regarding my land boundaries in Mukono.',
        ];

        $response = $this->postJson('/api/public/contact', $contactData);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                 ]);

        $this->assertDatabaseHas('contact_submissions', [
            'name'    => 'John Doe',
            'email'   => 'john@example.com',
            'phone'   => '+256777000000',
            'subject' => 'Inquiry about land law',
            'message' => 'Hello, I have a dispute regarding my land boundaries in Mukono.',
        ]);
    }

    public function test_admin_contacts_page_renders_successfully(): void
    {
        $response = $this->get(route('admin.contacts'));

        $response->assertStatus(200)
                 ->assertViewIs('admin.contacts')
                 ->assertViewHas('submissions');
    }
}
