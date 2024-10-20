<?php

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
