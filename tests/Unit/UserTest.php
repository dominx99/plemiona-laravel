<?php

namespace Tests\Feature;

use App\User;
use App\Village;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * @test
     *
     * @return void
     */
    public function login_page_is_responsable()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * @test
     * @dataProvider data_for_registration_that_has_to_pass
     *
     * @param string $nick
     * @param string $password
     * @return void
     */
    public function that_registration_will_pass($nick, $password)
    {
        $response = $this->post('/register', [
            'nick'                  => $nick,
            'password'              => $password,
            'password_confirmation' => $password,
        ]);

        $response->assertRedirect('/home');
        $this->assertDatabaseHas('users', [
            'nick' => $nick,
        ]);
    }

    /**
     * @test
     * @dataProvider data_for_registration_that_has_to_fail
     *
     * @param string $nick
     * @param string $password
     * @param string $confirmationPassword
     * @return void
     */
    public function that_registration_will_fail($nick, $password, $confirmationPassword)
    {
        $this->get('/register');

        $response = $this->post('/register', [
            'nick'                  => $nick,
            'password'              => $password,
            'password_confirmation' => $confirmationPassword,
        ]);

        $response->assertRedirect(route('register'));
        $this->assertDatabaseMissing('users', [
            'nick' => $nick,
        ]);
    }

    public function that_login_will_pass()
    {
        $password = 'password';

        $user = factory(User::class)->create([
            'password' => Hash::make($password),
        ]);

        $response = $this->post('/login', [
            'nick'     => $user->nick,
            'password' => $password,
        ]);

        $response->assertRedirect('/home');
    }

    /**
     * @test
     *
     * @return void
     */
    public function that_village_for_user_is_created_on_user_created()
    {
        $user = factory(User::class)->create();

        $this->assertDatabaseHas('villages', [
            'user_id' => $user->id,
        ]);

        $this->assertEquals(1, $user->villages->count());
    }

    /**
     * @test
     *
     * @return void
     */
    public function that_two_other_villages_are_created_on_user_created()
    {
        $user = factory(User::class)->create();

        $this->assertDatabaseHas('villages', [
            'user_id' => 0,
        ]);

        $villagesWithoutOwner = Village::where('user_id', 0)->count();

        $this->assertEquals(2, $villagesWithoutOwner);
    }

    public function data_for_registration_that_has_to_pass()
    {
        return [
            ['Camile', 'password'],
            ['Abc', 'pass12'],
        ];
    }

    public function data_for_registration_that_has_to_fail()
    {
        return [
            ['ab', 'password', 'password'],
            ['TooLongNickname', 'password', 'password'],
            ['White space', 'password', 'password'],
            ['nick', 'pass', 'pass'],
            ['nick', 'password', 'pass'],
        ];
    }
}
