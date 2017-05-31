<?php

namespace Tests\Repository;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Events\UserCreated;

class UserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test request function CreateUser
     */
    public function testCreateUser()
    {
        $result = UserRepository::createUser();
        if (empty($user)) {
            return false;
        }

        $user = factory(User::class)->create();
        //test user
        $this->assertDatabaseHas('users', [
            'username' => 'Mr Test',
            'email' => 'khanhpoly@gmail.com',
            'status' => '0'
        ]);
    }

    /**
     *
     */
    public function testActivateUser()
    {

    }


}
