<?php 
class post {
    private $db;
public function __construct(){
    $this->db = new Database;
}

public function getProducts(){
$this->db->query('SELECT * FROM items');  

$results = $this->db->resultSet();

return $results;
}


public function  addProducts($data){

    
     $this->db->query('INSERT INTO `items`( `name_product`, `quantite_product`, `price_product`, `img_product`)  VALUES (:name, :quantite, :prix ,:image) , (:name1, :quantite1, :prix1 ,:image1)');
        $this->db->bind(":name", $data['name_product']);
        $this->db->bind(":quantite", $data['quantite_product']);
        $this->db->bind(":prix", $data['price_product']);
        $this->db->bind(":image", $data['img_product']);

        $this->db->bind(":name1", $data['name_product1']);
        $this->db->bind(":quantite1", $data['quantite_product1']);
        $this->db->bind(":prix1", $data['price_product1']);
        $this->db->bind(":image1", $data['img_product1']);
       

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

}

public function getProductById($id){
$this->db->query('SELECT * FROM items WHERE id_product =:id');
$this->db->bind(':id', $id);
$row = $this->db->single();
return $row;
}


public function deleteProduct($id_product){
    $this->db->query('DELETE FROM `items`  WHERE `id_product`= :id_product');
    $this->db->bind(':id_product', $id_product);
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
   }

   public function updateProducts($data){
    $this->db->query(' UPDATE `items` SET `name_product`= :name,`quantite_product`= :quantite,`price_product`=:prix,`img_product`= :image WHERE `id_product`= :id_product');
    $this->db->bind(':id_product', $data['id_product']);
    $this->db->bind(':name', $data['name_product']);
    $this->db->bind(':quantite', $data['quantite_product']);
    $this->db->bind(':prix', $data['price_product']);
    $this->db->bind(':image', $data['img_product']);

    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}
public function sortByPriceASC()
    {
        $this->db->query('SELECT * FROM items ORDER BY price_product ASC');
        if ($this->db->resultSet()) {
            return $this->db->resultSet();
        } else {
            return false;
        }
    }

    public function sortByPriceDESC()
    {
        $this->db->query('SELECT * FROM items ORDER BY price_product DESC');
        if ($this->db->resultSet()) {
            return $this->db->resultSet();
        } else {
            return false;
        }
    }

    public function searchInProducts($name)
    {
        $this->db->query('SELECT * FROM items WHERE name_product LIKE "%" :name "%"');
        $this->db->bind(':name', $name);

        if ($this->db->resultSet()) {
            return $this->db->resultSet();
        } else {
            return false;
        }
    }
}