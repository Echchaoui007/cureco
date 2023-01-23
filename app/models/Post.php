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

    
     $this->db->query('INSERT INTO `items`( `name_product`, `quantite_product`, `price_product`, `img_product`)  VALUES (:name, :quantite, :prix ,:image) ');
        $this->db->bind(":name", $data['name_product']);
        $this->db->bind(":quantite", $data['quantite_product']);
        $this->db->bind(":prix", $data['price_product']);
        $this->db->bind(":image", $data['img_product']);


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
    $image = ($data['img_product']) ? ',`img_product`= :image' : '';
    $this->db->query(' UPDATE `items` SET `name_product`= :name,`quantite_product`= :quantite,`price_product`=:prix'. $image .' WHERE `id_product`= :id_product');
    $this->db->bind(':id_product', $data['id_product']);
    $this->db->bind(':name', $data['name_product']);
    $this->db->bind(':quantite', $data['quantite_product']);
    $this->db->bind(':prix', $data['price_product']);
    if ($data['img_product']) {
        $this->db->bind(':image', $data['img_product']);
    }

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
    public function getStats(){

        $this->db->query('SELECT * FROM items');
        $row1=$this->db->resultSet();
        $stats['tot']=count($row1);

        $this->db->query('SELECT MIN(price_product) as min FROM items');
        $row2=$this->db->single();
        $stats['min']=$row2;

        $this->db->query('SELECT MAX(price_product) as max FROM items');
        $row3=$this->db->single();
        $stats['max']=$row3;

        return $stats;

    }

}