<?php

use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Foundation\Testing\RefreshDatabase;

beforeEach(function () {
    $this->artisan('migrate:fresh --seed');
});

test('can search for registered user status', function () {
    $center = VaccineCenter::first();
    
    $response = $this->post('/api/register', [
        'nid' => '1234567899',
        'name' => 'John Doe',
        'vaccine_center_id' => $center->id,
        'email' => 'john@example.com',
        'date' => '2024-10-25',  // example date in mm-dd-yyyy format
    ]);

    $response = $this->get('/api/search?nid=1234567899');

    $response->assertStatus(200);
    $response->assertJsonFragment([
        'status' => 'Scheduled',
    ]);
});

test('returns not registered status if user is not found', function () {
    $response = $this->get('/api/search?nid=987654321');

    $response->assertStatus(200);
    $response->assertJsonFragment([
        'status' => 'Not registered',
    ]);
});
