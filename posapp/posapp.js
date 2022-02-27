'use strict'
var app = angular.module("app", []);
const hostname = window.location.hostname;
const protocol = window.location.protocol + "//";
const url = protocol + hostname;
app.controller("controller", function ($scope, $http) {
  $scope.operator = ["+", "-", "*", "/"];
  $scope.firstVal = "";
  $scope.secondVal = "";
  $scope.currentOperator = "";
  $scope.result = "";
  $scope.paid = "";
  $scope.numberDisplay = function (num) {
    $scope.paid += num;
  }
  
  function activeFlag() {
    falg = true;
  }

  $scope.clear = function () {
    $scope.paid = "";
  };
  $scope.cart = [];
  $scope.date = new Date();
  $scope.total_category_page = 1;
  $scope.counter = 1;
  $scope.products = [];
  $scope.categories = [];
  $scope.tables = [];
  $scope.table = null;
  $scope.tax = "2.0";
  $scope.url = url;
  // fetch tax product
  $scope.fetchTaxProduct = function () {
    $http
      .get(`${$scope.url}/tax_action.php?action=tax_name&name=Product`)
      .then(function (data) {
        var tax = parseFloat(data.data.percentage);
        $scope.tax = tax;
      });
  };
  $scope.fetchProducts = function (category) {
    var c = category ? "&category=" + category : "";
    $http
      .get($scope.url + "/product_action.php?action=products" + c)
      .then(function (data) {
        $scope.products = data.data.data;
      });
  };
  // fetch category by pagination
  // set category to fetch product by category
  $scope.category = null;

  $scope.categoryPage = null;
  $scope.setCategory = function (category) {
    if (category) {
      $scope.category = category;
      $scope.fetchProducts(category);
    } else {
      $scope.category = "Menus";
    }
  };
  $scope.skip = 7;
  $scope.page = 1;
  $scope.fetchCategories = function (page) {
    $http
      .get(`${$scope.url}/category_action.php?action=categories`)
      .then(function (data) {
        $scope.categories = data.data.data;
        $scope.total_category_page = data.data.total_page;
      });
  };
  $scope.pageDown = function () {
    if ($scope.page > 0) {
      $scope.page = $scope.page - 1;
      $scope.fetchCategories($scope.page);
    }
  };
  $scope.pageUp = function () {
    if ($scope.page > 0) {
      $scope.page = $scope.page + 1;
      $scope.fetchCategories($scope.page);
    }
  };
  $scope.setPage = function (page) {
    $scope.page = page ? page : 1;
    $scope.fetchCategories($scope.page);
  };
  // fetch tables
  $scope.fetchTables = function () {
    $http
      .get($scope.url + "/table_action.php?action=tables&page=1&skip=10")
      .then(function (data) {
        $scope.tables = data.data.data;
      });
  };
  $scope.fetchCart = function () {
    $http.get(`${$scope.url}/posapp/fetch_cart.php`).then(function (data) {
      $scope.cart = data.data;
    });
  };
  $scope.setTable = function (table) {
    $scope.table = table;
  };
  $scope.setTotal = function () {
    // Subtotal+(subtotal*tax%)/100
    return $scope.setSubtotal() + ($scope.setSubtotal() * $scope.tax) / 100;
  }
  $scope.setSubtotal = function () {
    var total = 0;
    for (var count = 0; count < $scope.cart.length; count++) {
      var item = $scope.cart[count];
      total = total + item.product_quantity * item.product_price;
    }
    return total;
  };

  $scope.addToCart = function (product) {
    $http({
      method: "POST",
      url: $scope.url + "/posapp/add_item.php",
      data: product,
    }).then(function (data) {
      $scope.fetchCart();
    });
  };

  $scope.removeItem = function (id) {
    $http({
      method: "POST",
      url: "remove_item.php",
      data: id,
    }).then(function (data) {
      $scope.fetchCart();
    });
  };
  $scope.range = function (n) {
    return new Array(n);
  };
  // end
});