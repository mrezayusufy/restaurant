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

<style>
    .left-side-menu{
        
        background: #fff;
        color: #000;
        width: 15%;
        height: 70%;
        position: fixed;
        display: block;
   
        padding-left: 0%;
        text-align: center;
        margin: 0;
        border-radius: 5px;
        border: 3px solid #fff;
        box-shadow: 0px 0px 5px #000;
    }
  
    .side-menu{
        
        background: #fff;
        color: #fff;
        width: 15%;
        height: 15%;
       
      
        padding-left: 0%;
        margin: 0;
        bottom: 0%;
       text-align: center;
    
    position:absolute;
    border-radius: 5px;
        border: 3px solid #fff;
        box-shadow: 0px 0px 5px #000;
    
    }
    .main-menu{
        
        background: #fff;
        color: #fff;
        margin-left: 20%;
        width: 80%;
        height: 100%;
        border-radius: 5px;
        border: 3px solid #fff;
        box-shadow: 0px 0px 5px #000;
        position: fixed;
        display: block;
      
      
    }
    .food-menu{
        background: #fff;
        color: #000;
        overflow-y: auto;
        text-align: center;
      
        margin-right: 20%;
        margin-top: 10%;
        width: 80%;
        height: 80%;
        border-radius: 5px;
        border: 3px solid #fff;
        box-shadow: 0px 0px 5px #000;
        
    position:absolute;
        display: block;
    }
    .table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 1px;
}



    .tables-menu{
        background: #fff;
        color: #fff;
      
        margin-right: 20%;

        width: 80%;
        height: 15%;
        border-radius: 5px;
        border: 3px solid #fff;
        box-shadow: 0px 0px 5px #000;
        
    position:absolute;
        display: block;
    }
    .left-menu-table{
        overflow-y: auto;
        text-align: center;
        width: 100%;
        height: 80%;
        color: #000;

    }
    .foods-menu-table{
        overflow-y: auto;
        text-align: center;
        width: 100%;
        height: 60%;
        color: #000;

    }
    .calculate-table{
        overflow-y: auto;
        text-align: center;
        width: 100%;
        height: 80%;
        color: #000;

    }

   .right-cal{
       background-color: #fff;
         width: 15%;
            height: 100%;
       
              float: right;
              padding-top: 0%;
              margin-top: 0%;
              margin-right:2%;
              border-radius: 5px;
        border: 3px solid #fff;
        box-shadow: 0px 0px 5px #000;
      
   }
   
   .bottom-menu{
    background-color: #fff;
    width: 80%;
    height: 5%;
    bottom: 0%;
    margin-right:20%;
    text-align: center;
    
    position:absolute;
    border-radius: 5px;
        border: 3px solid #fff;
        box-shadow: 0px 0px 5px #000;

   
   }
   ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  text-align: center;
    overflow: hidden;
    margin: auto;
}

.center {
  text-align: center;
}

.pagination {
  display: inline-block;
}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
  margin: 0 4px;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
  border: 1px solid #4CAF50;
}

.pagination a:hover:not(.active) {background-color: #ddd;}

.button {
  background-color: #ddd;
  border: none;
  color: black;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  cursor: pointer;
  border-radius: 16px;
}

.button:hover {
  background-color: #ff0;
}
.foods{
    background-color: #fff;
    width: 10%;
    height: 10%;
    margin-left: 10%;
    margin-top: 10%;
    border-radius: 5px;
    border: 3px solid #fff;
    box-shadow: 0px 0px 5px #000;
    position: absolute;
    display: block;
}
.grid-container {
  display: grid;
  grid-template-columns: auto auto auto auto;
  grid-gap: 10px;
  background-color: #2196F3;
  padding: 10px;
}

.grid-container > div {
  background-color: rgba(255, 255, 255, 0.8);
  text-align: center;
  padding: 20px 0;
  font-size: 30px;
}

</style>
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