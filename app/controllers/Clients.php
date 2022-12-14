<?php


class Clients extends Controller
{
    /**
     * @var void
     */
    private $clientModel;

    /**
     * Constructor
     */
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->clientModel = $this->model('Client');
    }

    public function index()
    {
        // Get Clients
        $clients = $this->clientModel->getClients();
        $data = [
            'title' => 'Clients',
            'description' => '',
            'clients' => $clients
        ];
        $this->view('clients/index', $data);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process the form
            // Sanitize Post data

            // Init Data
            $data = [
                'name' => trim($_POST['name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'status' => intval(trim($_POST['status'])),
                'name_err' => '',
                'last_name_err' => '',
                'email_err' => '',
                'phone_err' => '',
            ];

            // Validate Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            // validate Name
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter a email';
            } else {
                // check client by email
                if ($this->clientModel->findClientByEmail($data['email'])) {
                    $data['email_err'] = 'Email is already taken';
                }
            }

            // Validate Last Name
            if (empty($data['last_name'])) {
                $data['last_name_err'] = 'Please enter last name';
            }

            // Validate phone
            if (empty($data['phone'])) {
                $data['phone_err'] = 'Please enter phone';
            }

            // Make sure errors are empty
            if (empty($data['name_err'])
                && empty($data['last_name_err'])
                && empty($data['email_err'])
                && empty($data['phone_err'])
            ) {
                // Validated
                // Register the Client
                if ($this->clientModel->create($data)) {
                    flash('register_success', 'Client registered successfully');
                    redirect('clients');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('clients/create', $data);
            }
        } else {
            // Init data
            $data = [
                'name' => '',
                'last_name' => '',
                'email' => '',
                'phone' => '',
                'status' => '',
                'name_err' => '',
                'last_name_err' => '',
                'email_err' => '',
                'phone_err' => '',
            ];

            // Load view
            $this->view('clients/create', $data);
        }
    }

    public function edit($id)
    {
        $client = $this->clientModel->getClientById($id);
        $data = [
            'title' => 'Clients',
            'description' => 'Editing client',
            'client' => $client
        ];
        $this->view('clients/edit', $data);
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process the form
            // Sanitize Post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init Data
            $data = [
                'id' => trim($_POST['id']),
                'name' => trim($_POST['name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'status' => intval(trim($_POST['status'])),
                'id_err' => '',
                'name_err' => '',
                'last_name_err' => '',
                'email_err' => '',
                'phone_err' => '',
            ];

            // Validate Id
            if (empty($data['id'])) {
                $data['id_err'] = 'Client id is empty';
            }

            // Validate Name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }

            // validate Name
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter a email';
            } else {
                // check client by email
                $clientId = $this->clientModel->getClientById($data['id'])->id;

                if ($this->clientModel->findClientByEmail($data['email']) && $data['id'] != $clientId) {
                    $data['email_err'] = 'Email is already taken';
                }
            }

            // Validate Last Name
            if (empty($data['last_name'])) {
                $data['last_name_err'] = 'Please enter last name';
            }

            // Validate phone
            if (empty($data['phone'])) {
                $data['phone_err'] = 'Please enter phone';
            }

            // Make sure errors are empty
            if (empty($data['id_err'])
                && empty($data['name_err'])
                && empty($data['last_name_err'])
                && empty($data['email_err'])
                && empty($data['phone_err'])
            ) {
                // Validated
                // Register the Client
                if ($this->clientModel->updateClient($data)) {
                    flash('update_success', 'Client updated successfully');
                    redirect('clients');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('clients', $data);
            }
        } else {
            // Init data
            $data = [
                'name' => '',
                'last_name' => '',
                'email' => '',
                'phone' => '',
                'status' => '',
                'name_err' => '',
                'last_name_err' => '',
                'email_err' => '',
                'phone_err' => '',
            ];

            // Load view
            $this->view('clients', $data);
        }
    }

    public function show($id)
    {
        $data = [
            'title' => 'Client',
            'description' => 'Client description',
            'client' => $this->clientModel->getClientById($id)
        ];
        $this->view('clients/show', $data);
    }

    public function delete($id)
    {
        // Get existing client from model
        $client = $this->clientModel->getClientById($id);

        //Check client
        if ($client->id) {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($this->clientModel->deleteClient($client->id)){
                    flash('client_message', 'Client Removed.');
                    redirect('clients');
                }else{
                    die('Something went wrong.');
                }
            }else{
                redirect('clients');
            }
        }
    }
}