<?php
namespace PhBergsmann\Tests\Functional\Test;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
class FluidTemplateTest extends WebTestCase
{
    /**
     * @test
     */
    public function aFluidTemplateIsRendered()
    {
        $client = static::createClient();

        $client->request('GET', '/fluid');

        $this->assertEquals('I am a fluid template', $client->getResponse()->getContent());
    }
}