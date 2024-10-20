<?php

use Illuminate\Support\Facades\Cache;

beforeEach(function () {
    // Directly set the cache value for companyInfo
    Cache::put('companyInfo', (object)['name' => 'Test Company'], 60);
});

it('can access the homepage', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('can access the login page', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

it('can access the dashboard page', function () {
    $response = $this->get('/admin/dashboard');

    $response->assertStatus(200);
});
