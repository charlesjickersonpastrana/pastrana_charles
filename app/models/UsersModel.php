<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UsersModel
 * 
 * Automatically generated via CLI.
 */
class UsersModel extends Model {
    protected $table = 'users'; // ✅ Fixed: plural
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // ✅ Get user by ID
    public function get_user_by_id($id)
    {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->get();
    }

    // ✅ Get user by username
    public function get_user_by_username($username)
    {
        return $this->db->table($this->table)
                        ->where('username', $username)
                        ->get();
    }

    // ✅ Update user password
    public function update_password($user_id, $new_password)
    {
        return $this->db->table($this->table)
                        ->where('id', $user_id)
                        ->update([
                            'password' => password_hash($new_password, PASSWORD_DEFAULT)
                        ]);
    }

    // ✅ Get all users
    public function get_all_user()
    {
        return $this->db->table($this->table)->get_all();
    }

    // ✅ Get logged-in user (from session)
    public function get_logged_in_user()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['user']['id'])) {
            return $this->get_user_by_id($_SESSION['user']['id']);
        }

        return null;
    }

    // ✅ Pagination & search
    public function page($q = '', $records_per_page = null, $page = null)
    {
        if (is_null($page)) {
            // ✅ Return all users if page not provided
            return $this->db->table('users')->get_all();
        } else {
            // ✅ Use the correct table name here
            $query = $this->db->table('users');

            // Add search filters
            $query->like('id', '%'.$q.'%')
                ->or_like('username', '%'.$q.'%')
                ->or_like('email', '%'.$q.'%')
                ->or_like('role', '%'.$q.'%');
            
            // Clone query for counting total
            $countQuery = clone $query;

            $data['total_rows'] = $countQuery->select_count('*', 'count')
                                            ->get()['count'];

            // Apply pagination
            $data['records'] = $query->pagination($records_per_page, $page)
                                    ->get_all();

            return $data;
        }
    }
}
