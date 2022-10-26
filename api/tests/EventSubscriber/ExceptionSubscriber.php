<?php

namespace App\Tests\Controller;

use App\EventSubscriber\ExceptionSubscriber;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionSubscriberTest extends WebTestCase
{
    public function testEventSubscription () {
        $this->assertArrayHasKey(ExceptionEvent::class, ExceptionSubscriber::getSubscribedEvents());
    }
}
