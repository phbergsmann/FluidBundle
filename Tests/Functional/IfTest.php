<?php
namespace PhBergsmann\Tests\Functional\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IfTest extends WebTestCase
{
    /**
     * @test
     */
    public function aFluidTemplateIsRendered()
    {
        $client = static::createClient();

        $client->request('GET', '/fluid/if');

        $this->assertContains('three equals three', $client->getResponse()->getContent());
        $this->assertNotContains('one equals two', $client->getResponse()->getContent());
    }
}