<?php

/**
 * @package Banner\Database\Database
 */

namespace Banner\Database;

interface Database {
	/**
	* Insert data
	* @param string[] $options
	* @return bool
	*/
	public function insert(array $options = []): bool;

	/**
	* Update data
	* @param string[] $where
	* @param string[] $options
	* @return bool
	*/
	public function update(array $where, array $options = []): bool;

	/**
	* Delete data
	* @param int $id
	* @return bool
	*/
	public function delete(int $id): bool;
}