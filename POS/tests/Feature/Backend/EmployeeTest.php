<?php

namespace Tests\Feature\Backend;

use App\Models\Backend\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    /**
     * Sets up the test case by calling the parent setUp method and creating a new user.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * Generates an array of employee data using the Faker library.
     *
     * @return array The generated employee data.
     */
    private function generateData(bool $withImage = true): array
    {
        $data = Employee::factory()->make()->toArray();

        if ($withImage)
            $data['photo'] = UploadedFile::fake()->image('photo.jpg');
        else
            $data['photo'] = null;

        return $data;
    }

    /**
     * Asserts that the database contains an employee record with the given data.
     *
     * @param array $data The employee data to check for in the database.
     * @return void
     */
    private function assertDatabaseHasEmployee(array $data): void
    {

        $this->assertDatabaseHas('employees', [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'experience' => $data['experience'],
            'salary' => $data['salary'],
            'leave' => $data['leave'],
            'city' => $data['city'],
        ]);
    }

    /**
     * Asserts that the database does not contain an employee record with the given data.
     *
     * @param array $data The employee data to check for in the database.
     * @return void
     */
    private function assertDatabaseMissingEmployee(array $data): void
    {
        $this->assertDatabaseMissing('employees', [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'experience' => $data['experience'],
            'salary' => $data['salary'],
            'leave' => $data['leave'],
            'city' => $data['city'],
        ]);
    }

    /**
     * Test if the employees page redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function test_employees_index_redirect_when_not_authenticated(): void
    {
        $response = $this->get('/employees');
        $response->assertStatus(302)->assertRedirect('/login');
    }

    /**
     * Test if the employee page is displayed when the user is authenticated.
     *
     * @return void
     */
    public function test_employee_index_is_displayed(): void
    {
        $response = $this->actingAs($this->user)->get('/employees');  // Act as the user and get the employee page
        $response->assertStatus(200);
    }

    /**
     * Test if the employee creation page redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function test_employees_create_redirect_when_not_authenticated(): void
    {
        $response = $this->get('/employees/create');
        $response->assertStatus(302)->assertRedirect('/login');
    }

    /**
     * Test if the employees create page is displayed when the user is authenticated.
     *
     * @return void
     */
    public function test_employees_create_is_displayed(): void
    {
        $response = $this->actingAs($this->user)->get('/employees/create');
        $response->assertStatus(200);
    }

    /**
     * Test if the employee creation redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function test_store_redirect_when_not_authenticated(): void
    {
        // Store data without authenticating
        $data = $this->generateData(true);
        $response = $this->post('/employees', $data);
        $this->assertDatabaseMissingEmployee($data);

        // Fetch the employee from the database
        $employee = Employee::where('email', $data['email'])->first();

        // Assert that the 'photo' field is null
        $this->assertNull($employee);
        $response->assertStatus(302)->assertRedirect('/login');
    }

    /**
     * Test if the employees store an employee without image.
     *
     * @return void
     */
    public function test_employees_store_without_image(): void
    {
        // Act as the user and store employee
        $data = $this->generateData(false);
        $response = $this->actingAs($this->user)->post('/employees', $data);
        $this->assertDatabaseHasEmployee($data);

        // Fetch the employee from the database
        $employee = Employee::where('email', $data['email'])->first();

        // Assert that the 'photo' field is null
        $this->assertNull($employee->photo);
        $response->assertStatus(302)->assertRedirect('/employees');
    }

    /**
     * Test if the employees store an employee with image.
     *
     * @return void
     */
    public function test_employees_store_with_image(): void
    {
        // Act as the user and store employee
        $data = $this->generateData(true);
        $response = $this->actingAs($this->user)->post('/employees', $data);
        $this->assertDatabaseHasEmployee($data);

        // Fetch the employee from the database
        $employee = Employee::where('email', $data['email'])->first();

        // Assert that the 'photo' field is not null and starts with 'images/profile-photos/'
        $this->assertNotNull($employee->photo);
        $this->assertStringStartsWith('images/employee-photos/', $employee->photo);
        $this->assertFileExists($employee->photo);

        File::deleteDirectory('images');
        $response->assertStatus(302)->assertRedirect('/employees');
    }

    public function test_employees_edit_redirect_when_not_authenticated(): void
    {
        // Act as the user and store employee
        $data = $this->generateData(false);
        $this->actingAs($this->user)->post('/employees', $data);
        $this->post('/logout');
        $this->assertDatabaseHasEmployee($data);

        $employee = Employee::where('name', $data['name'])->first();

        $response = $this->get("/employees/$employee->id/edit");
        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_edit_is_displayed(): void
    {
        // Act as the user and store employee
        $data = $this->generateData(true);
        $response = $this->actingAs($this->user)->post('/employees', $data);
        $this->assertDatabaseHasEmployee($data);

        $employee = Employee::where('name', $data['name'])->first();

        // Act as the user and get the employees edit page
        $response = $this->actingAs($this->user)->get("/employees/$employee->id/edit");
        $response->assertStatus(200);
    }

    public function test_update_redirect_when_not_authenticated(): void
    {
        // Act as the user and store employee
        $data = $this->generateData(true);
        $this->actingAs($this->user)->post('/employees', $data);
        $this->post('/logout');

        $this->assertDatabaseHasEmployee($data);

        $employee = Employee::where('name', $data['name'])->first();

        // Update Employee without authentication
        $updatedData = $this->generateData(true);
        $response = $this->put("/employees/{$employee->id}", $updatedData);
        $this->assertDatabaseMissingEmployee($updatedData);

        // Fetch the employee from the database
        $updatedEmployee = Employee::where('email', $updatedData['email'])->first();
        $this->assertNull($updatedEmployee);

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_employees_update_employee_without_image(): void
    {
        // Act as the user and store employee
        $data = $this->generateData(false);
        $this->actingAs($this->user)->post('/employees', $data);
        $this->assertDatabaseHasEmployee($data);

        $employee = Employee::where('name', $data['name'])->first();

        // Act as the user and get the updated employee
        $updatedData = $this->generateData(false);
        $response = $this->actingAs($this->user)->put("/employees/{$employee->id}", $updatedData);
        $this->assertDatabaseHasEmployee($updatedData);

        // Fetch the employee from the database
        $employee = Employee::where('email', $updatedData['email'])->first();

        // Assert that the 'photo' field is null
        $this->assertNull($employee->photo);
        $response->assertStatus(302)->assertRedirect('/employees');
    }

    public function test_employees_update_an_employee_with_image(): void
    {
        // Act as the user and store employee
        $data = $this->generateData(true);
        $this->actingAs($this->user)->post('/employees', $data);
        $this->assertDatabaseHasEmployee($data);

        $employee = Employee::where('name', $data['name'])->first();

        // Act as the user and get the updated employee
        $updatedData = $this->generateData(true);
        $response = $this->actingAs($this->user)->put("/employees/{$employee->id}", $updatedData);
        $this->assertDatabaseHasEmployee($updatedData);

        // Fetch the employee from the database
        $employee = Employee::where('email', $updatedData['email'])->first();

        // Assert that the 'photo' field is not null and starts with 'images/employee-photos/'
        $this->assertNotNull($employee->photo);
        $this->assertStringStartsWith('images/employee-photos/', $employee->photo);
        $this->assertFileExists($employee->photo);
        $this->assertFileExists('recycle bin/images/employee-photos/');

        File::deleteDirectory('images');
        File::deleteDirectory('recycle bin');

        $response->assertStatus(302)->assertRedirect('/employees');
    }


    public function test_employees_destroy_an_employee(): void
    {
        // Act as the user and store employee
        $data = $this->generateData(true);
        $this->actingAs($this->user)->post('/employees', $data);
        $this->assertDatabaseHasEmployee($data);

        $employee = Employee::where('name', $data['name'])->first();
        $response = $this->actingAs($this->user)->delete("/employees/{$employee->id}");
        $this->assertDatabaseMissingEmployee($data);

        File::deleteDirectory('images');
        File::deleteDirectory('recycle bin');
        $response->assertStatus(302)->assertRedirect('/employees');
    }
}
