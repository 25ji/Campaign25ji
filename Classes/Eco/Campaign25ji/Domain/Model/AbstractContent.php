<?php
namespace Eco\Campaign25ji\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Object\ObjectManagerInterface;

/**
 * Abstract container for any kind of content.
 *
 * @Flow\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 */
abstract class AbstractContent {

	/**
	 * The post date. Either current date for internally created content or the imported date.
	 *
	 * @var \DateTime
	 */
	protected $postDate;

	/**
	 * State for this content post.
	 *
	 * @var integer
	 */
	protected $state = 1;

	/**
	 * The raw content for this post.
	 *
	 * @var string
	 * @ORM\Column(type="text")
	 */
	protected $rawContent;

	/**
	 * Relation to the user account.
	 *
	 * @var \TYPO3\Party\Domain\Model\AbstractParty
	 * @ORM\ManyToOne
	 * @ORM\JoinColumn(nullable=true)
	 */
	protected $internalUser;

	/**
	 * URL to more information or the full original post, depends on the system.
	 *
	 * @var string
	 */
	protected $url;

	/**
	 * Initialize the object after creation.
	 *
	 * @param integer $cause
	 */
	public function initializeObject($cause) {
		if ($cause === ObjectManagerInterface::INITIALIZATIONCAUSE_CREATED) {
			$this->postDate = new \DateTime();
		}
	}

	/**
	 * @return \DateTime
	 */
	public function getPostDate() {
		return $this->postDate;
	}

	/**
	 * @param \DateTime $postDate
	 */
	public function setPostDate($postDate) {
		$this->postDate = $postDate;
	}

	/**
	 * @return int
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * @param int $state
	 */
	public function setState($state) {
		$this->state = $state;
	}

	/**
	 * @return string
	 */
	public function getRawContent() {
		return $this->rawContent;
	}

	/**
	 * @param string $rawContent
	 */
	public function setRawContent($rawContent) {
		$this->rawContent = $rawContent;
	}

	/**
	 * @return \TYPO3\Party\Domain\Model\AbstractParty
	 */
	public function getInternalUser() {
		return $this->internalUser;
	}

	/**
	 * @param \TYPO3\Party\Domain\Model\AbstractParty $internalUser
	 */
	public function setInternalUser($internalUser) {
		$this->internalUser = $internalUser;
	}

	/**
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * @param string $url
	 */
	public function setUrl($url) {
		$this->url = $url;
	}
}