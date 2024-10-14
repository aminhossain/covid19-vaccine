<?php

use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    $this->artisan('migrate:fresh --seed');
});

test('user can register for vaccination', function () {
    $center = VaccineCenter::first();
    
    $response = $this->post('/api/register', [
        'nid' => '1234567899',
        'name' => 'John Doe',
        'vaccine_center_id' => $center->id,
        'email' => 'john@example.com',
        'date' => '2024-10-25',  // example date in mm-dd-yyyy format
    ]);

    $response->assertStatus(201); // Successfully created
    $this->assertDatabaseHas('users', [
        'nid' => '1234567899',
        'name' => 'John Doe',
    ]);

    $this->assertDatabaseHas('vaccinations', [
        'user_id' => 1,
        'vaccine_center_id' => $center->id,
    ]);
});

test('user cannot register twice', function () {
    $center = VaccineCenter::first();

    // First registration
    $this->post('/api/register', [
        'nid' => '1234567898',
        'name' => 'John Doee',
        'vaccine_center_id' => $center->id,
        'email' => 'johnny@example.com',
        'date' => '2024-10-25',
    ]);

    // Second registration
    $response = $this->post('/api/register', [
        'nid' => '1234567898',
        'name' => 'John Doee',
        'vaccine_center_id' => $center->id,
        'email' => 'johnny@example.com',
        'date' => '2024-10-25',
    ]);

    $response->assertStatus(302); // Validation error
});
