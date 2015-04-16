<?php
namespace Eco\Campaign25ji\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Flowpack\TwitterApi\Domain\Repository\TweetRepository;
use TYPO3\Flow\Annotations as Flow;

/**
 * Container for content created on Twitter
 *
 * @Flow\Entity
 */
class TwitterContent extends AbstractContent {

	/**
	 * @Flow\Inject
	 * @var TweetRepository
	 */
	protected $tweetRepository;

	const CONTENT_TYPE = 'twitter';


	/**
	 * @param string $url
	 */
	public function setUrl($url) {
		$tweet = $this->tweetRepository->findByUrl($url);

		if ($tweet === NULL) {
			throw new \InvalidArgumentException('The given url was not a valid twitter status URL.', 1428936820);
		}

		$this->setRawContent($tweet->getText());
		$this->setPostDate($tweet->getCreatedAt());
		$this->url = $url;
	}
}