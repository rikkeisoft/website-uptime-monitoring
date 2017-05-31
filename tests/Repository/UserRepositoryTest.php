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
     * @param array $user
     * @return bool
     */
    public function testCreateUser($user = [])
    {
        //TODO USER NULL
        if (empty($user)){
            return false;
        }
        //TODO USER NOT ARRAY
        //TODO USER INCONSONANT

        //TODO USER FIT
        $user = factory(User::class)->create();
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
