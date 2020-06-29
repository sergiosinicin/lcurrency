<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class currencyTest extends TestCase
{
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->post('/currencies/store',[
            'name' => $this->faker()->currencyCode,
            'code' => $this->faker()->currencyCode,
            'symbol' => $this->faker()->text(5),
            'isDefault' => 0,
        ]);

        dd($response->getStatusCode());
    }


}
