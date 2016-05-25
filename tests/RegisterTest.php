<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
    use DatabaseTransactions;

    protected $baseUrl = 'http://testlaravel';
    /**
     * My test implementation
     */
    protected $password = 'testpass123';

    /** @before */
    public function setupUserObjectBeforeAnyTest()
    {
        $this->app->make('db')->beginTransaction();
        $this->beforeApplicationDestroyed(function () {
            $this->app->make('db')->rollBack();
        });

        $this->user = factory(App\User::class)->create([
            'email' => 'john@example.com',
            'password' => bcrypt($this->password),
        ]);
    }

    /** @test */
    public function a_user_can_successfully_log_in()
    {
        $this->visit('/login');
        $this->type($this->user->email, 'email');
        $this->type($this->password, 'password');
        $this->press('Login');
        $this->seePageIs('/');
    }

    /** @test */
    public function a_user_receives_errors_for_wrong_login_credentials()
    {
        $this->visit('/login');
        $this->type($this->user->email, 'email');
        $this->type('invalid-password', 'password');
        $this->press('Login');
        $this->see('These credentials do not match our records.');
    }

    /** @test */
    public function testProfileErrors()
    {
        $this->visit('/login');
        $this->type($this->user->email, 'email');
        $this->type($this->password, 'password');
        $this->press('Login');
        $this->seePageIs('/');

        $this->visit('/profile');
        $this->type('123', 'name');
        $this->press('Save');
        $this->see('The phone field is required.');

        $this->visit('/profile');
        $this->type('123', 'name');
        $this->type('11', 'phone');
        $this->press('Save');
        $this->see('The phone must be at least 10 characters.');

        $this->visit('/profile');
        $this->type('User_test', 'name');
        $this->type('1234567890', 'phone');
        $this->type($this->user->password, 'password');
        $this->press('Save');
        $this->see('The password confirmation does not match.');
    }

}
