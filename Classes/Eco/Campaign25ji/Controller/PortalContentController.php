<?php
namespace Eco\Campaign25ji\Controller;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Eco.Campaign25ji".      *
 *                                                                        *
 *                                                                        */

use Eco\Campaign25ji\Domain\Model\AbstractContent;
use TYPO3\Flow\Annotations as Flow;
use Eco\Campaign25ji\Domain\Model\PortalContent;

/**
 * Class PortalContentController
 *
 */
class PortalContentController extends AbstractController {

	/**
	 * @Flow\Inject
	 * @var \Eco\Campaign25ji\Domain\Repository\AbstractContentRepository
	 */
	protected $abstractContentRepository;

	/**
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('packery', TRUE);
		$sponsoredContent = $this->abstractContentRepository->findSponsoredContent();
		$this->view->assign('sponsorContent', $sponsoredContent);
		$this->view->assign('portalContents', $this->abstractContentRepository->findAllExcludingSet($sponsoredContent->toArray()));
	}

	/**
	 * @param string $term
	 * @return void
	 */
	public function searchAction($term) {
		if (trim($term) === '') {
			$this->redirect('index');
		}
		$this->view->assign('packery', TRUE);
		$this->view->assign('term', $term);
		$this->view->assign('portalContents', $this->abstractContentRepository->findBySearchTerm($term));
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
	public function selectTypeAction() {
	}

	public function initializeCreateAction() {
		$this->arguments->getArgument('newPortalContent')->getPropertyMappingConfiguration()->setTypeConverterOption(\TYPO3\Flow\Property\TypeConverter\PersistentObjectConverter::class, \TYPO3\Flow\Property\TypeConverter\PersistentObjectConverter::CONFIGURATION_OVERRIDE_TARGET_TYPE_ALLOWED, TRUE);
	}

	/**
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * @return void
	 */
	public function newTwitterAction() {

	}

	/**
	 * @param AbstractContent $newPortalContent
	 * @return void
	 */
	public function createAction(AbstractContent $newPortalContent) {
		$newPortalContent->setPostDate(new \DateTime());
		$newPortalContent->setInternalUser($this->user);
		$this->abstractContentRepository->add($newPortalContent);
		$this->addFlashMessage('Created a new portal content.');
		$this->redirect('index');
	}

	/**
	 * @param AbstractContent $portalContent
	 * @return void
	 */
	public function editAction(AbstractContent $portalContent) {
		$this->view->assign('portalContent', $portalContent);
	}

	/**
	 * @param AbstractContent $portalContent
	 * @return void
	 */
	public function updateAction(AbstractContent $portalContent) {
		$this->abstractContentRepository->update($portalContent);
		$this->addFlashMessage('Updated the portal content.');
		$this->redirect('index');
	}

	/**
	 * @param AbstractContent $portalContent
	 * @return void
	 */
	public function deleteAction(AbstractContent $portalContent) {
		$this->abstractContentRepository->remove($portalContent);
		$this->addFlashMessage('Deleted a portal content.');
		$this->redirect('index');
	}

}