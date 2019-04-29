<?php

namespace Tests;

use App\Models\User;
use Laravel\Dusk\TestCase as BaseTestCase;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

abstract class DuskTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Prepare for Dusk test execution.
     *
     * @beforeClass
     * @return void
     */
    public static function prepare()
    {
        static::startChromeDriver();
    }

    /**
     * Get the URL for the page.
     *
     * @return string
     */
    public function url()
    {
        return 'http://localhost:8000/';
    }

    /**
     * Do the login acation.
     *
     */
    public function doLogin($user)
    {
        $this->browse(function ($browser) use ($user) {
            $browser->visit('http://localhost:8000/login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Login')#->dump();
                    ->assertPathIs('/home');
        });
    }

    /**
     * Create the RemoteWebDriver instance.
     *
     * @return \Facebook\WebDriver\Remote\RemoteWebDriver
     */
    protected function driver()
    {
        $options = (new ChromeOptions)->addArguments([
            '--disable-gpu',
            '--headless',
            '--window-size=1920,1080',
        ]);

        return RemoteWebDriver::create(
            'http://localhost:9515', DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }
}
