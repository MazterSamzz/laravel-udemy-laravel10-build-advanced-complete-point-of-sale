<?php

namespace Tests\Feature\Backend;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * Test if the employee page is displayed when the user is authenticated.
     *
     * @return void
     */
    public function test_employee_page_is_displayed(): void
    {
        // Create a user
        /** @var User $user */
        $user = User::factory()->create();
        // Act as the user and get the employee page
        $response = $this->actingAs($user)->get('/employees');
        // Assert that the response status is 200
        $response->assertStatus(200);
    }
    public function test_employees_redirect_when_not_authenticated(): void
    {
        // Act as the user and get the employee page
        $response = $this->get('/employees');
        // Assert that the response status is 200
        $response->assertRedirect('/login');
    }
}
