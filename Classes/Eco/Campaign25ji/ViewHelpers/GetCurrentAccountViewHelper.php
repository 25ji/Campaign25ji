<?php
namespace Eco\Campaign25ji\ViewHelpers;

use TYPO3\Flow\Annotations as Flow;
use TYPO3\Flow\Security\Account;
use TYPO3\Flow\Security\Context;
use TYPO3\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 *
 */
class GetCurrentAccountViewHelper extends AbstractViewHelper {

	/**
	 * @Flow\Inject
	 * @var Context
	 */
	protected $securityContext;

	/**
	 * Returns the current account.
	 *
	 * @return Account
	 */
	public function render() {
		return $this->securityContext->getAccount();
	}
}
