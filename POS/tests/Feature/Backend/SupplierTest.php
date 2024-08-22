<?php

namespace Tests\Feature\Backend;

use App\Models\Backend\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SupplierTest extends TestCase
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
     * Generates an array of supplier data using the Faker library.
     *
     * @return array The generated supplier data.
     */
    private function generateData(bool $withImage = true): array
    {
        $data = Supplier::factory()->make()->toArray();

        if ($withImage)
            $data['photo'] = UploadedFile::fake()->image('photo.jpg');
        else
            $data['photo'] = null;

        return $data;
    }

    /**
     * Asserts that the database contains an supplier record with the given data.
     *
     * @param array $data The supplier data to check for in the database.
     * @return void
     */
    private function assertDatabaseHasSupplier(array $data): void
    {

        $this->assertDatabaseHas('suppliers', [
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
     * Asserts that the database does not contain an supplier record with the given data.
     *
     * @param array $data The supplier data to check for in the database.
     * @return void
     */
    private function assertDatabaseMissingSupplier(array $data): void
    {
        $this->assertDatabaseMissing('suppliers', [
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
     * Test if the suppliers index page is displayed when the user is authenticated.
     */
    public function  test_supplier_index_is_displayed(): void
    {
        $this->actingAs($this->user)->get('/suppliers')
            ->assertStatus(200);
    }

    /**
     * Test if the suppliers index page redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function test_suppliers_index_redirect_when_not_authenticated(): void
    {
        $this->get('/suppliers')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /**
     * Test if the suppliers create page is displayed when the user is authenticated.
     *
     * @return void
     */
    public function test_suppliers_create_is_displayed(): void
    {
        // Act as the user and get the suppliers create page
        $this->actingAs($this->user)->get('/suppliers/create')
            ->assertStatus(200);
    }

    /**
     * Test if the supplier creation page redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function test_suppliers_create_redirect_when_not_authenticated(): void
    {
        $this->get('/suppliers/create')
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /**
     * Test if the supplier creation redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function test_suppliers_store_redirect_when_not_authenticated(): void
    {
        $data = $this->generateData();
        $response = $this->post('/suppliers', $data);
        $this->assertDatabaseMissing('suppliers', ['email' => $data['email'],]);

        $response->assertStatus(302)->assertRedirect('/login');
    }

    /**
     * Test if the suppliers store a supplier without an image.
     *
     * @return void
     */
    public function test_suppliers_store_without_image(): void
    {
        // Act as the user and Store supplier without image 
        $data = $this->generateData(false);
        $response = $this->actingAs($this->user)->post('/suppliers', $data);
        $this->assertDatabaseHasSupplier($data);

        $supplier = Supplier::where('email', $data['email'])->first();

        $this->assertNull($supplier->photo);
        $response->assertStatus(302)->assertRedirect('/suppliers');
    }

    /**
     * Test if the suppliers store an supplier with image.
     *
     * @return void
     */
    public function test_suppliers_store_with_image(): void
    {
        // Act as the user and Store supplier with image 
        $data = $this->generateData(true);
        $response = $this->actingAs($this->user)->post('/suppliers', $data);
        $this->assertDatabaseHasSupplier($data);

        // Fetch the supplier from the database
        $supplier = Supplier::where('email', $data['email'])->first();

        $this->assertNotNull($supplier->photo);
        // Assert that the 'photo' field starts with 'images/supplier-photos/'
        $this->assertStringStartsWith('images/supplier-photos/', $supplier->photo);
        $this->assertFileExists($supplier->photo);

        File::deleteDirectory('images');
        $response->assertStatus(302)->assertRedirect('/suppliers');
    }

    /**
     * Test if the suppliers edit page redirects to the login page when not authenticated.
     *
     * @return void
     */
    public function test_suppliers_edit_redirect_when_not_authenticated(): void
    {
        $data = $this->generateData(true);
        $supplier = Supplier::create($data);
        $this->get("/suppliers/{$supplier->id}/edit")
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    /**
     * Test if the suppliers edit page is displayed when the user is authenticated.
     *
     * @return void
     */
    public function test_suppliers_edit_is_displayed(): void
    {
        $data = $this->generateData(true);
        $supplier = Supplier::create($data);
        $this->actingAs($this->user)->get("/suppliers/{$supplier->id}/edit")
            ->assertStatus(200);
    }

    /**
     * Test if the suppliers update redirects when not authenticated.
     *
     * This test case checks if the update supplier request is redirected to the login page when the user is not authenticated.
     *
     * @return void
     */
    public function test_suppliers_update_redirect_when_not_authenticated(): void
    {
        // Act as the user with an image and create the supplier page
        $data = $this->generateData(false);
        $this->actingAs($this->user)->post("/suppliers", $data);
        $this->post('/logout');
        $this->assertDatabaseHasSupplier($data);

        // Get supplier from the database
        $supplier = Supplier::where('email', $data['email'])->first();

        $updatedData = $this->generateData(false);
        $response = $this->put("/suppliers/{$supplier->id}", $updatedData);

        $this->assertDatabaseMissingSupplier($updatedData);
        $response->assertStatus(302)->assertRedirect('/login');
    }


    /**
     * Test if the suppliers update an existing supplier without an image.
     *
     * This test case creates a supplier without an image, generates updated data,
     * asserts that the supplier's name and email match the expected values,
     * updates the supplier using the actingAs method to simulate an authenticated user,
     * asserts that the updated supplier's name and email are present in the database,
     * fetches the updated supplier from the database,
     * asserts that the updated supplier's photo is null,
     * asserts that the updated supplier's photo is null again (just to be sure),
     * and finally asserts that the response status is 302 and redirects to '/suppliers'.
     *
     * @return void
     */
    public function test_suppliers_update_without_image(): void
    {
        // Act as the user with an image and create the supplier page
        $data = $this->generateData(false);
        $this->actingAs($this->user)->post("/suppliers", $data);
        $this->assertDatabaseHasSupplier($data);

        // Get supplier from the database
        $supplier = Supplier::where('email', $data['email'])->first();


        $updatedData = $this->generateData(false);
        // Act as the user and get the supplier page
        $response = $this->actingAs($this->user)->put("/suppliers/{$supplier->id}", $updatedData);
        $this->assertDatabaseHasSupplier($updatedData);

        // Fetch the updated supplier from the database
        $updatedsupplier = Supplier::where('email', $updatedData['email'])->first();

        $this->assertNull($updatedsupplier->photo);
        $response->assertStatus(302)->assertRedirect('/suppliers');
    }
    /**
     * Test if the suppliers update an existing supplier with an image.
     *
     * @return void
     */
    public function test_suppliers_update_supplier_with_image(): void
    {
        // Act as the user with an image and create the supplier page
        $data = $this->generateData(true);
        $this->actingAs($this->user)->post("/suppliers", $data);
        $this->assertDatabaseHasSupplier($data);

        // Get supplier from the database
        $supplier = Supplier::where('email', $data['email'])->first();

        $updatedData = $this->generateData(true);
        $response = $this->actingAs($this->user)
            ->put("/suppliers/{$supplier->id}", $updatedData);
        $this->assertDatabaseHasSupplier($updatedData);

        $updatedsupplier = Supplier::where('email', $updatedData['email'])->first();

        $this->assertNotNull($updatedsupplier->photo);
        $this->assertStringStartsWith('images/supplier-photos/', $updatedsupplier->photo);
        $this->assertFileExists($updatedsupplier->photo);
        $this->assertFileExists('recycle bin/images/supplier-photos/');

        File::deleteDirectory('images');
        File::deleteDirectory('recycle bin');
        $response->assertStatus(302)->assertRedirect('/suppliers');
    }

    /**
     * Test if the suppliers destroy request is successful.
     *
     * This test case checks if the delete supplier request is redirected to the suppliers page and the supplier is removed from the database.
     *
     * @return void
     */
    public function test_suppliers_destroy(): void
    {
        // Act as the user with an image and create the supplier page
        $data = $this->generateData(false);
        $this->actingAs($this->user)->post("/suppliers", $data);

        // Get supplier from the database
        $supplier = Supplier::where('email', $data['email'])->first();

        $response = $this->actingAs($this->user)->delete("/suppliers/{$supplier->id}");
        $this->assertDatabaseMissing('suppliers', ['id' => $supplier->id]);

        File::deleteDirectory('images');
        File::deleteDirectory('recycle bin');
        $response->assertStatus(302)->assertRedirect('/suppliers');
    }
}
