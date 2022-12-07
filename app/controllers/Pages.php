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
 * Pages class
 * Class Pages
 *
 * @category PHP
 * @package  Controllers
 * @author   Fabiano Oliveira <fabiano.one@gmail.com>
 * @license  GNU http://opensource.org/licenses/gpl-license.php
 * @link     https://github.com/fabianoone
 */
class Pages extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }

    /**
     * Main function
     *
     * @return void
     */
    public function index()
    {
        $data = [
            'title' => 'Welcome'
        ];
        $this->view('pages/index', $data);
    }

    /**
     * About method
     *
     * @return void
     */
    public function about()
    {
        $data = ['title' => 'About'];
        $this->view('pages/about', $data);
    }
}
