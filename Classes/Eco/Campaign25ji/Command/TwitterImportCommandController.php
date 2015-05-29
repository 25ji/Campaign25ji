<?php
namespace Eco\Campaign25ji\Command;

use TYPO3\Flow\Annotations as Flow;
use Eco\Campaign25ji\Domain\Model\TwitterContent;
use TYPO3\Flow\Cli\CommandController;
use Eco\Campaign25ji\Domain\Repository\TwitterContentRepository;

/**
 * Commands to import twitter content into the platform
 */
class TwitterImportCommandController extends CommandController {

	/**
	 * @Flow\Inject
	 * @var \Flowpack\TwitterApi\Domain\Repository\TweetRepository
	 */
	protected $tweetRepository;

	/**
	 * @Flow\Inject
	 * @var TwitterContentRepository
	 */
	protected $twitterContentRepository;

	/**
	 * Import tweets by given hashtag
	 *
	 * @param string $hashTag
	 */
	public function byHashTagCommand($hashTag) {
		$query = $hashTag;
		$latestImported = $this->twitterContentRepository->findLatestImported();

		if ($latestImported !== NULL) {
			$query = ' since:' . $latestImported->getPostDate()->format('Y-m-d');
		}

		$imported = 0;
		$skipped = 0;
		$tweets = $this->tweetRepository->findByQuery($query);
		foreach ($tweets as $tweet) {
			$existingContent = $this->twitterContentRepository->findOneByStatusUrl($tweet->getStatusUrl());
			if ($existingContent === NULL) {
				$content = new TwitterContent();
				$content->setUrl($tweet->getStatusUrl());
				$content->setPostDate($tweet->getCreatedAt());
				$content->setRawContent($tweet->getText());
				$this->twitterContentRepository->add($content);
				$imported++;
			} else {
				$skipped++;
			}
		}

		if ($imported > 0) {
			$this->outputLine('Imported ' . $imported . ' tweets.');
		}

		if ($skipped > 0) {
			$this->outputLine('Skipped ' . $skipped . ' because they existed already.');
		}

		$this->quit();
	}
}