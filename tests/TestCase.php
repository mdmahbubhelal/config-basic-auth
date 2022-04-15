<?php

namespace MdMahbubHelal\ConfigBasicAuth\Tests;

use Illuminate\Support\Facades\Route;
use MdMahbubHelal\ConfigBasicAuth\ConfigBasicAuthServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            ConfigBasicAuthServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        Route::get('/', function () {
            return 'Inside';
        });
    }

    protected function withBasicAuth(string $username, string $password): self
    {
        return $this->withHeaders([
            'Authorization' => 'Basic ' . base64_encode("{$username}:{$password}")
        ]);
    }
}
