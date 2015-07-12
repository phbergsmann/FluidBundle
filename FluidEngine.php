<?php
namespace PhBergsmann\FluidBundle;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating\TemplateNameParserInterface;
use Symfony\Component\Templating\Loader\LoaderInterface;
use Symfony\Component\Templating\TemplateReferenceInterface;

class FluidEngine implements EngineInterface {

	/**
	 * @var \NamelessCoder\Fluid\View\TemplateView
	 */
	protected $fluid;

	public function __construct(\NamelessCoder\Fluid\View\TemplateView $fluid, TemplateNameParserInterface $parser, LoaderInterface $loader)
	{
		$this->fluid = $fluid;
		$this->parser = $parser;
		$this->loader = $loader;
	}
	/**
	 * Renders a view and returns a Response.
	 *
	 * @param string $view The view name
	 * @param array $parameters An array of parameters to pass to the view
	 * @param Response $response A Response instance
	 *
	 * @return Response A Response instance
	 *
	 * @throws \RuntimeException if the template cannot be rendered
	 */
	public function renderResponse($view, array $parameters = array(), Response $response = null) {
		if (null === $response) {
			$response = new Response();
		}

		$response->setContent($this->render($view, $parameters));

		return $response;
	}

	/**
	 * Renders a template.
	 *
	 * @param string|TemplateReferenceInterface $name A template name or a TemplateReferenceInterface instance
	 * @param array $parameters An array of parameters to pass to the template
	 *
	 * @return string The evaluated template as a string
	 *
	 * @throws \RuntimeException if the template cannot be rendered
	 *
	 * @api
	 */
	public function render($name, array $parameters = array()) {
		$this->fluid->setTemplatePathAndFilename($this->load($name));

		$this->fluid->assignMultiple($parameters);

		return $this->fluid->render();
	}

	/**
	 * Returns true if the template exists.
	 *
	 * @param string|TemplateReferenceInterface $name A template name or a TemplateReferenceInterface instance
	 *
	 * @return bool true if the template exists, false otherwise
	 *
	 * @throws \RuntimeException if the engine cannot handle the template name
	 *
	 * @api
	 */
	public function exists($name) {
		$this->load($name);

		return true;
	}

	/**
	 * Returns true if this class is able to render the given template.
	 *
	 * @param string|TemplateReferenceInterface $name A template name or a TemplateReferenceInterface instance
	 *
	 * @return bool true if this class supports the given template, false otherwise
	 *
	 * @api
	 */
	public function supports($name) {
		$template = $this->parser->parse($name);

		return 'fluid' === $template->get('engine');
	}

	protected function load($name)
	{
		$template = $this->parser->parse($name);
		$template = $this->loader->load($template);

		return (string) $template;
	}
}
?>