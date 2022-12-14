<?php


class Products extends Controller
{
    /**
     * @var void
     */
    private $productModel;

    /**
     * Constructor
     */
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->productModel = $this->model('Product');
    }

    public function index()
    {
        $page = 1;
        $limit = 20;
        $totalProducts = $this->productModel->countId()[0]->id;
        $pages = ceil($totalProducts / $limit );

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['limit-records'])) {
            $limit = $_POST['limit-records'];
        }

        // Pagination
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['page'])) {
            $page = isset($_GET['page']) ? $_GET['page'] : $page;
        }

        $start = ($page - 1) * $limit;
        $data = [
            'title' => 'Products',
            'description' => '',
            'pages' => $pages,
            'previous' => $page - 1,
            'next' => $page + 1,
            'products' => $this->productModel->getProducts($start, $limit)
        ];
        $this->view('products/index', $data);
    }

    /**
     * Register Product
     *
     * @return void
     */
    public function create()
    {
        // check for $_POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Process the form
            // Sanitize Post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init Data
            $data = [
                'code' => trim($_POST['code']),
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'price' => trim($_POST['price']),
                'active' => trim($_POST['active']),
                'code_err' => '',
                'title_err' => '',
                'description_err' => '',
                'price_err' => ''
            ];

            // validate Code
            if (empty($data['code'])) {
                $data['code_err'] = 'Please enter product code';
            }

            // validate title
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter product title';
            }

            // validate description
            if (empty($data['description'])) {
                $data['description_err'] = 'Please enter product description';
            }

            // validate price
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter product price';
            }

            // validate active
            if (empty($data['active'])) {
                $data['active'] = 0;
            } else {
                $data['active'] = 1;
            }

            // Make sure errors are empty
            if (empty($data['code_err'])
                && empty($data['title_err'])
                && empty($data['description_err'])
                && empty($data['price_err'])
            ) {
                // Validated

                // Register the Product
                if ($this->productModel->createProduct($data)) {
                    flash('register_success', 'Product registered successfully');
                    redirect('products/index');
                } else {
                    die('Something went wrong.');
                }
            } else {
                // Load view with errors
                $this->view('products/', $data);
            }
        } else {
            // Init data
            $data = [
                'code' => '',
                'title' => '',
                'description' => '',
                'price' => '',
                'active' => '',
                'code_err' => '',
                'title_err' => '',
                'description_err' => '',
                'price_err' => ''
            ];

            // Load view
            $this->view('products/', $data);
        }
    }

    public function show($id)
    {

        $data = [
            'title' => 'Product',
            'description' => 'Product description',
            'product' => $this->productModel->getProductById($id)
        ];
        $this->view('products/show', $data);
    }

    public function edit($id)
    {
        $product = $this->productModel->getProductById($id);
        $data = [
            'title' => 'Product',
            'description' => 'Editing product',
            'product' => $product
        ];
        $this->view('products/edit', $data);
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
                'title' => trim($_POST['title']),
                'code' => trim($_POST['code']),
                'price' => trim($_POST['price']),
                'active' => trim($_POST['active']),
                'description' => trim($_POST['description']),
                'id_err' => '',
                'title_err' => '',
                'code_err' => '',
                'price_err' => '',
                'description_err' => '',
            ];

            // Validate Id
            if (empty($data['id'])) {
                $data['id_err'] = 'Product id is empty';
            }

            // Validate Title
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            // validate code
            if (empty($data['code'])) {
                $data['code_err'] = 'Please enter a valid code';
            }

            // Validate Price
            if (empty($data['price'])) {
                $data['price_err'] = 'Please enter a price';
            }

            // Validate description
            if (empty($data['description'])) {
                $data['description_err'] = 'Please enter a description';
            }


            // Make sure errors are empty
            if (empty($data['id_err'])
                && empty($data['title_err'])
                && empty($data['code_err'])
                && empty($data['price_err'])
                && empty($data['description_err'])
            ) {
                // Validated
                // Update the Product

                if ($this->productModel->updateProduct($data)) {
                    flash('update_success', 'Product updated successfully');
                    redirect('products');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('products/edit/'.$data['id'], $data);
            }
        } else {
            // Init data
            $data = [
                'id' => '',
                'title' => '',
                'code' => '',
                'price' => '',
                'active' => '',
                'description' => '',
                'id_err' => '',
                'title_err' => '',
                'code_err' => '',
                'price_err' => '',
                'description_err' => '',
            ];

            // Load view
            $this->view('products/edit/'.$data['id'], $data);
        }
    }

    public function delete($id)
    {
        // Get existing product from model
        $product = $this->productModel->getProductById($id);

        //Check product
        if ($product->id) {
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                if($this->productModel->deleteProduct($product->id)){
                    flash('product_message', 'Product Removed.');
                    redirect('products');
                }else{
                    die('Something went wrong.');
                }
            }else{
                redirect('products');
            }
        }
    }
}