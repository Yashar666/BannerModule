<?php

/**
 * @package Banner\Database\Model
 */

namespace Banner\Database;

use Banner\Provider;
use Banner\Helper;

class Model {
    /**
    * Set database table for use
    */
    public function __construct()
    {
        $this->db = Provider::get('DB');
        $this->db->setTable('users');
    }

    /**
    * Add data to save in table
    * @return int
    */
    public function add(): int
    {
        $insertID = $this->db->insert([
            'ip_address' => Helper::ip(),
            'user_agent' => Helper::userAgent(),
            'view_date' => Helper::date(),
            'page_url' => Helper::currentPage(),
            'views_count' => 1
        ]);
        return $insertID;
    }

    /**
    * Update data in table
    * @param string $ip
    * @param string $page
    * @return void
    */
    public function update(string $ip, string $page): void
    {
        $this->db->update([
            'ip_address' => $ip,
            'page_url' => $page
        ], [
            'views_count' => ['views_count + 1'],
            'view_date' => Helper::date()
        ]);
    }
}