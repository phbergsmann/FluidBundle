<?php
namespace PhBergsmann\Tests\Functional\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LayoutTest extends WebTestCase
{
    /**
     * @test
     */
    public function aFluidLayoutIsRendered()
    {
        $client = static::createClient();

        $client->request('GET', '/fluid/layout');

        $this->assertContains('I\'m the section content', $client->getResponse()->getContent());
        $this->assertContains('LAYOUT', $client->getResponse()->getContent());
    }
}