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
        $data = [
            'allItems' => $posts
        ];

        // load view with data 
        $this->view('posts/dashboard', $data);
    }

    public function Add()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $img_name = $_FILES['img']['name'];
            $img_tmp = $_FILES['img']['tmp_name'];
            move_uploaded_file($img_tmp, 'img/upload/' . $img_name);

            $img_name1 = $_FILES['img1']['name'];
            $img_tmp1 = $_FILES['img1']['tmp_name'];
            move_uploaded_file($img_tmp1, 'img/upload/' . $img_name1);

            $data = [
                'name_product' => trim($_POST['prod_name']),
                'quantite_product' => trim($_POST['quantite']),
                'price_product' =>  trim($_POST['price']),
                'img_product' => $img_name,
                'name_product_err' => '',
                'quantite_product_err' => '',
                'price_product_err' => '',
                'img_product_err' => '',
                'name_product1' => trim($_POST['prod_name1']),
                'quantite_product1' => trim($_POST['quantite1']),
                'price_product1' =>  trim($_POST['price1']),
                'img_product1' => $img_name1,
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
            if (empty($data['img_product'])) {
                $data['img_product_err'] = 'Please enter Image';
            }
            //make sure no errors
            if (empty($data['name_product_err']) && empty($data['quantite_product_err']) && empty($data['price_product_err']) && empty($data['img_product_err'])) {
                if ($this->postModel->addProducts($data)) {
                    redirect("posts/dashboard");
                } else {
                    //load the view with errors
                    $this->view('posts/dashboard', $data);
                }
            } else {
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

                $this->view('posts/dashboard', $data);
            }
        }
    }

    public function edit($id)
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $img_name = $_FILES['img']['name'];
            $img_tmp = $_FILES['img']['tmp_name'];
            move_uploaded_file($img_tmp, 'img/upload/' . $img_name);

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
            if (empty($data['img_product'])) {
                $data['img_product_err'] = 'Please enter Image';
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

                $this->view('posts/dashboard', $data);
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
            $data = [
                'allItems' => $products
            ];

            $this->view('posts/dashboard', $data);
        }
    }

    public function sortByPriceDesc()
    {

        if ($this->postModel->sortByPriceDESC()) {

            $products = $this->postModel->sortByPriceDESC();
            $data = [
                'allItems' => $products
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

            if ($this->postModel->searchInProducts($searchName)) {
                $products = $this->postModel->searchInProducts($searchName);

                $data = [
                    'allItems' => $products,
                ];
                $this->view('posts/dashboard', $data);
            } else {
                $this->view('posts/dashboard');
            }
        }
    }
}
