<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\PhoneBook;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhoneBookTest extends TestCase
{
    use RefreshDatabase;

    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * Get records tests
     */
    public function testIndex(): void
    {
        $phone_book = factory(PhoneBook::class)->create();

        $response = $this->json('GET', route('phone-book.get', [], false), ['id' => 'string']);
        $response->assertStatus(422);
        $response->assertExactJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'id' => [
                    'The id must be an integer.'
                ]
            ]
        ]);

        $response = $this->json('GET', route('phone-book.get', [], false), [
            'id' => $phone_book->id,
            'name' => $phone_book->name,
            'second_name' => $phone_book->second_name
        ]);
        $response->assertStatus(200);
        $response->assertExactJson([
            [
                'id' => $phone_book->id,
                'name' => $phone_book->name,
                'second_name' => $phone_book->second_name,
                'phone_number' => $phone_book->phone_number,
                'country_code' => $phone_book->country_code,
                'timezone_code' => $phone_book->timezone_code
            ]
        ]);
    }

    /**
     * Test create record
     */
    public function testStore(): void
    {        $response = $this->json('POST', route('phone-book.store', [], false), [
            'country_code'  => 'wrong',
            'timezone_code' => 'wrong',
            'phone_number'  => 'wrong'
        ]);
        $response->assertStatus(422);
        $response->assertExactJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'phone_number' => [
                    'The phone number format is invalid.'
                ],
                'country_code' => [
                    'The country code not found. Check this'
                ],
                'timezone_code' => [
                    'The timezone code not found. Check this'
                ]
            ]
        ]);

        $response = $this->json('POST', route('phone-book.store', [], false), [
            'name'          => 'name',
            'second_name'   => 'second_name',
            'country_code'  => 'AD',
            'timezone_code' => 'Asia/Aden',
            'phone_number'  => '+11111111111123'
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('phone_book', [
            'name'          => 'name',
            'second_name'   => 'second_name',
            'country_code'  => 'AD',
            'timezone_code' => 'Asia/Aden',
            'phone_number'  => '+11111111111123'
        ]);
    }

    /**
     * Test update record
     */
    public function testUpdate(): void
    {
        $phone_book = factory(PhoneBook::class)->create();
        $response = $this->json('PUT', route('phone-book.update', ['id' => 'wrong'], false));
        $response->assertStatus(422);
        $response->assertExactJson(['message' => 'Parameter id must be integer']);

        $response = $this->json('PUT', route('phone-book.update', ['id' => 666], false));
        $response->assertStatus(404);
        $response->assertExactJson(['message' => 'Record with number 666 not found']);

        $response = $this->json('PUT', route('phone-book.update', ['id' => $phone_book->id], false), [
            'name' => 'updated_name'
        ]);
        $response->assertOk();
        $response->assertExactJson([sprintf('Record with number %d updated', $phone_book->id)]);
        $this->assertDatabaseHas('phone_book', [
            'id' => $phone_book->id,
            'name' => 'updated_name'
        ]);
    }
}
