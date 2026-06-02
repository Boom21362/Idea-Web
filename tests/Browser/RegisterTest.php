<?php

declare(strict_types=1);

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    // ⚠️ CRUCIAL: The method name MUST start with the word "test"
    public function test_register_aa_user(): void
    {
        $email = 'johnny'.random_int(1, 999).'@gmail.com';

        $this->browse(function (Browser $browser) use ($email) {
            $browser->visit('/register')
                ->waitForInput('name')
                ->fill('name', 'John Doe')
                ->fill('email', $email)
                ->fill('password', '123456789')
                ->pause(200)
                ->press('Create Account')
                ->waitForLocation('/')
                ->assertPathIs('/');
        });

        $this->assertAuthenticated();
    }
}
