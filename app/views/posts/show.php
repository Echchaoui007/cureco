<?php require APPROOT . '/views/inc/header.php'; ?>


<a href="<?php echo URLROOT; ?>/posts/dashboard" class="btn btn-light"><i class="fa fa-backward">Back</i></a>



<div class="container">
    <h1>Product Dashboard</h1>
    <form method="post" action="<?php  echo URLROOT; ?>/posts/edit/<?php echo $data['product']->id_product ?>" enctype="multipart/form-data">
    
        <div class="form-group">
            <label for="productName">Product Name:<sup>*<sup></label>
            <input type="text" name="prod_name" id="productName" class="form-control " value="<?php echo $data['product']->name_product ?>">

        </div>
        <div class="form-group">
            <label for="productQuantity">Product Quantity:<sup>*<sup></label>
            <input min="1" type="number" name="quantite" id="productQuantity" class="form-control " value="<?php echo $data['product']->quantite_product ?>" required>
        </div>

        <div class="form-group">
            <label for="productPrice">Product Price:<sup>*<sup></label>
            <input required min="0" type="number" name="price" class="form-control" id="productPrice" value="<?php echo $data['product']->price_product ?>">
        </div>

        <div class="form-group">
            <label for="productDescription">Image:<sup>*<sup></label>
            <input  type="file" name="img" class="form-control" id="productDescription" accept="image/png, image/jpeg, image/jpg" value="<?php echo $data['product']->img_product ?>" ></input>
        </div>
       
        <input type="submit"  class="btn btn-success">
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>