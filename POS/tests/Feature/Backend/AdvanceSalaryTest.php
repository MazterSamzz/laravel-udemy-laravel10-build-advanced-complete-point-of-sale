<?php

namespace Tests\Feature\Backend;

use App\Models\Backend\AdvanceSalary;
use App\Models\Backend\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdvanceSalaryTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Employee $employee;

    /**
     * Sets up the test case by calling the parent setUp method and creating a new user.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->employee = Employee::factory()->create();
    }

    /**
     * Test if the advance salaries index page is displayed when the user is authenticated.
     *
     * This test case checks if the advance salaries index page redirects to the login page when not authenticated.
     * It then simulates an authenticated user and asserts that the page is displayed successfully.
     *
     * @return void
     */
    public function test_advance_salaries_index_accessibility(): void
    {
        // Test if the advance salaries index page redirects to the login page when not authenticated.
        $this->get('/advance-salaries')
            ->assertStatus(302)
            ->assertRedirect('/login');

        // Test if the advance salaries page is displayed when the user is authenticated.
        $this->actingAs($this->user)
            ->get('/advance-salaries')
            ->assertStatus(200);
    }

    /**
     * Test if the advance salaries create page is accessible.
     *
     * This test case checks if the advance salaries create page redirects to the login page when not authenticated.
     * It then simulates an authenticated user and asserts that the page is displayed successfully.
     *
     * @return void
     */
    public function test_advance_salaries_create_accessibility(): void
    {
        // Test if the advance salaries create page redirects to the login page when not authenticated.
        $this->get('/advance-salaries/create')
            ->assertStatus(302)
            ->assertRedirect('/login');

        // Test if the advance salaries create page is displayed when the user is authenticated.
        $this->actingAs($this->user)->get('/advance-salaries/create')
            ->assertStatus(200);
    }


    /**
     * Test if the advance salaries store an advance salary
     *
     * @return void
     */
    public function test_advance_salaries_store_accessibility(): void
    {
        $data = AdvanceSalary::factory()->make()->toArray();

        // Test if the advance salaries store redirect to the login page when not authenticated.
        $response = $this->post('/advance-salaries', $data);
        $response->assertStatus(302)->assertRedirect('/login');
        $this->assertDatabaseMissing('advance_salaries', $data);

        // Test if the advance salaries store success when the user is authenticated.
        $response = $this->actingAs($this->user)->post('/advance-salaries', $data);
        $response->assertStatus(302)->assertRedirect('/advance-salaries');
        $this->assertDatabaseHas('advance_salaries', $data);
    }

    /**
     * Test if the advance salaries edit page redirects to the login page when not authenticated
     * and is displayed when the user is authenticated.
     *
     * @return void
     */
    public function test_advance_salaries_edit_accessibility(): void
    {
        $advanceSalary = AdvanceSalary::factory()->create();

        // Test if the advance salaries edit page redirects to the login page when not authenticated.
        $this->get("/advance-salaries/{$advanceSalary->id}/edit")
            ->assertStatus(302)
            ->assertRedirect('/login');

        // Test if the advance salaries edit page is displayed when the user is authenticated.
        $advanceSalary = AdvanceSalary::factory()->create();
        $this->actingAs($this->user)->get("/advance-salaries/{$advanceSalary->id}/edit")
            ->assertStatus(200);
    }

    /**
     * Test if the advance salaries update accessibility when not authenticated and when the user is authenticated.
     *
     * @return void
     */
    public function test_advance_salaries_update_accessibility(): void
    {
        // Create the advance salaries
        $advanceSalary = AdvanceSalary::factory()->create();
        $this->assertDatabaseHas('advance_salaries', $advanceSalary->toArray());
        $updatedData = AdvanceSalary::factory()->make()->toArray();

        // Update the advance salary without authentication
        $response = $this->put("/advance-salaries/{$advanceSalary->id}", $updatedData);
        $this->assertDatabaseMissing('advance_salaries', $updatedData);
        $response->assertStatus(302)->assertRedirect('/login');

        // Act as the user and update the advance salary
        $response = $this->actingAs($this->user)->put("/advance-salaries/{$advanceSalary->id}", $updatedData);
        $this->assertDatabaseHas('advance_salaries', $updatedData);
        $response->assertStatus(302)->assertRedirect('/advance-salaries');
    }

    /**
     * Test the accessibility of destroying advance salaries when not authenticated and when the user is authenticated.
     *
     * @return void
     */
    public function test_advance_salaries_destroy_accessibility(): void
    {
        // Create the advance salaries
        $advanceSalary = AdvanceSalary::factory()->create();
        $this->assertDatabaseHas('advance_salaries', $advanceSalary->toArray());

        // Delete the advance salary without authentication
        $response = $this->delete("/advance-salaries/{$advanceSalary->id}");
        $this->assertDatabaseHas('advance_salaries', ['id' => $advanceSalary->id]);
        $response->assertStatus(302)->assertRedirect('/login');

        // Act as the user and delete the advance salary
        $response = $this->actingAs($this->user)->delete("/advance-salaries/{$advanceSalary->id}");
        $this->assertDatabaseMissing('advance_salaries', ['id' => $advanceSalary->id]);
        $response->assertStatus(302)->assertRedirect('/advance-salaries');
    }
}
