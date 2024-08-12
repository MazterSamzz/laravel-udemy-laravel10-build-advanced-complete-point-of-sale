<?php

namespace Tests\Feature\Backend;

use App\Models\Backend\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the employee page is displayed when the user is authenticated.
     *
     * @return void
     */
    public function test_employee_page_is_displayed(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/employees');  // Act as the user and get the employee page
        $response->assertStatus(200);
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
     * Test if the employees create page is displayed when the user is authenticated.
     *
     * @return void
     */
    public function test_create_is_displayed(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/employees/create');  // Act as the user and get the employees create page
        $response->assertStatus(200);
    }

    /**
     * Test if the employee creation page redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function test_create_redirect_when_not_authenticated(): void
    {
        $response = $this->get('/employees/create');
        $response->assertStatus(302)->assertRedirect('/login');
    }

    /**
     * Test if the employees store an employee with image.
     *
     * @return void
     */
    public function test_employees_store_John_Doe_employee_with_image(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        // Simulate the file upload
        $file = UploadedFile::fake()->image('photo.jpg');

        // Act as the user and get the employee page
        $response = $this->actingAs($user)->post('/employees', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '0812345678999',
            'address' => 'Jl. Jalan Jalan No. 123',
            'experience' => '1',
            'salary' => '5000000',
            'leave' => '10.5',
            'city' => 'Jakarta',
            'photo' => $file,
        ]);

        $this->assertDatabaseHas('employees', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '0812345678999',
            'address' => 'Jl. Jalan Jalan No. 123',
            'experience' => '1',
            'salary' => '5000000',
            'leave' => '10.5',
            'city' => 'Jakarta',
        ]);

        // Fetch the employee from the database
        $employee = Employee::where('email', 'johndoe@example.com')->first();

        // Assert that the 'photo' field is not null and starts with 'images/profile-photos/'
        $this->assertNotNull($employee->photo);
        $this->assertStringStartsWith('images/employee-photos/', $employee->photo);

        $this->assertFileExists($employee->photo);

        File::deleteDirectory('images');
        // Optionally, you can assert that the response is a redirect or any specific response
        $response->assertStatus(302)->assertRedirect('/employees');
        $this->actingAs($user)->post('/logout');
    }

    /**
     * Test if the employee creation redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function test_store_redirect_when_not_authenticated(): void
    {
        // Act as the user and get the employee page
        $response = $this->post('/employees', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '0812345678999',
            'address' => 'Jl. Jalan Jalan No. 123',
            'experience' => '1',
            'salary' => '5000000',
            'leave' => '10.5',
            'city' => 'Jakarta',
            'photo' => UploadedFile::fake()->image('photo.jpg'),
        ]);

        $this->assertDatabaseMissing('employees', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '0812345678999',
            'address' => 'Jl. Jalan Jalan No. 123',
            'experience' => '1',
            'salary' => '5000000',
            'leave' => '10.5',
            'city' => 'Jakarta',
        ]);

        // Fetch the employee from the database
        $employee = Employee::where('email', 'johndoe@example.com')->first();

        // Assert that the 'photo' field is not null and starts with 'images/profile-photos/'
        $this->assertNull($employee);

        // Optionally, you can assert that the response is a redirect or any specific response
        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_edit_is_displayed(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->test_employees_store_John_Doe_employee_with_image();
        $employee = Employee::where('name', 'John Doe')->first();

        $response = $this->actingAs($user)->get("/employees/$employee->id/edit");  // Act as the user and get the employees create page
        $response->assertStatus(200);
    }

    public function test_employees_edit_redirect_when_not_authenticated(): void
    {
        $this->test_employees_store_John_Doe_employee_with_image();

        $employee = Employee::where('name', 'John Doe')->first();

        $response = $this->get("/employees/$employee->id/edit");
        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_employees_update_an_employee_with_image(): void
    {
        /** @var User $user */
        $user = User::factory()->create();
        $this->test_employees_store_John_Doe_employee_with_image();
        $employee = Employee::where('name', 'John Doe')->first();

        $this->assertEquals($employee->name, 'John Doe');
        $this->assertEquals($employee->email, 'johndoe@example.com');

        // Act as the user and get the employee page
        $response = $this->actingAs($user)->put("/employees/$employee->id", [
            'name' => 'Johnny Yes Papa',
            'email' => 'johnnyyespapa@example.com',
            'phone' => '0812345678998',
            'address' => 'Jl. Jalan Jalan No. 124',
            'experience' => '2',
            'salary' => '7000000',
            'leave' => '11.5',
            'city' => 'Bandung',
            'photo' => UploadedFile::fake()->image('photo.jpg'),
        ]);

        $this->assertDatabaseHas('employees', [
            'name' => 'Johnny Yes Papa',
            'email' => 'johnnyyespapa@example.com',
            'phone' => '0812345678998',
            'address' => 'Jl. Jalan Jalan No. 124',
            'experience' => '2',
            'salary' => '7000000',
            'leave' => '11.5',
            'city' => 'Bandung',
        ]);

        // Fetch the employee from the database
        $employee = Employee::where('email', 'johnnyyespapa@example.com')->first();

        // Assert that the 'photo' field is not null and starts with 'images/profile-photos/'
        $this->assertNotNull($employee->photo);
        $this->assertStringStartsWith('images/employee-photos/', $employee->photo);

        $this->assertFileExists($employee->photo);
        File::deleteDirectory('images');

        $response->assertStatus(302)->assertRedirect('/employees');
    }

    public function test_update_redirect_when_not_authenticated(): void
    {
        $this->test_employees_store_John_Doe_employee_with_image();
        $employee = Employee::where('name', 'John Doe')->first();

        $this->assertEquals($employee->name, 'John Doe');
        $this->assertEquals($employee->email, 'johndoe@example.com');

        // Act as the user and get the employee page
        $response = $this->put("/employees/$employee->id", [
            'name' => 'Johnny Yes Papa',
            'email' => 'johnnyyespapa@example.com',
            'phone' => '0812345678998',
            'address' => 'Jl. Jalan Jalan No. 124',
            'experience' => '2',
            'salary' => '7000000',
            'leave' => '11.5',
            'city' => 'Bandung',
            'photo' => UploadedFile::fake()->image('photo.jpg'),
        ]);

        $this->assertDatabaseHas('employees', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '0812345678999',
            'address' => 'Jl. Jalan Jalan No. 123',
            'experience' => '1',
            'salary' => '5000000',
            'leave' => '10.5',
            'city' => 'Jakarta',
        ]);

        // Fetch the employee from the database
        $employee = Employee::where('email', 'johnnyyespapa@example.com')->first();
        $this->assertNull($employee);

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_employees_destroy_an_employee(): void
    {
        $this->test_employees_store_John_Doe_employee_with_image();
        $employee = Employee::where('name', 'John Doe')->first();
        $this->assertEquals($employee->name, 'John Doe');
        $this->assertEquals($employee->email, 'johndoe@example.com');
        $this->assertNotNull($employee->photo);

        /** @var User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete("/employees/$employee->id");
        $response->assertStatus(302)->assertRedirect('/employees');
    }
}
