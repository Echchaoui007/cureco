<?php require APPROOT . '/views/inc/header.php'; ?>










<div class="container d-flex gap-3 mb-3 flex-wrap">
<div class="card-body">
  <div class="h3 font-weight-bold mb-0 mr-3"><span class="d-block">Total product:</span><?= $data['stats']['tot'] ?></div>
</div>
<div class="card-body">
  <div class="h3 font-weight-bold mb-0 mr-3"><span class="d-block">Total product:</span><?= $data['stats']['min']->min ?></div>
  </div>
  
  <div class="card-body">
  <div class="h3 font-weight-bold mb-0 mr-3"><span class="d-block">Total product:</span><?= $data['stats']['max']->max ?></div>
  </div>
</div>
<div class="container">
  <h1>Product Dashboard</h1>
  <form id="form" method="post" action="<?php echo URLROOT; ?>/posts/add" enctype="multipart/form-data">
    <div id="addInputs">
      <div class="form-group">
        <label for="productName">Product Name:<sup>*<sup></label>
        <input type="text" name="prod_name[]" id="productName" class="form-control ">

      </div>
      <div class="form-group">
        <label for="productQuantity">Product Quantity:<sup>*<sup></label>
        <input min="1" type="number" name="quantite[]" id="productQuantity" class="form-control">
      </div>

      <div class="form-group">
        <label for="productPrice">Product Price:<sup>*<sup></label>
        <input min="0" type="number" name="price[]" class="form-control" id="productPrice">
      </div>

      <div class="form-group">
        <label for="productDescription">Image:<sup>*<sup></label>
        <input type="file" name="img[]" class="form-control" id="productDescription" accept="image/png, image/jpeg, image/jpg"></input>
      </div>


    </div>
    <div>
      <button type="submit" value="submit" class="btn btn-success">Add</button>
      <button id="addNew" type="button" value="submit" class="btn btn-success">Add New</button>

    </div>
</div>
</form>
<br>
<h2>Added Products</h2>
<form class="d-flex mx-auto w-75 mt-5 mb-3" action="<?php echo URLROOT ?>/posts/search" method="post">
  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_name">
  <button class="btn btn-outline-success" type="submit">Search</button>
</form>
<table class="table table-striped">
  <thead>
    <a href='<?php echo URLROOT; ?>/posts/sortByPriceAsc' class="btn btn-warning btn-sm mr-2">Price Asc</a>
    <a href='<?php echo URLROOT; ?>/posts/sortByPriceDesc' class="btn btn-warning btn-sm">Price Desc</a>
    <tr>
      <th>ID</th>
      <th>Product Name</th>
      <th>Product Price</th>
      <th>Product Quantity</th>
      <th>Product Image</th>
    </tr>
  </thead>
  <tbody id="product-list">
    <?php foreach ($data['allItems'] as $zedka) : ?>
      <tr>
        <td><?= $zedka->id_product ?></td>
        <td><?= $zedka->name_product ?></td>
        <td><?= $zedka->quantite_product ?></td>
        <td><?= $zedka->price_product ?></td>
        <td><img src="<?= URLROOT . '/img/upload/' . $zedka->img_product ?>" width="50px" style="style=" width:128px;height:128px;object-fit: contain;""></td>
        <td>
          <a href='<?php echo URLROOT . "/posts/show/" . $zedka->id_product ?>' class="btn btn-warning btn-sm">Edit</a>
          <a href='<?php echo URLROOT . "/posts/delete/" . $zedka->id_product ?>' class="btn btn-danger btn-sm">Delete</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<script src="<?php echo URLROOT; ?>./js/diplicat.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php require APPROOT . '/views/inc/footer.php'; ?>