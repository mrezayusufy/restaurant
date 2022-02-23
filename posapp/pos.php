<!DOCTYPE html>
<html>
<title>Pospoint</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html, body, h1, h2, h3, h4, h5 {font-family: "Open Sans", sans-serif}
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
  background-color: #000;
  color: white;
  border: 1px solid #4CAF50;
}
footer {
  text-align: center;
  padding: 3px;
  background-color: DarkSalmon;
  color: white;
  padding-bottom: 0%;
}
.pagination a:hover:not(.active) {background-color: #ddd;}
</style>
<body class="w3-theme-l5">



<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 3</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>

<!-- Page Container -->
<div class="w3-container">    
  <!-- The Grid -->
  <div class="w3-row w3-left">
    <!-- Left Column -->
    <div class="w3-col ">
      <!-- Profile -->
      <div class="w3-card  w3-white">
       
      
         <h1 class="w3-center" ><?php echo date("h:i"); ?></h1>
        
         <hr>
         <h3 class="w3-bar-item w3-button w3-hover-black w3-center" href="javascript:void(0)" onclick="openMenu(event, 'FAMILY');">FAMILY MENU</h3>
  <hr>

  <h3 class="w3-bar-item w3-button w3-hover-black w3-center" href="javascript:void(0)" onclick="openMenu(event, 'FRIED');">FRIED CHICKEN</h3>
  <hr>


  <h3 class="w3-bar-item w3-button w3-hover-black w3-center" href="javascript:void(0)" onclick="openMenu(event, 'BRUGERS');">BRUGERS</h3>
  <hr>

  <h3 class="w3-bar-item w3-button w3-hover-black w3-center" href="javascript:void(0)" onclick="openMenu(event, 'WOK');">WOK</h3>
  <hr>

  <h3 class="w3-bar-item w3-button w3-hover-black w3-center" href="javascript:void(0)" onclick="openMenu(event, 'FRIETEN');">FRIETEN</h3>
  <hr>
  <div class="w3-container">
        <h3  class="w3-bar-item w3-button w3-hover-black w3-center" href="/logout.php" class="btn">Logout</h3>
        <hr>
        <p>Admin</p>
        <p>Pospoint </p>
        
        </div>
      </div>
      <br>
      
      <!-- Accordion -->

      <br>
      
      <!-- Interests --> 
      <div class="w3-card w3-round w3-white w3-hide-small">
        
        </div>
      </div>
      <br>
      
     
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="w3-col m7">
    
      <div class="w3-row-padding">
        <div class="w3-col m12">
        <a href="javascript:void(0)" onclick="openMenu(event, 'FAMILY');" id="myLink">
        <div class="w3-col s6 tablink"></div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'FRIED');">
        <div class="w3-col s6 tablink"></div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'BRUGERS');">
        <div class="w3-col s6 tablink"></div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'WOK');">
        <div class="w3-col s6 tablink"></div>
      </a>
      <a href="javascript:void(0)" onclick="openMenu(event, 'FRIETEN');">
        <div class="w3-col s6 tablink"></div>
      </a>
      
          <div class="w3-card w3-round w3-white">
            <div class="w3-container w3-padding w3-center">
             
            <img src=https://th.bing.com/th/id/R.c665b134b6bd00297090cf062bdb1f85?rik=Zos18vzjEAHheQ&riu=http%3a%2f%2fwww.pngall.com%2fwp-content%2fuploads%2f2016%2f04%2fTable-PNG-Image.png&ehk=TvH%2fDJImHRlqDdlAHeBdBcYDFX1NIkqbgrKmth08D8w%3d&risl=&pid=ImgRaw&r=0" style="width: 150px; height:100px;text-align:center;"/>
            <div class="center" style="text-align: center;">
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
          </div>
        </div>
      </div>
      <div ng-app="shoppingCart" ng-controller="shoppingCartController" ng-init="loadProduct(); fetchCart();">
      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
      <div id="BRUGERS" class="menu" style="width:100%;">
    <h1>BRUGERS</h1>
		<form method="post">
				<div class="row">
					<div class="col-md-3" style="margin-top:12px;" ng-repeat = "product in products">
						<div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; " align="center">
						
							<h4 class="text-info">{{product.name}}</h4>
							<h4 class="text-danger">{{product.price}}</h4>
							<input type="button" name="add_to_cart" style="margin-top:5px;" class="btn btn-primary form-control" value="+" ng-click="addtoCart(product)" />
						</div>
					</div>
				</div>
			</form>
		</div>
      
      </div>
      
      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <footer class="w3-container w3-theme-d3 w3-padding-16">
         <h5>Footer</h5>
        </footer>
      </div>  

   
    <!-- End Middle Column -->
    </div>
</div>
    
    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Upcoming Events:</p>
          <img src="/w3images/forest.jpg" alt="Forest" style="width:100%;">
          <p><strong>Holiday</strong></p>
          <p>Friday 15:00</p>
          <p><button class="w3-button w3-block w3-theme-l4">Info</button></p>
        </div>
      </div>
      <br>
      
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p>Friend Request</p>
          <img src="/w3images/avatar6.png" alt="Avatar" style="width:50%"><br>
          <span>Jane Doe</span>
          <div class="w3-row w3-opacity">
            <div class="w3-half">
              <button class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button>
            </div>
            <div class="w3-half">
              <button class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
            </div>
          </div>
        </div>
      </div>
      <br>
      
 
      
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->

<script>

var app = angular.module('shoppingCart', []);

app.controller('shoppingCartController', function($scope, $http){
	
	$scope.loadProduct = function(){
		$http.get('fetch.php').success(function(data){
            $scope.products = data;
        })
	};
	
	$scope.carts = [];
	
	$scope.fetchCart = function(){
		$http.get('fetch_cart.php').success(function(data){
            $scope.carts = data;
        })
	};
	
	$scope.setTotals = function(){
		var total = 0;
		for(var count = 0; count<$scope.carts.length; count++)
		{
			var item = $scope.carts[count];
			total = total + (item.product_quantity * item.product_price);
		}
		return total;
	};
	
	$scope.addtoCart = function(product){
		$http({
            method:"POST",
            url:"add_item.php",
            data:product
        }).success(function(data){
			$scope.fetchCart();
        });
	};
	
	$scope.removeItem = function(id){
		$http({
            method:"POST",
            url:"remove_item.php",
            data:id
        }).success(function(data){
			$scope.fetchCart();
        });
	};
	
});

</script>
 
<script>
// Tabbed Menu
function openMenu(evt, menuName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("menu");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" w3-dark-grey", "");
  }
  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-dark-grey";
}
document.getElementById("myLink").click();
</script>

 
<script>
// Accordion
function myFunction(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme-d1";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme-d1", "");
  }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else { 
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html> 
