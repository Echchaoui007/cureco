<?php
class Pages extends Controller
{
  private $postModel;
  public function __construct()
  {

    $this->postModel = $this->model('post');
  }

  public function index()
  {
    $data = [
      'title' => 'CureCo',
    ];

    $this->view('pages/index', $data);
  }

  public function gallery()
  {
    //get posts
    $posts = $this->postModel->getProducts();

    $data = [
      'allItems' => $posts
    ];

    // load view with data 
    $this->view('pages/gallery', $data);
  }

  

 
}
