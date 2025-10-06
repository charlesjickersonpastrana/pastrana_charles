<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Library: Auth
 */
class Auth {
    protected $_lava;

    public function __construct()
    {
        // Initialize Lava instance and required libraries
        $this->_lava = lava_instance();
        $this->_lava->call->database();
        $this->_lava->call->library('session');
    }

    /*
     * ✅ Register a new user (uses correct 'users' table)
     */
    public function register($username, $email, $password, $role = 'user')
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        return $this->_lava->db->table('users')->insert([
            'username'   => $username,
            'email'      => $email,
            'password'   => $hash,
            'role'       => $role,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /*
     * ✅ Login user (handles array result + correct table)
     */
    public function login($username, $password)
    {
        // Fetch user by username from correct table
        $user = $this->_lava->db->table('users')
                         ->where('username', $username)
                         ->get();

        // If no user found
        if (!$user) {
            return false;
        }

        // If query returns an array of rows, use the first one
        if (isset($user[0])) {
            $user = $user[0];
        }

        // Verify password hash
        if (password_verify($password, $user['password'])) {
            // Save session data
            $this->_lava->session->set_userdata([
                'id'        => $user['id'],
                'username'  => $user['username'],
                'role'      => $user['role'],
                'logged_in' => true
            ]);
            return true;
        }

        // Password did not match
        return false;
    }

    /*
     * ✅ Check if user is logged in
     */
    public function is_logged_in()
    {
        return (bool) $this->_lava->session->userdata('logged_in');
    }

    /*
     * ✅ Check user role
     */
    public function has_role($role)
    {
        return $this->_lava->session->userdata('role') === $role;
    }

    /*
     * ✅ Logout user
     */
    public function logout()
    {
        $this->_lava->session->unset_userdata(['id', 'username', 'role', 'logged_in']);
    }
}
