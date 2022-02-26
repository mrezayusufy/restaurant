<?php
session_start();
include '../rms.php';
$url = "http://" . $_SERVER["HTTP_HOST"];
?>
<!DOCTYPE html>
<html lang="en">
<title>Pospoint</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
  <link rel="stylesheet" href="<?= $url ?>/css/sb-admin-2.min.css">
  <link rel="stylesheet" href="<?= $url ?>/posapp/reyu.css">
  <link rel="stylesheet" href="<?= $url ?>/vendor/fontawesome-free/css/all.min.css">
  <script src="<?= $url ?>/js/angular.min.js"></script>
  <style>
    body::-webkit-scrollbar {
      width: 1em !important;
    }

    body::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3) !important;
    }

    body::-webkit-scrollbar-thumb {
      background-color: darkgrey !important;
      outline: 1px solid slategrey !important;
    }
  </style>
</head>

<body>
  <main ng-app="app" ng-controller="controller" ng-init="fetchProducts(); fetchCategories(); fetchTables(); setCategory(); setPage(); fetchCart(); page = 1" class="d-flex bg-black text-light">
    <!-- left side -->
    <section class="grid column g-columns g-rows col-2 align-items-center h-100vh w-75 screen" style="--c: 1fr; --r: 100px calc(100vh - 150px) 50px;">
      <div class="mt-3 text-center">
        <div class="h3 m-0">{{ date | date: 'hh:mm a' }}</div>
        <div class="fs-s ">{{ date | date: 'dd MMM yyyy' }}</div>
        <!-- logo -->
        <h4 class="pb-2 m-0"><i class="fa fas fa-utensils"></i></h4>
      </div>
      <!-- categories -->
      <div class="d-flex flex-column justify-content-center gap align-content-center gap w-100 overflow-auto">
        <div style="height: calc(100vh - 150px);" class="d-flex flex-column gap">
          <button class=" text-capitalize p-1 btn btn-outline-light w-100 rounded-pill" ng-repeat="c in categories" ng-class="{'btn-light text-black' : c.category_name === category}" ng-click="setCategory(c.category_name)">
            {{c.category_name}}
          </button>
        </div>
        <div class="d-none flex-column gap align-items-center mt-3">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" id="category_page">Page</span>
            </div>
            <input list="category-pages" ng-model="page" onfocus="this.value=''" onchange="this.blur()" ng-change="setPage(page);" id="category-page" name="category-page" aria-describedby="category_page" class="form-control" />
            <datalist id="category-pages">
              <option ng-repeat="a in range(total_category_page) track by $index">{{$index + 1}}</option>
            </datalist>
          </div>
          <div class="d-flex flex-row gap">
            <button class="btn btn-outline-light btn-circle" ng-disabled="page <= 1" ng-click="pageDown()"><i class="fas fa-arrow-down"></i></button>
            <button class="btn btn-outline-light btn-circle" ng-disabled="page == total_category_page" ng-click="pageUp()"><i class="fas fa-arrow-up"></i></button>
          </div>
        </div>
      </div>
      <!-- admin and logout btn  -->
      <div class="d-flex row justify-content-between mt-auto mb-2">
        <a class="btn text-light rounded-pill h5 m-0" href="<?= $url ?>/"><i class="fas fa-user"></i> Admin</a>
        <button class="btn text-light rounded-pill h5 m-0" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-power-off"></i> Logout</butt>
      </div>
    </section>
    <!-- middle section -->
    <section class="col-7 p-0 bg-black grid column screen g-columns g-rows" style="--c: 1fr;--r: 110px calc(100vh - 150px) 50px;">
      <!-- tables -->
      <div class="just d-flex flex-column p-3 gap">
        <div class="row gap align-items-baseline">
          <div ng-repeat="t in tables">
            <div ng-class="{'bg-gradient-dark' : t.status === 'Enable'}" ng-click="setTable(t)" class="card border-0 text-dark text-center shadow-md">
              <div class="card-body p-1" ng-class="{'text-light' : t.status === 'Enable'}">
                <div class="card-title m-0 text-capitalize">
                  <h6 class="m-0">{{t.name}}</h6>
                </div>
                <div class="fs-s"> {{t.capacity}} </div>
              </div>
            </div>
          </div>
        </div>
        <!-- pagination -->
        <section class="justify-content-center d-flex">
          <nav aria-label="Page navigation mt-3">
            <ul class="m-0 overflow-hidden pagination rounded-pill">
              <li class="page-item"><a class="page-link border-0 fs-s" href="#"><i class="fas fa-chevron-left"></i></a></li>
              <li class="page-item"><a class="page-link border-0 fs-s" href="#">1</a></li>
              <li class="page-item"><a class="page-link border-0 fs-s" href="#">2</a></li>
              <li class="page-item"><a class="page-link border-0 fs-s" href="#">3</a></li>
              <li class="page-item"><a class="page-link border-0 fs-s" href="#"><i class="fas fa-chevron-right"></i></a></li>
            </ul>
          </nav>
        </section>
      </div>
      <section class="d-flex flex-column bg-white h-auto rounded">
        <!-- category name -->
        <h2 class="text-center text-black text-capitalize m-0">{{category}}</h2>
        <!-- products -->
        <section class="align-items-baseline d-flex flex-row px-3 py-3 gap flex-wrap overflow-auto h-auto">
          <div class="col-3 p-0" ng-repeat="p in products">
            <div class="card border-0 text-white text-center bg-gradient-dark shadow-md ">
              <div class="card-body px-2 py-3">
                <div class="card-title font-weight-bold">
                  <h5>{{p.product_name}}</h5>
                </div>
                <h1 class="align-content-center align-items-center border border-gray d-flex justify-content-center m-auto rounded-pill square"><i class="fas fa-utensils"></i></h1>
                <div class="d-flex flex-row justify-content-between align-items-center mt-1">
                  <div class="font-weight-light">Price: € {{p.product_price}}</div>
                  <button class="btn btn-outline-light btn-circle" ng-click="addToCart(p);"><i class="fas fa-plus"></i></button>
                </div>
              </div>
            </div>
          </div>
        </section>
      </section>
      <!-- buttons  -->
      <section class="align-items-baseline d-flex flex-row my-2 gap mt-auto justify-content-center">
        <button class="btn btn-outline-light rounded-pill">Cash Drawer</button>
        <button class="btn btn-outline-light rounded-pill">Customers</button>
        <button class="btn btn-outline-light rounded-pill">Subtotal</button>
        <button class="btn btn-outline-light rounded-pill">Take out</button>
        <button class="btn btn-outline-light rounded-pill">PLU</button>
        <button class="btn btn-outline-light rounded-pill">More</button>
      </section>
    </section>
    <section class="col-3 w-100 h-auto pt-3 p-0 screen">
      <!-- cart -->
      <div class="zigzag text-black rounded d-flex flex-column py-3 mx-3 gap" style="--g:5px;">
        <!-- title -->
        <div class="px-3 border-bottom">
          <h5 class="m-0">{{table.name}}</h5>
        </div>
        <!-- cart -->
        <div class="px-3 border-bottom h overflow-auto" style="--h: calc(100vh - 450px);">
          <div class="grid g-columns column justify-content-between text-black border-bottom" ng-repeat="c in cart">
            <div class="text-black">
              <div class="fs-s strong">{{c.product_name}}</div>
              <div class="fs-s">Price: <strong>€ {{c.product_price}}</strong></div>
            </div>
            <div class="text-right fs-s">{{c.product_quantity}}</div>
            <div class="text-left pl-3 fs-s">€ {{c.product_price * 1}}</div>
          </div>
        </div>
        <!-- subtotal -->
        <div class="px-3 border-bottom">
          <div class="grid g-columns column justify-content-between text-black" style="--c: 4fr 1fr;">
            <h6 class="font-weight-bold m-0">Subtotal:</h6>
            <div class="text-left pl-1">€ {{setTotal()}}</div>
          </div>
          <div class="grid g-columns column justify-content-between text-black" style="--c: 4fr 1fr;">
            <h6 class="m-0">Tax:</h6>
            <div class="text-left pl-1">€ {{tax}}</div>
          </div>
        </div>
        <!-- total -->
        <div class="px-3 border-bottom">
          <div class="grid g-columns column justify-content-between text-black" style="--c: 4fr 1fr;">
            <h6 class="m-0">Total:</h6>
            <div class="text-left pl-1">€ {{tax + setTotal()}}</div>
          </div>
        </div>
        <!-- checkout -->
        <div class="px-3 d-flex flex-row gap justify-content-center">
          <button class="btn btn-dark rounded-pill">Checkout</button>
          <button class="btn btn-outline-secondary btn-circle" ng-click="removeItem();"><i class="fas fa-times text-danger"></i></button>
          <a onclick="window.print()" class="btn btn-outline-secondary btn-circle"><i class="fas fa-print"></i></a>
        </div>
      </div>
      <div class="d-flex flex-row py-2 px-3 gap">
        <div class="btn btn-outline-light grow-3 rounded-pill">Different Pay</div>
        <div class="btn btn-outline-light px-3 btn-circle">€</div>
      </div>
      <div class="grid column g-columns g-rows gap mx-4 align-items-center justify-content-center calc" style="--c: 40px 40px 40px 40px;">
        <button class="btn btn-outline-light btn-circle n0">0</button>
        <button class="btn btn-outline-light btn-circle c">c</button>
        <button class="btn btn-outline-light btn-circle p" ng-click="numberDisplay('.')">.</button>
        <button class="btn btn-outline-light btn-circle n1" ng-click="numberDisplay(1)">1</button>
        <button class="btn btn-outline-light btn-circle n2" ng-click="numberDisplay(2)">2</button>
        <button class="btn btn-outline-light btn-circle n3" ng-click="numberDisplay(3)">3</button>
        <button class="btn btn-outline-light btn-circle n4" ng-click="numberDisplay(4)">4</button>
        <button class="btn btn-outline-light btn-circle n5" ng-click="numberDisplay(5)">5</button>
        <button class="btn btn-outline-light btn-circle n6" ng-click="numberDisplay(6)">6</button>
        <button class="btn btn-outline-light btn-circle n7" ng-click="numberDisplay(7)">7</button>
        <button class="btn btn-outline-light btn-circle n8" ng-click="numberDisplay(8)">8</button>
        <button class="btn btn-outline-light btn-circle n9" ng-click="numberDisplay(9)">9</button>
        <button class="btn btn-outline-light btn-circle n9" ng-click="numberDisplay(9)">9</button>
        <button class="btn btn-outline-light btn-circle n9" ng-click="numberDisplay(9)">9</button>
      </div>
    </section> <!-- end cart -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content text-dark">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-black" href="<?= $url ?>/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <div class="print">
      <div class="text-black ">
        <div class="d-flex flex-column justify-content-center pt-2">
          <h2 class="text-center font-weight-bold m-0">Restaurant</h2>
          <h6 class="text-center">main street 1</h6>
          <h6 class="text-center">90210 Weldone</h6>
          <h6 class="text-center">Tax No:: 124563443</h6>
          <h6 class="text-center">+1 234 567 890</h6>
          <h6 class="text-center">office@restaurant.com</h6>
        </div>
        <div class="d-flex flex-column justify-content-end mt-2">
          <h6 class="font-weight-bold mx-2">Reciept No: 17-200-000056</h6>
          <h6 class="mx-2">{{date | date: 'dd.MM.yyyy'}}</h6>
          <h6 class="mx-2">{{table.name}}</h6>
          <hr class="w-100 bg-black my-1">
          <div>
            <div class="d-flex flex-column mx-2 border-bottom" ng-repeat="c in cart">
              <h6>{{c.product_name}}</h6>
              <div class="d-flex flex-row justify-content-between">
                <h6>{{c.product_quantity}}x €{{c.product_price}}</h6>
                <h6>€{{c.product_quantity * c.product_price}}</h6>
              </div>
            </div>
          </div>
          <hr class="w-100 bg-black my-1">
          <div class="">
            <h6 class="mx-2">items count: 2</h6>
            <div class="my-2">
              <div class="d-flex flex-row justify-content-between mx-2">
                <h6>Subtotal:</h6>
                <h6>{{setTotal()}}</h6>
              </div>
              <div class="d-flex flex-row justify-content-between mx-2">
                <h6>Tax:</h6>
                <h6>€{{tax}}</h6>
              </div>
            </div>
            <div class="d-flex flex-row justify-content-between mx-2 h5 font-weight-bold">
              <p>Total:</p>
              <p>€{{setTotal() + tax}}</p>
            </div>
            <div class="d-flex flex-row justify-content-between mx-2">
              <h6>Paid:</h6>
              <h6>€{{setTotal() + tax}}</h6>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="<?= $url ?>/js/angular.min.js"></script>
  <script src="<?= $url ?>/vendor/jquery/jquery.min.js"></script>
  <script src="<?= $url ?>/posapp/posapp.js"></script>
  <script src="<?= $url ?>/js/sb-admin-2.min.js"></script>
  <script src="<?= $url ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>

  </script>
</body>

</html>