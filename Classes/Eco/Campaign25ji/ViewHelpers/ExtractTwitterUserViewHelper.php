<?php
namespace Eco\Campaign25ji\ViewHelpers;

use TYPO3\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 *
 */
class ExtractTwitterUserViewHelper extends AbstractViewHelper {

	/**
	 * Returns the twitter username referenced in the given status URL.
	 *
	 * @param string $statusUrl A twitter status url
	 * @return string
	 */
	public function render($statusUrl) {
		return static::renderStatic($this->arguments, $this->buildRenderChildrenClosure(), $this->renderingContext);
	}

	/**
	 * @param array $arguments
	 * @param \Closure $renderChildrenClosure
	 * @param RenderingContextInterface $renderingContext
	 * @return string
	 */
	static public function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
		$twitterUrl = $arguments['statusUrl'];
		$path = parse_url($twitterUrl, PHP_URL_PATH);
		$path = trim($path, '/');
		$pathElements = explode('/', $path);

		return (isset($pathElements[0]) ? $pathElements[0] : '');
	}
}