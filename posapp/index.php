<?php
session_start();
include './header.php';
?>
<!DOCTYPE html>
<html lang="en">
<title>Pospoint</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
</head>
<body>
<div class="left-side-menu">
<h2><?php echo date("h:i"); ?></h2>
    
<ul class="left-menu-table">
    
  <li><b>Menu</b></li>
  <hr>

<?php
$servername = "localhost";
$username = "u559678163_pospointdbu";
$password = "!@#123qweasdZXC";
$dbname = "u559678163_pospointdb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT DISTINCT main_menu FROM products";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $m= $row['main_menu'];
    echo '<li><a href="/orderapp/order_app.php?m='.$row['main_menu'].'">'.$row['main_menu'].'</a></li>';
  }
} 

mysqli_close($conn);
?>
</ul>
           


</table>
    
</div>
<div class="side-menu">
<ul class="left-menu-table">

  <li><b>Admin</b></li>
 
  <hr>
 
  
  <li><a href="#about">Logout</a></li>
<hr>
<label>Pospoint</label>
</ul>
       
    
</div>

<div class="main-menu">
<div ng-app="shoppingCart" ng-controller="shoppingCartController" ng-init="loadProduct(); fetchCart();">
<div class="tables-menu">

                        <div class="center">
                        <img src=https://th.bing.com/th/id/R.c665b134b6bd00297090cf062bdb1f85?rik=Zos18vzjEAHheQ&riu=http%3a%2f%2fwww.pngall.com%2fwp-content%2fuploads%2f2016%2f04%2fTable-PNG-Image.png&ehk=TvH%2fDJImHRlqDdlAHeBdBcYDFX1NIkqbgrKmth08D8w%3d&risl=&pid=ImgRaw&r=0"
                                style="width: 150px; height:90px;text-align:center;" /><br>
                            <div class="pagination">
                                <a href="#">&laquo;</a>
                                <a href="#">1</a>
                                <a href="#" class="active">2</a>
                                <a href="#">3</a>
                                <a href="#">4</a>
                                <a href="#">5</a>
                                <a href="#">6</a>
                                <a href="#">&raquo;</a>
                            </div>
                        </div>
</div>
<div class="food-menu">

                        
                            <h1>BRUGERS</h1>
                            <form method="post">
                            
                                    <div class="foods-menu-table"  ng-repeat="product in products">
                                   

                                            <h4 >{{product.name}}</h4>
                                            <h4 >{{product.price}}</h4>
                                            <input type="button" name="add_to_cart" class="button" value="+" ng-click="addtoCart(product)" />
                                    </div>   
                            </form>
</div>

<div class="right-cal">
<table class="calculate-table">
    <thead class="">
      <tr>
       

        <th >Product</th>
         <th >Qty</th>
         <th >Price</th>
         <th >Total</th>
         <th >Action</th>
      </tr>
    </thead>
    <tbody>
    <tr ng-repeat="cart in carts">
                                <td>{{cart.product_name}}</td>
                                <td>{{cart.product_quantity}}</td>
                                <td>{{cart.product_price}}</td>
                                <td>{{cart.product_quantity * cart.product_price}}</td>
                                <td><button type="button" name="remove_product" class="btn btn-danger btn-xs"
                                        ng-click="removeItem(cart.product_id)">X</button></td>
                            </tr>
    </tbody> 
    <tfoot style="height:100px;text-align: center;overflow-y:auto">

<tr>
    <td>Total</td>
    <td>{{ setTotals() }}</td>
    
        
    
</tr>
</tfoot>
  </table>
                 
</div>

<div class="bottom-menu">

 <button class="button">Cash Drawer</button>
 <button class="button">Customers</button>
 <button class="button">History</button>
 <button class="button">Subtotal</button>
 <button class="button">Take Out</button>
 <button class="button">PLU</button>
 <button class="button">More...</button>

</div>
</div>
</div>

<script>
    var app = angular.module('shoppingCart', []);

    app.controller('shoppingCartController', function($scope, $http) {
        $scope.loadProduct = function() {
            $http.get('fetch.php?m=<?php  echo $_GET['m']; ?>').success(function(data) {
                $scope.products = data;
            })
        };

        $scope.carts = [];

        $scope.fetchCart = function() {
            $http.get('fetch_cart.php').success(function(data) {
                $scope.carts = data;
            })
        };

        $scope.setTotals = function() {
            var total = 0;
            for (var count = 0; count < $scope.carts.length; count++) {
                var item = $scope.carts[count];
                total = total + (item.product_quantity * item.product_price);
            }
            return total;
        };

        $scope.addtoCart = function(product) {
            $http({
                method: "POST",
                url: "add_item.php",
                data: product
            }).success(function(data) {
                $scope.fetchCart();
            });
        };

        $scope.removeItem = function(id) {
            $http({
                method: "POST",
                url: "remove_item.php",
                data: id
            }).success(function(data) {
                $scope.fetchCart();
            });
        };

    });
    </script>

   



</body>
</html>