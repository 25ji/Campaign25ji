<?php
namespace Eco\Campaign25ji\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Media\Domain\Model\Image;
use TYPO3\Party\Domain\Model\AbstractParty;

/**
 * User for the 25 Jahre Internet portal.
 *
 * @Flow\Entity
 */
class PortalUser extends AbstractParty {

	/**
	 * @var Image
	 * @ORM\OneToOne(cascade={"all"})
	 */
	protected $image;

	/**
	 * @return Image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * @param Image $image
	 */
	public function setImage($image) {
		$this->image = $image;
	}

}