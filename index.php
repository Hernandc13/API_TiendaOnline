<?php require_once "config/conexion.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Subitus Online</title>
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/css/estilos.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./Plugins/BootstrapFileInput/css/fileinput.min.css">
</head>

<body>
    <a href="#" class="btn-flotante" id="btnCarrito">Carrito <span class="badge bg-success" id="carrito">0</span></a>
    <!-- Header-->
    <header id="header" class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Subitus Online</h1>
                <p class="lead fw-normal text-white-50 mb-0"> Compra ahora</p>
            </div>
        </div>
    </header>
    <!-- Navigation-->
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="navbar-brand" href="#">Crear Producto</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <a href="#" class="nav-link text-info" category="all">Todo</a>
                        <?php
                        $query = mysqli_query($conexion, "SELECT * FROM categoria");
                        while ($data = mysqli_fetch_assoc($query)) { ?>
                            <a href="#" class="nav-link" category="<?php echo $data['nombre']; ?>">
                                <?php echo $data['nombre']; ?></a>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <section class="py-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $query = mysqli_query($conexion, "SELECT p.*, c.id AS id_cat, c.nombre FROM producto p INNER JOIN categoria c ON c.id = p.id_categoria");
                $result = mysqli_num_rows($query);
                if ($result > 0) {
                    while ($data = mysqli_fetch_assoc($query)) { ?>
                        <div class="col mb-5 productos" id="productos" category="<?php echo $data['nombre']; ?>">
                            <div class="card h-100">
                                <!-- Imagen del Producto-->
                                <?php echo '<img width="200px"  src="data:image/jpeg;base64,' . base64_encode($data["Foto"]) . ' "  />'; ?>
                                <!-- Produto detalle-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Nombre del Producto-->
                                        <h5 class="fw-bolder"><?php echo $data['Nombre'] ?></h5>
                                        <p><?php echo $data['Descripcion']; ?></p>
                                        <!-- Precio del producto-->
                                        <label style="color: blue;"><?php echo "$" . $data['Precio']; ?></label>
                                    </div>
                                </div>
                                <!-- Agregar el producto al carrito-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto agregar" data-id="<?php echo $data['Id']; ?>" href="#">Agregar</a></div>
                                </div>
                            </div>
                        </div>
                <?php  }
                } ?>
            </div>
        </div>
    </section>
    <!-- Modal para ingreso de un nuevo producto -->
    <div class="modal fade header" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div id="registro" class="modal-content">
                <div class="modal-header">
                    <center>
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registro de Productos</h1>
                    </center>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="RegistroP.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label style="font-size:14px;" class="control-label">Seleccione la imagen del Producto</label>
                            <input style="font-size:16px;" id="input-b1" name="Foto" type="file" class="file" data-browse-on-zone-click="true" accept="*" data-validation="required" data-validation-error-msg="Debe agregar una imagen">
                        </div>
                        <div class="form-floating mb-3">
                            <input name="txtnombre" type="text" class="form-control" id="floatingInput" placeholder="Nombre del Producto">
                            <label for="floatingInput">Nombre del Producto</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="txtdescripcion" type="text" class="form-control" id="floatingInput" placeholder="Descripción del Producto">
                            <label for="floatingInput">Descripción del Producto</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="txtprecio" type="number" step="any" class="form-control" id="floatingInput" placeholder="$">
                            <label for="floatingInput">Precio</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input name="txtexistencia" type="number" class="form-control" id="floatingInput" placeholder="Existencia">
                            <label for="floatingInput">Existencia del Producto</label>
                        </div>

                        <div class="form-floating">
                            <select name="txtcategoria" class="form-select" id="floatingSelect" aria-label="Seleccione una Categoria">
                                <option value="0">Seleccione una Categoria</option>
                                <?php
                                $query = mysqli_query($conexion, "SELECT * FROM categoria");
                                $result = mysqli_num_rows($query);
                                while ($data = mysqli_fetch_assoc($query)) {
                                    echo '<option value="' . $data[id] . '">' . $data[nombre] . '</option>';
                                }
                                ?>
                            </select>
                            <label for="floatingSelect">Seleccione una Categoria</label>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer-->
    <footer id="header" class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Subitus 2022</p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="./Plugins/BootstrapFileInput/js/fileinput.min.js"></script>
</body>

</html>