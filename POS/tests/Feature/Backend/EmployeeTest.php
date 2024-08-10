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

    public function test_create_an_employee_with_image()
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
        $response->assertStatus(302);
        $response->assertRedirect('/employees');
    }

    public function test_guest_create_an_employee_with_image()
    {

        // Simulate the file upload
        $file = UploadedFile::fake()->image('photo.jpg');

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
            'photo' => $file,
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
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
