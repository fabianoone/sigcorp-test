<?php

/**
 * Determine what response to send back in a request
 * PHP version 7
 *
 * @category PHP
 * @package  Controllers
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */

/**
 * Users class
 *
 * @category PHP
 * @package  Controllers
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */
class Users extends Controller 
{
    /**
     * @var void
     */
    private $userModel;

    /**
	 * Constructor method
	 */
	public function __construct()
	{
		$this->userModel = $this->model('User');
	}

	/**
	 * Register Method
	 * Load Register form
	 * Process USER form method
	 * 
	 * @return void
	 */
	public function register()
	{
		// check for $_POST
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// Process the form
			// Sanitize Post data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

			// Init Data
			$data = [
				'name' => trim($_POST['name']),
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'confirm_password' => trim($_POST['confirm_password']),
				'name_err' => '',
				'email_err' => '',
				'password_err' => '',
				'confirm_password_err' => '',
			];

			// validate Email
			if (empty($data['email'])) {
				$data['email_err'] = 'Please enter email';
			} else {
				// Check email
				if ($this->userModel->findUserByEmail($data['email'])) {
					$data['email_err'] = 'Email is already taken';
				}
			}

			// Validate Name
			if (empty($data['name'])) {
				$data['name_err'] = 'Please enter name';
			}

			// Validate Password
			if (empty($data['password'])) {
				$data['password_err'] = 'Please enter password';
			} elseif (strlen($data['password']) < 6) {
				$data['password_err'] = 'Password must be at least 6 characters';
			}

			// Make sure errors are empty
			if (empty($data['email_err'])
				&& empty($data['name_err'])
				&& empty($data['password_err'])
				&& empty($data['confirm_password_err'])
			) {
				// Validated

				// Hash Password
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

				// Register the User
				if ($this->userModel->register($data)) {
					flash('register_success', 'You are registered and can log in');
					redirect('users/login');
				} else {
					die('Something went wrong.');
				}
			} else {
				// Load view with errors
				$this->view('users/register', $data);
			}
		} else {
			// Init data
			$data = [
				'name' => '',
				'email' => '',
				'password' => '',
				'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
			];

			// Load view
			$this->view('users/register', $data);
		}
	}

	/**
	 * Login Method
	 * Load Post Login form
	 * Process POST Login form method
	 * 
	 * @return void
	 */
	public function login()
	{
		// check for POST
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			// check for POSTS
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				// Process form
				// Sanitize POST data
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

				// Init data
				$data = [
					'email' => trim($_POST['email']),
					'password' => trim($_POST['password']),
					'email_err' => trim(''),
					'password_err' => trim(''),
				];

				// Validate Email
				if (empty($data['password'])) {
					$data['password_err'] = 'Please enter password';
				}

				// Check for user/email
				if ($this->userModel->findUserByEmail($data['email'])) {
					// User found
				} else {
					$data['email_err'] = 'No user found';
				}

				// Make sure errors are empty
				if (empty($data['email_err']) && empty($data['password_err'])) {
					// Validated!
					$loggedInUser = $this->userModel->login($data['email'], $data['password']);

					if ($loggedInUser) {
						// Create Session
						$this->createUserSession($loggedInUser);
					} else {
						$data['password_err'] = 'Password incorrect';

						$this->view('users/login', $data);
					}
				} else {
					// Init data
					$data = [
						'email' => '',
						'password' => '',
						'email_err' => '',
						'password_err' => ''
					];

					// Load view
					$this->view('users/login', $data);
				}
			}
		} else {
			$data = [
				'email' => '',
				'password' => '',
				'email_err' => '',
				'password_err' => ''
			];

			// Load view
			$this->view('users/login', $data);
		}
	}

	/**
	 * Logout function
	 * 
	 * @return void
	 */
	public function logout()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_name']);
		session_destroy();
		redirect('users/login');
	}

	/**
	 * Create user session
	 * 
	 * @param mixed $user
	 * 
	 * @return void
	 */
	public function createUserSession($user)
	{
		$_SESSION['user_id'] = $user->id;
		$_SESSION['user_email'] = $user->email;
		$_SESSION['user_name'] = $user->name;
		redirect('dashboard');
	}
}