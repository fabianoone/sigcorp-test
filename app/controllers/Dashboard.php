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
 * Dashboard class
 
 *
 * @category PHP
 * @package  Controllers
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */
class Dashboard extends Controller 
{
	/**
     * Constructor
     */
    public function __construct()
    {
		if (!isLoggedIn()) {
			redirect('users/login');
		}

		// Load necessary models
    }

    /**
     * Default method
     *
     * @return void
     */
    public function index()
    {
		$data = [
			'title' => 'Dashboard',
			'description' => 'Admin panel'
		];
		
		$this->view('dashboard/index', $data);
	}
}