<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\VaccineCenter;

beforeEach(function () {
    // Refresh the database before each test
    $this->artisan('migrate:fresh --seed');
});

test('can fetch vaccine centers', function () {
    $response = $this->get('/api/vaccine-centers');

    $response->assertStatus(200);
    $response->assertJsonCount(15); // Assuming you've seeded 10 centers
});
