

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
  <div class="container">
    <a class="navbar-brand" href="index.php">El detalle perfecto </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="oi oi-menu"></span> Menu
    </button>

    <div class="collapse navbar-collapse" id="ftco-nav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
        <!--
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tienda</a>
          <div class="dropdown-menu" aria-labelledby="dropdown04">
            <a class="dropdown-item" href="shop.html">Revisar Productos</a>
            <a class="dropdown-item" href="cart.html">Carrito</a>
          </div>
        </li>-->
        <?php
          $cantidad=0;
          if (isset($_SESSION['articulos'])) {
              $cantidad=count($_SESSION['articulos']);
          }
         ?>
        <li class="nav-item"><a href="mesas.php" class="nav-link">Buscar mesas</a></li>
        <li class="nav-item"><a href="productos_lista.php" class="nav-link">Regalos</a></li>
        <li class="nav-item"><a href="productos.php" class="nav-link">Regalos mas solicitados</a></li>
        <li class="nav-item"><a href="registro_cliente.php" class="nav-link">Registro</a></li>

        <li class="nav-item"><a href="login.php" class="nav-link">Iniciar Sesion</a></li>
        <li class="nav-item cta cta-colored"><a href="carrito.php" class="nav-link"><span class="icon-shopping_cart"></span>[<?=$cantidad?>]</a></li>

      </ul>
    </div>
  </div>
</nav>
