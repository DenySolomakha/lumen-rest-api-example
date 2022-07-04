<?php

declare(strict_types=1);

namespace Tests;

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class MainTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetIssetCompany(): void
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(),
            $this->response->getContent()
        );
    }
}
