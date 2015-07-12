<?php
namespace PhBergsmann\Tests\Unit\Loader;

use PhBergsmann\FluidBundle\FluidEngine;

class FluidEngineTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function theBundleShouldSupportFluidTest()
    {
        $templateViewMock = \Mockery::mock('\NamelessCoder\Fluid\View\TemplateView');
        $templateNameParserMock = \Mockery::mock(
            '\Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser',
            array(
                'parse' => \Mockery::mock(
                    '\Symfony\Bundle\FrameworkBundle\Templating\TemplateReference',
                    array(
                        'get' => 'fluid'
                    )
                )
            )
        );
        $templateFilesystemLoaderMock = \Mockery::mock(
            '\Symfony\Bundle\FrameworkBundle\Templating\Loader\FilesystemLoader'
        );

        $fluidEngine = new FluidEngine($templateViewMock, $templateNameParserMock, $templateFilesystemLoaderMock);

        $this->assertTrue($fluidEngine->supports('fluid'));
    }
}