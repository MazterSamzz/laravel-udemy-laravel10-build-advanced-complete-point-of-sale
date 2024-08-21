<?php

namespace Tests\Feature\Backend;

use App\Models\Backend\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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
     * Generates an array of customer data using the Faker library.
     *
     * @return array The generated customer data.
     */
    private function generateData(bool $withImage = true): array
    {
        $data = Customer::factory()->make()->toArray();

        if ($withImage)
            $data['photo'] = UploadedFile::fake()->image('photo.jpg');
        else
            $data['photo'] = null;

        return $data;
    }

    /**
     * Asserts that the database contains an customer record with the given data.
     *
     * @param array $data The customer data to check for in the database.
     * @return void
     */
    private function assertDatabaseHasCustomer(array $data): void
    {

        $this->assertDatabaseHas('customers', [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'shopname' => $data['shopname'],
            'account_holder' => $data['account_holder'],
            'account_number' => $data['account_number'],
            'bank_name' => $data['bank_name'],
            'bank_branch' => $data['bank_branch'],
            'city' => $data['city'],
        ]);
    }

    /**
     * Asserts that the database does not contain an customer record with the given data.
     *
     * @param array $data The customer data to check for in the database.
     * @return void
     */
    private function assertDatabaseMissingCustomer(array $data): void
    {
        $this->assertDatabaseMissing('customers', [
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'shopname' => $data['shopname'],
            'account_holder' => $data['account_holder'],
            'account_number' => $data['account_number'],
            'bank_name' => $data['bank_name'],
            'bank_branch' => $data['bank_branch'],
            'city' => $data['city'],
        ]);
    }

    /**
     * Test if the customers index page is displayed when the user is authenticated.
     */
    public function  test_customer_index_is_displayed(): void
    {
        $this->actingAs($this->user)->get('/customers')
            ->assertStatus(200);
    }

    /**
     * Test if the customers index page redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function test_customers_index_redirect_when_not_authenticated(): void
    {
        $this->get('/customers')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /**
     * Test if the customers create page is displayed when the user is authenticated.
     *
     * @return void
     */
    public function test_customers_create_is_displayed(): void
    {
        // Act as the user and get the customers create page
        $this->actingAs($this->user)->get('/customers/create')
            ->assertStatus(200);
    }

    /**
     * Test if the customer creation page redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function test_customers_create_redirect_when_not_authenticated(): void
    {
        $this->get('/customers/create')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /**
     * Test if the customer creation redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function test_customers_store_redirect_when_not_authenticated(): void
    {
        $data = $this->generateData();
        $response = $this->post('/customers', $data);
        $this->assertDatabaseMissing('customers', ['email' => $data['email'],]);

        $response->assertStatus(302)->assertRedirect('/login');
    }

    /**
     * Test if the customers store a customer without an image.
     *
     * @return void
     */
    public function test_customers_store_without_image(): void
    {
        // Act as the user and Store Customer without image 
        $data = $this->generateData(false);
        $response = $this->actingAs($this->user)->post('/customers', $data);
        $this->assertDatabaseHasCustomer($data);

        $customer = Customer::where('email', $data['email'])->first();

        $this->assertNull($customer->photo);
        $response->assertStatus(302)->assertRedirect('/customers');
    }

    /**
     * Test if the customers store an customer with image.
     *
     * @return void
     */
    public function test_customers_store_with_image(): void
    {
        // Act as the user and Store Customer with image 
        $data = $this->generateData(true);
        $response = $this->actingAs($this->user)->post('/customers', $data);
        $this->assertDatabaseHasCustomer($data);

        // Fetch the customer from the database
        $customer = Customer::where('email', $data['email'])->first();

        $this->assertNotNull($customer->photo);
        // Assert that the 'photo' field starts with 'images/customer-photos/'
        $this->assertStringStartsWith('images/customer-photos/', $customer->photo);
        $this->assertFileExists($customer->photo);

        File::deleteDirectory('images');
        $response->assertStatus(302)->assertRedirect('/customers');
    }

    /**
     * Test if the customers edit page redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function test_customers_edit_redirect_when_not_authenticated(): void
    {
        $data = $this->generateData(true);
        $customer = Customer::create($data);
        $this->get("/customers/{$customer->id}/edit")
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /**
     * Test if the customers edit page is displayed when the user is authenticated.
     *
     * @return void
     */
    public function test_customers_edit_is_displayed(): void
    {
        $data = $this->generateData(true);
        $customer = Customer::create($data);
        $this->actingAs($this->user)->get("/customers/{$customer->id}/edit")
            ->assertStatus(200);
    }

    /**
     * Test if the customers update redirects when not authenticated.
     *
     * This test case checks if the update customer request is redirected to the login page when the user is not authenticated.
     *
     * @return void
     */
    public function test_customers_update_redirect_when_not_authenticated(): void
    {
        // Act as the user with an image and create the customer page
        $data = $this->generateData(false);
        $this->actingAs($this->user)->post("/customers", $data);
        $this->post('/logout');
        $this->assertDatabaseHasCustomer($data);

        // Get Customer from the database
        $customer = Customer::where('email', $data['email'])->first();

        $updatedData = $this->generateData(false);
        $response = $this->put("/customers/{$customer->id}", $updatedData);

        $this->assertDatabaseMissingCustomer($updatedData);
        $response->assertStatus(302)->assertRedirect('/login');
    }


    /**
     * Test if the customers update an existing customer without an image.
     *
     * This test case creates a customer without an image, generates updated data,
     * asserts that the customer's name and email match the expected values,
     * updates the customer using the actingAs method to simulate an authenticated user,
     * asserts that the updated customer's name and email are present in the database,
     * fetches the updated customer from the database,
     * asserts that the updated customer's photo is null,
     * asserts that the updated customer's photo is null again (just to be sure),
     * and finally asserts that the response status is 302 and redirects to '/customers'.
     *
     * @return void
     */
    public function test_customers_update_without_image(): void
    {
        // Act as the user with an image and create the customer page
        $data = $this->generateData(false);
        $this->actingAs($this->user)->post("/customers", $data);
        $this->assertDatabaseHasCustomer($data);

        // Get Customer from the database
        $customer = Customer::where('email', $data['email'])->first();


        $updatedData = $this->generateData(false);
        // Act as the user and get the customer page
        $response = $this->actingAs($this->user)->put("/customers/{$customer->id}", $updatedData);
        $this->assertDatabaseHasCustomer($updatedData);

        // Fetch the updated customer from the database
        $updatedCustomer = Customer::where('email', $updatedData['email'])->first();

        $this->assertNull($updatedCustomer->photo);
        $response->assertStatus(302)->assertRedirect('/customers');
    }
    /**
     * Test if the customers update an existing customer with an image.
     *
     * @return void
     */
    public function test_customers_update_customer_with_image(): void
    {
        // Act as the user with an image and create the customer page
        $data = $this->generateData(true);
        $this->actingAs($this->user)->post("/customers", $data);
        $this->assertDatabaseHasCustomer($data);

        // Get Customer from the database
        $customer = Customer::where('email', $data['email'])->first();

        $updatedData = $this->generateData(true);
        $response = $this->actingAs($this->user)
            ->put("/customers/{$customer->id}", $updatedData);
        $this->assertDatabaseHasCustomer($updatedData);

        $updatedCustomer = Customer::where('email', $updatedData['email'])->first();

        $this->assertNotNull($updatedCustomer->photo);
        $this->assertStringStartsWith('images/customer-photos/', $updatedCustomer->photo);
        $this->assertFileExists($updatedCustomer->photo);
        $this->assertFileExists('recycle bin/images/customer-photos/');

        File::deleteDirectory('images');
        File::deleteDirectory('recycle bin');
        $response->assertStatus(302)->assertRedirect('/customers');
    }

    /**
     * Test if the customers destroy request is successful.
     *
     * This test case checks if the delete customer request is redirected to the customers page and the customer is removed from the database.
     *
     * @return void
     */
    public function test_customers_destroy(): void
    {
        // Act as the user with an image and create the customer page
        $data = $this->generateData(false);
        $this->actingAs($this->user)->post("/customers", $data);

        // Get Customer from the database
        $customer = Customer::where('email', $data['email'])->first();

        $response = $this->actingAs($this->user)->delete("/customers/{$customer->id}");
        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);

        File::deleteDirectory('images');
        File::deleteDirectory('recycle bin');
        $response->assertStatus(302)->assertRedirect('/customers');
    }
}
