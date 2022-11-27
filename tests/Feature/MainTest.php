<?php

namespace Tests\Feature;

use Tests\TestCase;

class MainTest extends TestCase
{
    /**
     * A basic test.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A calculation test.
     *
     * @return void
     */
    public function test_calculate_product_quantity()
    {
        $response = $this->post(route('calculate'), [
            'quantity' => 4,
        ]);

        $response->assertStatus(200);
    }

    /**
     * Simple validation test.
     *
     * @return void
     */
    public function test_validation_calculate_product_quantity()
    {
        $response = $this->post(route('calculate'), [
            'quantity' => 'test',
        ]);

        $response->assertStatus(302);
    }
}
