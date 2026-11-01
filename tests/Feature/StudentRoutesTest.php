<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_mvc_routes_are_available(): void
    {
        $this->get('/hello/Ada')
            ->assertOk()
            ->assertSeeText('Hello, Ada');

        $this->get('/about')
            ->assertOk()
            ->assertSeeText('About');
    }

    public function test_student_form_has_csrf_token_and_post_displays_flash_message(): void
    {
        $this->get('/students/create')
            ->assertOk()
            ->assertSee('name="_token" value="', false);

        $response = $this->post('/students', [
            'roll_no' => 'TEST-01',
            'name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'department' => 'CSE',
            'semester' => 7,
            'cgpa' => 9.5,
        ]);

        $response->assertRedirect(route('students.index'))
            ->assertSessionHas('success', 'Student saved successfully!');

        $this->get(route('students.index'))
            ->assertOk()
            ->assertSeeText('Student saved successfully!');
    }

    public function test_missing_student_returns_not_found(): void
    {
        $this->get('/students/999999')->assertNotFound();
    }

    public function test_student_api_returns_an_array_and_schema_is_defined(): void
    {
        $this->getJson('/api/students')
            ->assertOk()
            ->assertJsonIsArray();

        $schema = json_decode(
            file_get_contents(base_path('public/schema/student.schema.json')),
            true,
            flags: JSON_THROW_ON_ERROR,
        );

        $this->assertSame('https://json-schema.org/draft/2020-12/schema', $schema['$schema']);
        $this->assertSame('object', $schema['type']);
        $this->assertNotEmpty($schema['properties']);
        $this->assertNotEmpty($schema['required']);
    }
}
