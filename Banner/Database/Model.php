<?php

/**
 * @package Banner\Database\Model
 */

namespace Banner\Database;

use Banner\Provider;
use Banner\Helper;

class Model {
 
    public function __construct()
    {
        $this->db = Provider::get('DB');
        $this->db->setTable('users');
    }

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