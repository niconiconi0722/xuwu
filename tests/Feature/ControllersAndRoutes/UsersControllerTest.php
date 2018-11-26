<?php

namespace Tests\Feature\Controller;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Http\Controllers\UsersController;
use App\Models\User;

class UsersControllerTest extends TestCase
{
    public function testCreate()
    {
        $response = $this->get('/sign_up');

        $response->assertViewIs('users.create');
    }
}
