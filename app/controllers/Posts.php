<?php
class Posts extends Controller
{
    private $postModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('post');
    }

    public function index()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('post');
    }

    public function dashboard()
    {
        //get posts
        $posts = $this->postModel->getProducts();
        $stats = $this->postModel->getStats();
        
        $data = [
            'allItems' => $posts,
            'stats' => $stats
        ];

        // load view with data 
        $this->view('posts/dashboard', $data);
    }

    public function Add()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            for ($i = 0; $i < count($_POST['prod_name']); $i++) {


                $img_name = $_FILES['img']['name'][$i];
                $img_tmp = $_FILES['img']['tmp_name'][$i];
                move_uploaded_file($img_tmp, 'img/upload/' . $img_name);

            

                $data = [
                    'name_product' => trim($_POST['prod_name'][$i]),
                    'quantite_product' => trim($_POST['quantite'][$i]),
                    'price_product' =>  trim($_POST['price'][$i]),
                    'img_product' => $img_name,
                 

                ];

                $this->postModel->addProducts($data);

            }
            redirect('posts/dashboard');
            
        }
    }

    public function edit($id)
    {

        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $image = $_FILES['img'] ?? false;
            if ($image) {
                $img_name = $image['name'];
                $img_tmp = $image['tmp_name'];
                move_uploaded_file($img_tmp, 'img/upload/' . $img_name);
            }

            $data = [
                'id_product' => $id,
                'name_product' => trim($_POST['prod_name']),
                'quantite_product' => trim($_POST['quantite']),
                'price_product' =>  trim($_POST['price']),
                'img_product' => $img_name,
                'name_product_err' => '',
                'quantite_product_err' => '',
                'price_product_err' => '',
                'img_product_err' => '',
            ];

            // Validate data
            if (empty($data['name_product'])) {
                $data['name_product_err'] = 'Please enter Name';
            }
            if (empty($data['quantite_product'])) {
                $data['quantite_product_err'] = 'Please enter Quantite';
            }
            if (empty($data['price_product'])) {
                $data['price_product_err'] = 'Please enter Price';
            }

            //make sure no errors
            if (empty($data['name_product_err']) && empty($data['quantite_product_err']) && empty($data['price_product_err']) && empty($data['img_product_err'])) {
                // die(var_dump($data));
                if ($this->postModel->updateProducts($data)) {
                    redirect("posts/dashboard");
                } else {
                    //load the view with errors
                    $this->view('posts/dashboard', $data);
                }
            } else {
                // die(var_dump($data));
                //get existing post from model
                $post = $this->postModel->getProductById($id);
                $data = [
                    'name_product' => '',
                    'quantite_product' => '',
                    'price_product' =>  '',
                    'img_product' => '',
                    'name_product_err' => '',
                    'quantite_product_err' => '',
                    'price_product_err' => '',
                    'img_product_err' => '',
                ];

            redirect('posts/dashboard');
            }
        }
    }

    public function show($id)
    {
        $post = $this->postModel->getProductById($id);

        $data = [
            'product' => $post
        ];
        $this->view('posts/show', $data);
    }



    public function delete($id)
    {

        if ($this->postModel->deleteProduct($id)) {
            redirect('posts/dashboard');
        } else {
            redirect('posts/dashboard');
        }
    }








    public function sortByPriceAsc()
    {

        if ($this->postModel->sortByPriceASC()) {

            $products = $this->postModel->sortByPriceASC();
            $stats = $this->postModel->getStats();
            $data = [
                'allItems' => $products,
                'stats' => $stats
            ];

            $this->view('posts/dashboard', $data);
        }
    }

    public function sortByPriceDesc()
    {

        if ($this->postModel->sortByPriceDESC()) {

            $products = $this->postModel->sortByPriceDESC();
            $stats = $this->postModel->getStats();
            $data = [
                'allItems' => $products,
                'stats' => $stats
            ];

            $this->view('posts/dashboard', $data);
        }
    }



    public function search()
    {



        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, 513);

            $searchName = trim($_POST['search_name']);
            $products = $this->postModel->searchInProducts($searchName);
            $stats = $this->postModel->getStats();
            
            if ($products) {

                $data = [
                    'allItems' => $products,
                    'stats' => $stats
                ];
                $this->view('posts/dashboard', $data);
            } else {
                redirect('posts/dashboard');
            }
        }
    }
}
