<?php
namespace PhBergsmann\FluidBundle\Loader;

use Symfony\Component\Templating\TemplateNameParserInterface;
use Symfony\Component\Config\FileLocatorInterface;

/**
 * FilesystemLoader extends the default Mustache filesystem loader
 * to work with the Symfony2 paths.
 */
class FilesystemLoader extends \Symfony\Bundle\FrameworkBundle\Templating\Loader\FilesystemLoader
{

}