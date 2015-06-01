<?php
namespace Eco\Campaign25ji\Domain\Repository;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Persistence\QueryResultInterface;


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
	 * @param \DateTime $postedAfter
	 * @param integer $limit
	 * @return QueryResultInterface
	 */
	public function findRecentSponsorContent(\DateTime $postedAfter, $limit = 2) {
		$query = $this->createQuery();

		$query->matching(
			$query->logicalAnd(array(
				$query->greaterThanOrEqual('postDate', $postedAfter),
				$query->equals('internalUser.sponsor', TRUE, TRUE)
			))
		)->setLimit($limit);

		return $query->execute();
	}

	/**
	 * @param integer $limit
	 * @return QueryResultInterface
	 */
	public function findSponsoredContent($limit = 2) {
		$query = $this->createQuery();

		$query->matching(
			$query->equals('internalUser.sponsor', TRUE, TRUE)
		)->setLimit($limit);

		return $query->execute();
	}

	/**
	 * @param array $elementsToExclude
	 * @return QueryResultInterface
	 */
	public function findAllExcludingSet($elementsToExclude = array()) {
		$query = $this->createQuery();
		if ($elementsToExclude !== []) {
			$queryBuilder = $query->getQueryBuilder();
			$queryBuilder->where('e.Persistence_Object_Identifier NOT IN (:elementsToExclude)');
			$queryBuilder->setParameter('elementsToExclude', $elementsToExclude);
		}

		return $query->execute();
	}

	/**
	 * @param string $term
	 * @return QueryResultInterface
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