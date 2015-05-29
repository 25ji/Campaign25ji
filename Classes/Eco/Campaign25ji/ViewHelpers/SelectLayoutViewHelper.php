<?php
namespace Eco\Campaign25ji\ViewHelpers;

use Eco\Campaign25ji\Domain\Model\AbstractContent;
use TYPO3\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 *
 */
class SelectLayoutViewHelper extends AbstractViewHelper {

	/**
	 * Returns a layout number for the given content
	 *
	 * @param AbstractContent $content A portal content
	 * @return string
	 */
	public function render($content) {
		return static::renderStatic($this->arguments, $this->buildRenderChildrenClosure(), $this->renderingContext);
	}

	/**
	 * @param array $arguments
	 * @param \Closure $renderChildrenClosure
	 * @param RenderingContextInterface $renderingContext
	 * @return string
	 */
	static public function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext) {
		$content = $arguments['content'];
		$objectManager = $renderingContext->getObjectManager();

		$persistenceManager = $objectManager->get(\TYPO3\Flow\Persistence\PersistenceManagerInterface::class);
		$identifier = $persistenceManager->getIdentifierByObject($content);

		$denominator = $identifier[0];

		switch ($denominator) {
			case '0':
			case '1':
			case '2':
			case '3':
			case '4':
			case '5':
				return '1';
				break;
			case '6':
			case '7':
			case '8':
			case '9':
			case 'a':
				return '2';
				break;
			case 'b':
			case 'c':
			case 'd':
			case 'e':
			case 'f':
				return '3';
				break;
		}
	}
}