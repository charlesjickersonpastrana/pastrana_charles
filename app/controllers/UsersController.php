<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');
        $this->call->library('session');
    }

    // 🔹 Show Login Page
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($this->io->post('username'));
            $password = $this->io->post('password');

            // Get user by username
            $user = $this->UsersModel->get_user_by_username($username);

            if ($user) {
                // Verify password
                if (password_verify($password, $user['password'])) {
                    // Store user in session
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['role']
                    ];

                    // Redirect after login
                    redirect('users/dashboard');
                } else {
                    $data['error'] = 'Incorrect password.';
                }
            } else {
                $data['error'] = 'Username not found.';
            }

            // Load login view with error
            $this->call->view('auth/login', $data);
        } else {
            // GET: Show login page
            $this->call->view('auth/login');
        }
    }

    // 🔹 Logout
    public function logout()
    {
        session_destroy();
        redirect('auth/login');
    }

    // 🔹 Show Registration Page
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($this->io->post('username'));
            $email = trim($this->io->post('email'));
            $password = $this->io->post('password');
            $confirm_password = $this->io->post('confirm_password');

            // Validation
            if ($password !== $confirm_password) {
                $data['error'] = 'Passwords do not match.';
                return $this->call->view('auth/register', $data);
            }

            // Check if username already exists
            if ($this->UsersModel->get_user_by_username($username)) {
                $data['error'] = 'Username is already taken.';
                return $this->call->view('auth/register', $data);
            }

            // Prepare user data
            $data_user = [
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Insert into DB
            if ($this->UsersModel->insert_user($data_user)) {
                redirect('auth/login');
            } else {
                $data['error'] = 'Registration failed. Try again.';
                $this->call->view('auth/register', $data);
            }
        } else {
            $this->call->view('auth/register');
        }
    }

    // 🔹 Dashboard (only for logged-in users)
    public function dashboard()
    {
        if (!isset($_SESSION['user'])) {
            redirect('auth/login');
        }

        $data['user'] = $_SESSION['user'];
        $this->call->view('users/dashboard', $data);
    }

    // 🔹 Show All Users (Admin)
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            redirect('auth/login');
        }

        $data['users'] = $this->UsersModel->get_all_users();
        $this->call->view('users/index', $data);
    }

    // 🔹 Delete User (Admin)
    public function delete($id)
    {
        if (!isset($_SESSION['user'])) {
            redirect('auth/login');
        }

        $this->db->table('users')->where('id', $id)->delete();
        redirect('users/index');
    }
}
