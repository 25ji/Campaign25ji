<?php
namespace Eco\Campaign25ji\Controller;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use TYPO3\Flow\Mvc\View\ViewInterface;
use TYPO3\Flow\Security\Context;
use TYPO3\Party\Domain\Service\PartyService;

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
	 * @Flow\Inject
	 * @var PartyService
	 */
	protected $partyService;

	/**
	 *
	 */
	public function initializeAction() {
		$account = $this->securityContext->getAccount();
		if ($account !== NULL) {
			$user = $this->partyService->getAssignedPartyOfAccount($account);
			if ($user === NULL) {
				$this->redirect('edit', 'UserProfile');
			}
		}
	}

	/**
	 * @param ViewInterface $view
	 */
	protected function initializeView(ViewInterface $view) {
		parent::initializeView($view);
		$account = $this->securityContext->getAccount();
		$view->assign('account', $account);
		if ($account !== NULL) {
			$user = $this->partyService->getAssignedPartyOfAccount($account);
			$view->assign('user', $user);
		}
	}
}