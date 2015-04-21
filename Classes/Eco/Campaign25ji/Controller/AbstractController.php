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
	 * If logged in the current account is available here.
	 *
	 * @var \TYPO3\Flow\Security\Account
	 */
	protected $account;

	/**
	 * If logged in the current user is available here.
	 *
	 * @var \Eco\Campaign25ji\Domain\Model\PortalUser
	 */
	protected $user;

	/**
	 *
	 */
	public function initializeAction() {
		$this->setAccountAndUser();

		if ($this->account !== NULL && $this->user === NULL && ($this->actionMethodName !== 'edit' || !($this instanceof UserProfileController))) {
			$this->redirect('edit', 'UserProfile');
		}
	}

	/**
	 * @param ViewInterface $view
	 */
	protected function initializeView(ViewInterface $view) {
		parent::initializeView($view);
		$this->setAccountAndUser();
		$view->assign('account', $this->account);
		$view->assign('user', $this->user);
	}

	protected function setAccountAndUser() {
		if ($this->account === NULL) {
			$this->account = $this->securityContext->getAccount();
		}

		if ($this->account !== NULL) {
			$this->user = $this->partyService->getAssignedPartyOfAccount($this->account);
		}
	}
}