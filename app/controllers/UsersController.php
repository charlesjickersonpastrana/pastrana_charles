<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Controller: UsersController
 * 
 * Enhanced version with authentication, role management,
 * pagination, and secure CRUD operations.
 */

class UsersController extends Controller {

    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
    {
        // ✅ Check login
        if (!isset($_SESSION['user'])) {
            redirect('/auth/login');
            exit;
        }

        $logged_in_user = $_SESSION['user']; 
        $data['logged_in_user'] = $logged_in_user;

        // ✅ If admin → show all users
        if ($logged_in_user['role'] === 'admin') {
            $page = 1;
            if (isset($_GET['page']) && !empty($_GET['page'])) {
                $page = $this->io->get('page');
            }

            $q = '';
            if (isset($_GET['q']) && !empty($_GET['q'])) {
                $q = trim($this->io->get('q'));
            }

            $records_per_page = 10;
            $users = $this->UsersModel->page($q, $records_per_page, $page);

            $data['users'] = $users['records'];
            $total_rows = $users['total_rows'];

            // Pagination
            $this->pagination->set_options([
                'first_link'     => '⏮ First',
                'last_link'      => 'Last ⏭',
                'next_link'      => 'Next →',
                'prev_link'      => '← Prev',
                'page_delimiter' => '&page='
            ]);
            $this->pagination->set_theme('custom');
            $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.$q);
            $data['page'] = $this->pagination->paginate();
        } 
        else {
            // ✅ If user → only show own profile
            $user = $this->UsersModel->get_user_by_id($logged_in_user['id']);
            $data['users'] = [$user];
            $data['page'] = '';
        }

        $this->call->view('users/index', $data);
    }

    public function create()
    {
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $password = password_hash($this->io->post('password'), PASSWORD_BCRYPT);
            $role = $this->io->post('role') ?? 'user';

            $data = [
                'username' => $username,
                'email'    => $email,
                'password' => $password,
                'role'     => $role,
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->UsersModel->insert($data)) {
                redirect('/users');
            } else {
                echo '❌ Failed to create user.';
            }
        } 
        else {
            $this->call->view('users/create');
        }
    }

    public function update($id)
    {
        $logged_in_user = $_SESSION['user'] ?? null;
        $user = $this->UsersModel->get_user_by_id($id);

        if (!$user) {
            echo "User not found.";
            return;
        }

        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');

            if (!empty($logged_in_user) && $logged_in_user['role'] === 'admin') {
                $role = $this->io->post('role');
                $password = $this->io->post('password');

                $data = [
                    'username' => $username,
                    'email'    => $email,
                    'role'     => $role
                ];

                if (!empty($password)) {
                    $data['password'] = password_hash($password, PASSWORD_BCRYPT);
                }
            } else {
                // Regular user can only update basic info
                $data = [
                    'username' => $username,
                    'email'    => $email
                ];
            }

            if ($this->UsersModel->update($id, $data)) {
                redirect('/users');
            } else {
                echo '❌ Failed to update user.';
            }
        } 
        else {
            $data['user'] = $user;
            $data['logged_in_user'] = $logged_in_user;
            $this->call->view('users/update', $data);
        }
    }

    public function delete($id)
    {
        if ($this->UsersModel->delete($id)) {
            redirect('/users');
        } else {
            echo '❌ Failed to delete user.';
        }
    }

    public function register()
    {
        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');
            $password = password_hash($this->io->post('password'), PASSWORD_BCRYPT);
            $role = 'user';

            $data = [
                'username' => $username,
                'email'    => $email,
                'password' => $password,
                'role'     => $role,
                'created_at' => date('Y-m-d H:i:s')
            ];

            if ($this->UsersModel->insert($data)) {
                redirect('/auth/login');
            }
        }

        $this->call->view('auth/register');
    }

    public function login()
    {
        $this->call->library('auth');
        $error = null;

        if ($this->io->method() === 'post') {
            $username = $this->io->post('username');
            $password = $this->io->post('password');

            $user = $this->UsersModel->get_user_by_username($username);

            if ($user) {
                if ($this->auth->login($username, $password)) {
                    $_SESSION['user'] = [
                        'id'       => $user['id'],
                        'username' => $user['username'],
                        'role'     => $user['role']
                    ];
                    redirect('/users');
                } else {
                    $error = "Incorrect password!";
                }
            } else {
                $error = "Username not found!";
            }
        }

        $this->call->view('auth/login', ['error' => $error]);
    }

    public function dashboard()
    {
        $page = 1;
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $this->io->get('page');
        }

        $q = '';
        if (isset($_GET['q']) && !empty($_GET['q'])) {
            $q = trim($this->io->get('q'));
        }

        $records_per_page = 10;
        $users = $this->UsersModel->page($q, $records_per_page, $page);

        $data['users'] = $users['records'];
        $total_rows = $users['total_rows'];

        $this->pagination->set_options([
            'first_link'     => '⏮ First',
            'last_link'      => 'Last ⏭',
            'next_link'      => 'Next →',
            'prev_link'      => '← Prev',
            'page_delimiter' => '&page='
        ]);
        $this->pagination->set_theme('bootstrap');
        $this->pagination->initialize($total_rows, $records_per_page, $page, 'users?q='.$q);
        $data['page'] = $this->pagination->paginate();

        $this->call->view('users/dashboard', $data);
    }

    public function logout()
    {
        $this->call->library('auth');
        $this->auth->logout();
        redirect('/auth/login');
    }
}
