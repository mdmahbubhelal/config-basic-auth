<?php

namespace Zero\ConfigBasicAuth\Tests\Feature;

use Illuminate\Http\Response;
use Zero\ConfigBasicAuth\Tests\TestCase;

class ConfigBasicAuthTest extends TestCase
{
    private $user0;
    private $user1;

    public function setUp(): void
    {
        parent::setUp();

        [$this->user0, $this->user1] = config('basicauth.users', []);
    }

    /** @test */
    public function can_access_by_passing_correct_credentials()
    {
        $this
            ->withBasicAuth($this->user0['username'], $this->user0['password'])
            ->get('/')
            ->assertStatus(Response::HTTP_OK);

        $this
            ->withBasicAuth($this->user1['username'], $this->user1['password'])
            ->get('/')
            ->assertStatus(Response::HTTP_OK);
    }

    /** @test */
    public function cant_access_without_passing_credentials()
    {
        $this
            ->get('/')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function cant_access_by_passing_incorrect_credentials()
    {
        $this
            ->withBasicAuth('incorrectuser', 'incorrect_password')
            ->get('/')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function cant_access_by_passing_only_one_correct_credential()
    {
        $this
            ->withBasicAuth($this->user0['username'], '')
            ->get('/')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this
            ->withBasicAuth('', $this->user0['password'])
            ->get('/')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    public function cant_access_by_mismatching_credentials()
    {
        $this
            ->withBasicAuth($this->user0['username'], $this->user1['password'])
            ->get('/')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this
            ->withBasicAuth($this->user1['username'], $this->user0['password'])
            ->get('/')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }
}
