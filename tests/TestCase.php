<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * Seed the reference content every page on this site depends on.
     *
     * Without it a page test is really just testing an empty database:
     * "GET /locations returns 200" would pass on a template that renders no
     * locations at all, which is exactly the regression the legacy site had.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }
}
