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

	const CONTENT_TYPE = 'portal';

	/**
	 * @var string
	 * @Flow\Validate(type="NotEmpty")
	 */
	protected $headline;
}