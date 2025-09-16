<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class UsersController extends Controller {
    public function __construct()
    {
        parent::__construct();
        $this->call->model('UsersModel');
    }

    
    public function index(): void
    {
        $data = $this->UsersModel->all();
            $this->call->view('users/index', ['users' => $data]);
    }

    
    public function create(): void
    {
        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');

            $data = [
                'username' => $username,
                'email' => $email
            ];

            if ($this->UsersModel->insert($data)) {
                header("Location: ");
                exit;
            } else {
                echo "Error in inserting data.";
            }
        } else {
            $this->call->view('users/create');
        }
    }

    
    public function update($id): void
    {
        $user = $this->UsersModel->find($id);
        if (!$user) {
            die("User not found");
        }

        if ($this->io->method() == 'post') {
            $username = $this->io->post('username');
            $email = $this->io->post('email');

            $data = [
                'username' => $username,
                'email' => $email
            ];

            if ($this->UsersModel->update($id, $data)) {
                header("Location: ");
                exit;
            } else {
                echo "Error in updating data.";
            }
        } else {
            $data['user'] = $user;
            $this->call->view('users/update', $data);
        }
    }

    
    public function delete($id): void
    {
        if ($this->UsersModel->delete($id)) {
            header("Location: ");
            exit;
        } else {
            echo "Error in deleting data.";
        }
    }
}
