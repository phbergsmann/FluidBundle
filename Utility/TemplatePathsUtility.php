<?php
namespace PhBergsmann\FluidBundle\Utility;

use NamelessCoder\Fluid\View\TemplatePaths;
use NamelessCoder\Fluid\View\Exception\InvalidTemplateResourceException;
use Symfony\Component\Templating\TemplateNameParserInterface;
use Symfony\Component\Templating\Loader\LoaderInterface;

class TemplatePathsUtility extends TemplatePaths
{
    /**
     * @var TemplateNameParserInterface
     */
    protected $parser;

    /**
     * @var LoaderInterface
     */
    protected $loader;

    /**
     * Resolve the path and file name of the layout file, based on
     * $this->options['layoutPathAndFilename'] and $this->options['layoutPathAndFilenamePattern'].
     *
     * In case a layout has already been set with setLayoutPathAndFilename(),
     * this method returns that path, otherwise a path and filename will be
     * resolved using the layoutPathAndFilenamePattern.
     *
     * @param string $layoutName Name of the layout to use. If none given, use "Default"
     * @return string Path and filename of layout files
     * @throws InvalidTemplateResourceException
     */
    public function getLayoutPathAndFilename($layoutName = 'Default')
    {
        $format = $this->getFormat();
        $layoutName = ucfirst($layoutName);
        $layoutKey = $layoutName . '.' . $format;
        if (!array_key_exists($layoutKey, self::$resolvedFiles['layouts'])) {
            $paths = $this->getLayoutRootPaths();
            $templateName = $this->parser->parse($layoutName);
            $template = $this->loader->load($templateName);
            self::$resolvedFiles['layouts'][$layoutKey] = $template;
        }
        return self::$resolvedFiles['layouts'][$layoutKey];
    }

    /**
     * @param TemplateNameParserInterface $templateParser
     */
    public function setTemplateParser(TemplateNameParserInterface $templateParser)
    {
        $this->parser = $templateParser;
    }

    /**
     * @return TemplateNameParserInterface
     */
    public function getTemplateParser()
    {
        return $this->parser;
    }

    /**
     * @param LoaderInterface $templateParser
     */
    public function setTemplateLoader(LoaderInterface $templateParser)
    {
        $this->loader = $templateParser;
    }

    /**
     * @return LoaderInterface
     */
    public function getTemplateLoader()
    {
        return $this->loader;
    }
}