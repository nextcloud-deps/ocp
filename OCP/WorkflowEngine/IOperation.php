<?php

/**
 * SPDX-FileCopyrightText: 2016 Nextcloud GmbH and Nextcloud contributors
 * SPDX-License-Identifier: AGPL-3.0-or-later
 */
namespace OCP\WorkflowEngine;

use OCP\EventDispatcher\Event;

/**
 * Interface IOperation
 *
 * @since 9.1
 */
interface IOperation {
	/**
	 * returns a translated name to be presented in the web interface
	 *
	 * Example: "Automated tagging" (en), "Aŭtomata etikedado" (eo)
	 *
	 * @since 18.0.0
	 */
	public function getDisplayName(): string;

	/**
	 * returns a translated, descriptive text to be presented in the web interface.
	 *
	 * It should be short and precise.
	 *
	 * Example: "Tag based automatic deletion of files after a given time." (en)
	 *
	 * @since 18.0.0
	 */
	public function getDescription(): string;

	/**
	 * returns the URL to the icon of the operator for display in the web interface.
	 *
	 * Usually, the implementation would utilize the `imagePath()` method of the
	 * `\OCP\IURLGenerator` instance and simply return its result.
	 *
	 * Example implementation: return $this->urlGenerator->imagePath('myApp', 'cat.svg');
	 *
	 * @since 18.0.0
	 */
	public function getIcon(): string;

	/**
	 * returns whether the operation can be used in the requested scope.
	 *
	 * Scope IDs are defined as constants in OCP\WorkflowEngine\IManager. At
	 * time of writing these are SCOPE_ADMIN and SCOPE_USER.
	 *
	 * For possibly unknown future scopes the recommended behaviour is: if
	 * user scope is permitted, the default behaviour should return `true`,
	 * otherwise `false`.
	 *
	 * @param int $scope
	 * @psalm-param IManager::SCOPE_* $scope
	 *
	 * @since 18.0.0
	 */
	public function isAvailableForScope(int $scope): bool;

	/**
	 * Validates whether a configured workflow rule is valid. If it is not,
	 * an `\UnexpectedValueException` is supposed to be thrown.
	 *
	 * @throws \UnexpectedValueException
	 * @since 9.1
	 */
	public function validateOperation(string $name, array $checks, string $operation): void;

	/**
	 * Is being called by the workflow engine when an event was triggered that
	 * is configured for this operation. An evaluation whether the event
	 * qualifies for this operation to run has still to be done by the
	 * implementor by calling the RuleMatchers getMatchingOperations method
	 * and evaluating the results.
	 *
	 * If the implementor is an IComplexOperation, this method will not be
	 * called automatically. It can be used or left as no-op by the implementor.
	 *
	 * @since 18.0.0
	 */
	public function onEvent(string $eventName, Event $event, IRuleMatcher $ruleMatcher): void;
}
