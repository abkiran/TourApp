<?php
namespace Tests;
use Faker\Factory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations;
    protected $faker;
    public function setUp():void {
        parent::setUp();
        factory(\App\Models\City::class, 10)->create();
        factory(\App\Models\Location::class, 100)->create();
        $this->faker = Factory::create();
    }
}