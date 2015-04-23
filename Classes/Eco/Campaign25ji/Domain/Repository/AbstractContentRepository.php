<?php
namespace Eco\Campaign25ji\Domain\Repository;

use TYPO3\Flow\Annotations as Flow;


/**
 * AbstractContentRepository
 *
 * @Flow\Scope("singleton")
 */
class AbstractContentRepository extends \TYPO3\Flow\Persistence\Doctrine\Repository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = array('postDate' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING);

	/**
	 * @param string $term
	 * @return \TYPO3\Flow\Persistence\QueryResultInterface
	 */
	public function findBySearchTerm($term) {
		$query = $this->createQuery();
		$term = trim($term);
		if ($term === '') {
			return $query->execute();
		}

		$termParts = explode(' ', $term);
		$constraints = [];
		foreach ($termParts as $key => &$termPart) {
			$termPart = '%' . trim($termPart) . '%';
			$constraints[] = $query->logicalOr(
				$query->like('headline', $termPart, FALSE),
				$query->like('rawContent', $termPart, FALSE),
				$query->like('url', $termPart, FALSE)
			);
		}

		if (isset($constraints[1])) {
			$query->matching($query->logicalAnd($constraints));
		} else {
			$query->matching($constraints[0]);
		}

		return $query->execute();
	}
}