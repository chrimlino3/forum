<?php

use App\Models\Reply;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->thread = factory(Thread::class)->create();
    }

    public function testShowWithAuthorizedUser(PortalTester $I)
    {
        $I->amLoggedAs($customer, 'web');
    }


}