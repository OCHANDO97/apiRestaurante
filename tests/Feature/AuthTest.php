<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use Illuminate\Support\Facades\hash;

class AuthTest extends TestCase
{
      public function test_login()  {

        Artisan::call('migrate');
        User::create([
            "usuario" => "juan",
            "password" => Hash::make('12345678')
        ]);

        $response = $this->post('api/login', [
            'usuario' => 'juan',
            'password' => '12345678'
        ]);

        $response->assertStatus(200)->assertJson([
            'success' => true
        ]); 

    }

    public function test_register() {

        Artisan::call('migrate');
        $userData = [
            'usuario' => 'juan',
            'password' => '12345678'
        ];

        $response = $this->post('api/register', $userData);
        $response->assertStatus(200)->assertJson([
            'success' => true
        ]);
    }


}
