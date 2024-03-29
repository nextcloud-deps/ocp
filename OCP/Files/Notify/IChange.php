<?php
/**
 * @copyright Copyright (c) 2017 Robin Appelman <robin@icewind.nl>
 *
 * @author Christoph Wurst <christoph@winzerhof-wurst.at>
 * @author Robin Appelman <robin@icewind.nl>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */
namespace OCP\Files\Notify;

/**
 * Represents a detected change in the storage
 *
 * @since 12.0.0
 */
interface IChange {
	/**
	 * @since 12.0.0
	 */
	public const ADDED = 1;

	/**
	 * @since 12.0.0
	 */
	public const REMOVED = 2;

	/**
	 * @since 12.0.0
	 */
	public const MODIFIED = 3;

	/**
	 * @since 12.0.0
	 */
	public const RENAMED = 4;

	/**
	 * Get the type of the change
	 *
	 * @return int IChange::ADDED, IChange::REMOVED, IChange::MODIFIED or IChange::RENAMED
	 *
	 * @since 12.0.0
	 */
	public function getType();

	/**
	 * Get the path of the file that was changed relative to the root of the storage
	 *
	 * Note, for rename changes this path is the old path for the file
	 *
	 * @return mixed
	 *
	 * @since 12.0.0
	 */
	public function getPath();
}
