<?php
namespace Eco\Campaign25ji\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Party\Domain\Model\AbstractParty;

/**
 * Container for content created in the 25ji platform.
 *
 * @Flow\Entity
 */
class PostCreator extends AbstractParty {


	protected $image;

}