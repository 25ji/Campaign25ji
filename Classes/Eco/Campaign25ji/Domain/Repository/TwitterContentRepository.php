<?php
namespace Eco\Campaign25ji\Domain\Repository;

/*                                                                        *
 * This script belongs to the TYPO3 Flow package "Eco.Campaign25ji".      *
 *                                                                        *
 *                                                                        */

use Eco\Campaign25ji\Domain\Model\TwitterContent;
use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\QueryInterface;
use TYPO3\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class TwitterContentRepository extends Repository {

	/**
	 * Find latest imported tweet
	 *
	 * @return TwitterContent|NULL
	 */
	public function findLatestImported() {
		$query = $this->createQuery();
		$query->matching($query->equals('internalUser', NULL));
		$query->setOrderings(array('postDate', QueryInterface::ORDER_DESCENDING));
		return $query->execute()->getFirst();
	}

	/**
	 * Check if the given status url was already imported/added.
	 *
	 * @param string $statusUrl
	 * @return TwitterContent|NULL
	 */
	public function findOneByStatusUrl($statusUrl) {
		$query = $this->createQuery();
		$query->matching($query->equals('url', $statusUrl));
		return $query->execute()->getFirst();
	}

}