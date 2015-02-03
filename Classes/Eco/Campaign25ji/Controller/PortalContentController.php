<?php
namespace Eco\Campaign25ji\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Eco.Campaign25ji".      *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Mvc\Controller\ActionController;
use Eco\Campaign25ji\Domain\Model\PortalContent;

class PortalContentController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \Eco\Campaign25ji\Domain\Repository\PortalContentRepository
	 */
	protected $portalContentRepository;

	/**
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('portalContents', $this->portalContentRepository->findAll());
	}

	/**
	 * @param \Eco\Campaign25ji\Domain\Model\PortalContent $portalContent
	 * @return void
	 */
	public function showAction(PortalContent $portalContent) {
		$this->view->assign('portalContent', $portalContent);
	}

	/**
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * @param \Eco\Campaign25ji\Domain\Model\PortalContent $newPortalContent
	 * @return void
	 */
	public function createAction(PortalContent $newPortalContent) {
		$this->portalContentRepository->add($newPortalContent);
		$this->addFlashMessage('Created a new portal content.');
		$this->redirect('index');
	}

	/**
	 * @param \Eco\Campaign25ji\Domain\Model\PortalContent $portalContent
	 * @return void
	 */
	public function editAction(PortalContent $portalContent) {
		$this->view->assign('portalContent', $portalContent);
	}

	/**
	 * @param \Eco\Campaign25ji\Domain\Model\PortalContent $portalContent
	 * @return void
	 */
	public function updateAction(PortalContent $portalContent) {
		$this->portalContentRepository->update($portalContent);
		$this->addFlashMessage('Updated the portal content.');
		$this->redirect('index');
	}

	/**
	 * @param \Eco\Campaign25ji\Domain\Model\PortalContent $portalContent
	 * @return void
	 */
	public function deleteAction(PortalContent $portalContent) {
		$this->portalContentRepository->remove($portalContent);
		$this->addFlashMessage('Deleted a portal content.');
		$this->redirect('index');
	}

}