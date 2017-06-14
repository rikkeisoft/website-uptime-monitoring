<?php

namespace Tests\Repository;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class UserRepositoryTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * Test request Repository function CreateUser empty
//     */
//    public function testCreateUserEmptyData()
//    {
//        $data = [];
//        $result = app(UserRepository::class)->createUser($data);
//        $this->assertFalse($result);
//    }

    /**
     * Test request Repository function CreateUser true
     */
    public function testCreateUserSuccessfully()
    {
        Mail::fake();
        $data = [
            'username' => 'Mr Test',
            'email' => 'mrtest124@gmail.com',
            'password' => 'password'
        ];
        $result = app(UserRepository::class)->createUser($data);
        $this->assertTrue($result);
    }


    /**
     * Test request Repository function Activate empty token
     */
    public function testActivateUserByInvalidToken()
    {
        $token = '';
        $result= app(UserRepository::class)->activateUser($token);
        $this->assertFalse($result);
    }

    /**
     * Test request Repository function Activate status false
     */
    public function  testActivateUserByStatus()
    {
        $status = 1;
        $result = app(UserRepository::class)->activateUser($status);
        $this->assertFalse($result);
    }
    /**
     * Test request Repository function Activate False
     */
    public function testActivateUserFalse()
    {
        $token = [
            'access_token' => str_random(30)
        ];
        $updated = app(UserRepository::class)->activateUser($token);
        $this->assertFalse($updated);
    }
    /**
     * Test request Repository function Activate True
     */
    public function testActivateUserTrue()
    {

    }
}