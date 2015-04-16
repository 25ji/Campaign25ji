<?php
namespace Eco\Campaign25ji\Controller;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use TYPO3\Flow\Mvc\View\ViewInterface;
use TYPO3\Flow\Security\Context;

/**
 *
 */
abstract class AbstractController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var Context
	 */
	protected $securityContext;

	/**
	 * @param ViewInterface $view
	 */
	protected function initializeView(ViewInterface $view) {
		parent::initializeView($view);
		$view->assign('account', $this->securityContext->getAccount());
	}
}