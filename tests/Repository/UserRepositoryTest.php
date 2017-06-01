<?php

namespace Tests\Repository;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;

class UserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test request Repository function CreateUser empty
     * @internal param array $data
     */
    public function testCreateUserEmpty()
    {
        $data = [];
        $createdUser = app(UserRepository::class)->createUser($data);
        $this->assertEmpty($createdUser);
    }

    /**
     * Test request Repository function CreateUser true
     * @return bool
     * @internal param array $data
     */
    public function testCreateUserTrue()
    {
        Mail::fake();
        $data = [
            'username' => 'Mr Test',
            'email' => 'mrtest124@gmail.com',
            'password' => bcrypt('password')
        ];
        $createdUser = app(UserRepository::class)->createUser($data);
        $this->assertTrue($createdUser);
    }

    /**
     * Test request Repository function CreateUser false
     * @return bool
     * @internal param array $data
     */
    public function testCreateUserFalse()
    {
        $data = [];
        $createdUser = app(UserRepository::class)->createUser($data);
        $this->assertFalse($createdUser);
    }


    /**
     * Test request Repository function Activate Empty
     * @return bool
     */
    public function testActivateUserEmpty()
    {
        $token = [];
        $updated = app(UserRepository::class)->activateUser($token);
        $this->assertEmpty($updated);
    }

    /**
     * Test request Repository function Activate True
     * @return bool
     */
    public function testActivateUserTrue()
    {
        $token = [
            'access_token' => "D0NaNVz43YzjitVlekIU"
        ];
        $updated = app(UserRepository::class)->activateUser($token);
        $this->assertTrue($updated);
    }

    /**
     * Test request Repository function Activate False
     * @return bool
     */
    public function testActivateUserFalse()
    {
        $token = [
            'access_token' => str_random(30)
        ];
        $updated = app(UserRepository::class)->activateUser($token);
        $this->assertFalse($updated);
    }
}
