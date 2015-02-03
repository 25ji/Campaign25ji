<?php
namespace Eco\Campaign25ji\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Annotations as Flow;

/**
 * Container for content created in the 25ji platform.
 *
 * @Flow\Entity
 */
class PortalContent extends AbstractContent {

	/**
	 * @var string
	 */
	protected $headline;

	/**
	 * @var string
	 */
	protected $subheadline;

	/**
	 * @return string
	 */
	public function getHeadline() {
		return $this->headline;
	}

	/**
	 * @param string $headline
	 */
	public function setHeadline($headline) {
		$this->headline = $headline;
	}

	/**
	 * @return string
	 */
	public function getSubheadline() {
		return $this->subheadline;
	}

	/**
	 * @param string $subheadline
	 */
	public function setSubheadline($subheadline) {
		$this->subheadline = $subheadline;
	}
}