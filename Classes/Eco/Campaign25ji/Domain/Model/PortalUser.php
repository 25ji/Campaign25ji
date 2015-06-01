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
	 * Logo or Avatar image.
	 *
	 * @var Image
	 * @ORM\OneToOne(cascade={"all"})
	 */
	protected $image;

	/**
	 * Link to website (for sponsors for example)
	 *
	 * @var string
	 */
	protected $link = '';

	/**
	 * Is this user a sponsor of the Campaign
	 *
	 * @var boolean
	 */
	protected $sponsor = FALSE;

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

	/**
	 * @return string
	 */
	public function getLink() {
		return $this->link;
	}

	/**
	 * @param string $link
	 */
	public function setLink($link) {
		$this->link = $link;
	}

	/**
	 * @return boolean
	 */
	public function isSponsor() {
		return $this->sponsor;
	}

	/**
	 * @param boolean $sponsor
	 */
	public function setSponsor($sponsor) {
		$this->sponsor = $sponsor;
	}
}