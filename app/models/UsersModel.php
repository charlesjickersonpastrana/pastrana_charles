<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: UsersModel
 * 
 * Automatically generated via CLI.
 */
class UsersModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // 🔹 Get user by ID
    public function get_user_by_id($id)
    {
        return $this->db->table($this->table)
                        ->where('id', $id)
                        ->get();
    }

    // 🔹 Get user by username
    public function get_user_by_username($username)
    {
        return $this->db->table($this->table)
                        ->where('username', $username)
                        ->get();
    }

    // 🔹 Insert new user (used for registration)
    public function insert_user($data)
    {
        return $this->db->table($this->table)->insert($data);
    }

    // 🔹 Update password (with hashing)
    public function update_password($user_id, $new_password)
    {
        return $this->db->table($this->table)
                        ->where('id', $user_id)
                        ->update([
                            'password' => password_hash($new_password, PASSWORD_DEFAULT)
                        ]);
    }

    // 🔹 Get all users
    public function get_all_users()
    {
        return $this->db->table($this->table)->get_all();
    }

    // 🔹 Get currently logged-in user from session
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

    // 🔹 Search and paginate users
    public function page($q = '', $records_per_page = null, $page = null)
    {
        if (is_null($page)) {
            return $this->db->table($this->table)->get_all();
        } else {
            $query = $this->db->table($this->table);

            // Search filters
            $query->like('id', '%'.$q.'%')
                  ->or_like('username', '%'.$q.'%')
                  ->or_like('email', '%'.$q.'%')
                  ->or_like('role', '%'.$q.'%');

            // Get total count
            $countQuery = clone $query;
            $data['total_rows'] = $countQuery->select_count('*', 'count')->get()['count'];

            // Get records with pagination
            $data['records'] = $query->pagination($records_per_page, $page)->get_all();

            return $data;
        }
    }
}
