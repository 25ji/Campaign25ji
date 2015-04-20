<?php
namespace Eco\Campaign25ji\Controller;

use Eco\Campaign25ji\Domain\Model\PortalUser;
use Eco\Campaign25ji\Domain\Repository\PortalUserRepository;
use TYPO3\Flow\Annotations as Flow;

/**
 *
 */
class UserProfileController extends AbstractController {

	/**
	 * @Flow\Inject
	 * @var PortalUserRepository
	 */
	protected $portalUserRepository;

	/**
	 */
	public function indexAction() {
		$account = $this->getAccountOrRedirectToLogin();
		$user = $this->partyService->getAssignedPartyOfAccount($account);
		if ($user === NULL) {
			$this->addFlashMessage('You need to add your account details.');
			$this->redirect('edit');
		}

		$this->view->assignMultiple(array(
			'account' => $account,
			'user' => $user
		));
	}

	/**
	 */
	public function editAction() {
		$account = $this->getAccountOrRedirectToLogin();
		$user = $this->partyService->getAssignedPartyOfAccount($account);
		if ($user === NULL) {
			$user = new PortalUser();
			$this->partyService->assignAccountToParty($account, $user);
		}

		$this->view->assign('user', $user);
	}

	/**
	 * @param PortalUser $user
	 */
	public function updateAction(PortalUser $user) {
		$account = $this->getAccountOrRedirectToLogin();
		$currentUser = $this->partyService->getAssignedPartyOfAccount($account);
		if ($currentUser === NULL || $user === $currentUser) {
			if ($this->persistenceManager->isNewObject($user)) {
				$this->portalUserRepository->add($user);
				$this->partyService->assignAccountToParty($account, $user);
			} else {
				$this->portalUserRepository->update($user);
			}
		}

		$this->redirect('index');
	}

	/**
	 * @return \TYPO3\Flow\Security\Account
	 */
	protected function getAccountOrRedirectToLogin() {
		$account = $this->securityContext->getAccount();
		if ($account === NULL) {
			$this->redirect('welcome', 'Standard');
		}

		return $account;
	}

}