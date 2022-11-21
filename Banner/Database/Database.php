<?php

/**
 * @package Banner\Database\Database
 */

namespace Banner\Database;

interface Database {

	public function insert(array $options = []): bool;

	public function update(array $where, array $options = []): bool;

	public function delete(int $id): int;
}