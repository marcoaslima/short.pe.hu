<!DOCTYPE html>
<html lang="pt" ng-app="shortApp">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Short.Pe.Hu - Encurtador de Links</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('public/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{ asset('public/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('public/vendor/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="{{ asset('public/css/landing-page.min.css') }}" rel="stylesheet">
   <!--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">-->

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-light bg-light static-top">
      <div class="container">
        <a class="navbar-brand" href="#">short.pe.hu</a>
        <a class="btn btn-primary" href="#">Entrar</a>
      </div>
    </nav>

    <!-- Masthead -->
    <header class="masthead text-white text-center" ng-controller="LinkController">
        <input type="hidden" name="base_url" id="base_url" value="{{ url('/') }}">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-xl-9 mx-auto">
            <h1 class="mb-5">Encurte seu link com apenas um clique e gere leads!</h1>
          </div>
          <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
            <form method="GET" ng-submit="shortMyLink()">
              <div class="form-row">
                <div class="col-12 col-md-9 mb-2 mb-md-0">
                  <input type="text" class="form-control form-control-lg" ng-model="mylink.url" placeholder="Link a encurtar">
                </div>
                <div class="col-12 col-md-3">
                  <button type="submit" class="btn btn-block btn-lg btn-primary"><i class="fa fa-circle-o-notch fa-spin" ng-show="loading"></i>&nbsp;Encurtar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal" tabindex="-1" role="dialog"  id="modalLink" name="modalLink">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="color: #323232;">Encurtador de Links</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" value="http://short.pe.hu/<%mylink.hash%>" readonly="1">

              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button">Copiar</button>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>
        </div>
      </div>
    </div>

    </header>

    <!-- Footer -->
    <footer class="footer bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
            <ul class="list-inline mb-2">
              <li class="list-inline-item">
                <a href="https://mdquest.com.br">Sobre</a>
              </li>
              <li class="list-inline-item">&sdot;</li>
              <li class="list-inline-item">
                <a href="https://mdquest.com.br">Contato</a>
              </li>
            </ul>
            <p class="text-muted small mb-4 mb-lg-0">&copy; MDQuest 2018. Todos os direitos reservados.</p>
          </div>
          <div class="col-lg-6 h-100 text-center text-lg-right my-auto">
            <ul class="list-inline mb-0">
              <li class="list-inline-item mr-3">
                <a href="#">
                  <i class="fa fa-facebook fa-2x fa-fw"></i>
                </a>
              </li>
              <li class="list-inline-item mr-3">
                <a href="#">
                  <i class="fa fa-github fa-2x fa-fw"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-linkedin fa-2x fa-fw"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script type="text/javascript">
        angular.module("shortApp", []);

        var base_url = $("#base_url").val();

        angular.module('shortApp').config(function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
        });

        angular.module('shortApp').controller("LinkController", function($scope, $http, $window){
            $scope.mylink = {}; 
            $scope.loading = "";

            $scope.shortMyLink = function()
            {
                $scope.loading = true; 
                var json_url = base_url + "/ajax/link/generate?url=" + $scope.mylink.url;
                $http.get(json_url).success(function($data){
                  $scope.mylink = $data;
                  $scope.mylink.url = "";
                  $scope.loading = false;
                  $("#modalLink").modal("show");
                }); 
            };
        });
    </script>

  </body>

</html>
