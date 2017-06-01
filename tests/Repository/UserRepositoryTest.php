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
     * Test request Repository function CreateUser
     * @return bool
     * @internal param array $data
     */
    public function testCreateUser()
    {
        Mail::fake();
        $data = [
            'username' => 'Mr Test',
            'email' => 'mrtest124@gmail.com',
            'password' => bcrypt('password'),
        ];
        $createdUser = app(UserRepository::class)->createUser($data);
        if ($createdUser === false){
            $this->assertFalse($createdUser);
        }
        $this->assertTrue($createdUser);
    }

    /**
     * Test request Repository function Activate
     * @return bool
     */
    public function testActivateUser()
    {
        $token = [
            'access_token' => "D0NaNVz43YzjitVlekIU"
        ];
        $updated = app(UserRepository::class)->activateUser($token);
        if ($updated === false){
            $this->assertFalse($updated);
        }
        $this->assertTrue($updated);
    }


}
