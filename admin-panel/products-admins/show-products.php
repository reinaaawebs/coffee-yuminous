<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>



<?php 

    if(!isset($_SESSION['admin_name'])) {
      header("location: ".ADMINURL."/admins/login-admins.php");
    }

    $products = $conn->query("SELECT * FROM products");
    $products->execute();

    $allProducts = $products->fetchAll(PDO::FETCH_OBJ);


?>

          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Products</h5>
              <a  href="create-products.php" class="btn btn-primary mb-4 text-center float-right">Insert Products</a>

              <table class="table">
                <thead>
                  <tr>
            
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Type</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($allProducts as $product) : ?>
                    <tr>
                 
                      <td><?php echo $product->name; ?></td>
                      <td><img src="images/<?php echo $product->image; ?>" style="width: 100px; height:100px;"></td>
                      <td>$<?php echo $product->price ?></td>
                      <td><?php echo $product->type ?></td>
                      <td><a href="delete-products.php?id=<?php echo $product->id; ?>" class="btn btn-danger  text-center ">Delete</a></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>               
<?php require "../layouts/footer.php"; ?>