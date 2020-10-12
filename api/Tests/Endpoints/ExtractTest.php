<?php

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testCreateRoute()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json',
        ])->json(
                'POST', 
                '/extract', 
                [
                    'user_id' => 1,
                    'name' => 'TEST',
                    'description'=>'TEST',
                    'value'=> 1000.0,
                    'subtag_id' => ''
                ]
        );

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
}