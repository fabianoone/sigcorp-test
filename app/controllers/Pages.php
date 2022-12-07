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
            'title' => 'Sigcorp Teste',
			'description' => 'Teste para candidatos à vaga de Desenvolvedor PHP'
        ];
        $this->view('pages/index', $data);
    }

	public function clients()
    {
		$data = [
			'title' => 'Clients',
			'description' => ''
		];
		$this->view('clients/index', $data);
	}
	
	public function orders()
    {
		$data = [
			'title' => 'Orders',
			'description' => ''
		];
		$this->view('orders/index', $data);
	}
}
