<?php
namespace Eco\Campaign25ji\ViewHelpers;

use Eco\Campaign25ji\Domain\Model\AbstractContent;
use TYPO3\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 *
 */
class TwitterLinkingViewHelper extends AbstractViewHelper {

	/**
	 * Output contains HMTL
	 *
	 * @var boolean
	 */
	protected $escapeOutput = FALSE;

	/**
	 * Links twitter t.co links in raw twitter status text.
	 *
	 * @param AbstractContent $content A portal content
	 * @return string
	 */
	public function render($content = NULL) {
		return static::renderStatic($this->arguments, $this->buildRenderChildrenClosure(), $this->renderingContext);
	}

	/**
	 * @param array $arguments
	 * @param \Closure $renderChildrenClosure
	 * @param RenderingContextInterface $renderingContext
	 * @return string
	 */
	static public function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
		$content = isset($arguments['content']) ? $arguments['content'] : $renderChildrenClosure();
		$objectManager = $renderingContext->getObjectManager();

		$content = preg_replace_callback('#(http://t.co/[a-zA-Z0-9]{10})#', function($matches) {
			return '<a href="' . $matches[0] . '" target="_blank">' . $matches[0] . '</a>';
		}, $content);

		return $content;
	}
}