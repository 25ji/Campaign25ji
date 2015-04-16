<?php
namespace Eco\Campaign25ji\Controller;

use Eco\Campaign25ji\Domain\Model\PortalUser;
use Eco\Campaign25ji\Domain\Repository\PortalUserRepository;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use TYPO3\Flow\Security\Context as SecurityContext;
use TYPO3\Party\Domain\Service\PartyService;

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
	 * @Flow\Inject
	 * @var SecurityContext
	 */
	protected $securityContext;

	/**
	 * @Flow\Inject
	 * @var PartyService
	 */
	protected $partyService;


	public function indexAction() {
		$account = $this->securityContext->getAccount();
		$user = $this->partyService->getAssignedPartyOfAccount($account);
		if ($user === NULL) {
			$this->addFlashMessage('You need to add your account details.');
			$this->forward('edit');
		}

		$this->view->assignMultiple(array(
			'account' => $account,
			'user' => $user
		));
	}

	/**
	 * @param PortalUser $user
	 */
	public function editAction(PortalUser $user = NULL) {
		if ($user === NULL) {
			$user = new PortalUser();
		}

		$this->view->assign('user', $user);
	}

	/**
	 * @param PortalUser $user
	 */
	public function updateAction(PortalUser $user) {
		if ($this->persistenceManager->isNewObject($user)) {
			$this->portalUserRepository->add($user);
			$user->addAccount($this->securityContext->getAccount());
		} else {
			$this->portalUserRepository->update($user);
		}
		$this->redirect('show');
	}

}