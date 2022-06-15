<?php

    include("../template/header.php");

    //recepcionar en variables mi información obtenida
    $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
    $txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
    $txtTalle=(isset($_POST['txtTalle']))?$_POST['txtTalle']:"";
    $txtCateg=(isset($_POST["txtCateg"]))?$_POST["txtCateg"]:"";
    $txtDescr=(isset($_POST['txtDescr']))?$_POST['txtDescr']:"";
    $txtPrecio=(isset($_POST['txtPrecio']))?$_POST['txtPrecio']:"";
    $txtDesc=(isset($_POST["txtDesc"]))?$_POST["txtDesc"]:"";
    $unidades=(isset($_POST["unidades"]))?$_POST["unidades"]:"";
    $imagen=(isset($_FILES['imagen']['name']))?$_FILES['imagen']['name']:"";
    $action=(isset($_POST['action']))?$_POST['action']:"";

    //-------------------------------------
    //CONEXION A LA BASE DE DATOS
    /*
    $host="localhost";
    $db="mystoresite";
    $usuario="root";
    $contrasenia="";

        try {
            $conexion=new PDO("mysql:host=$host; dbname=$db", $usuario, $contrasenia);
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    */
    //-------------------------------------

include("../config/db.php");

    switch($action){
            case "Agregar":
                $sentenciaSQL = $conexion->prepare("INSERT INTO producto ( Nombre_Producto, Descripcion_Producto, ID_Categoria, Cant_Por_Unidad, Precio_Unitario, Talle, ID_Descuento, Foto) VALUES (:nameProduct,:descript,:categ,:cantidad,:priceProduct,:talle,:descuento,:imagen);");

                $sentenciaSQL->bindParam(':nameProduct',$txtNombre);
                $sentenciaSQL->bindParam(':descript',$txtDescr);
                $sentenciaSQL->bindParam(':categ',$txtCateg);
                $sentenciaSQL->bindParam(':cantidad',$unidades);
                $sentenciaSQL->bindParam(':priceProduct',$txtPrecio);
                $sentenciaSQL->bindParam(':talle',$txtTalle);
                $sentenciaSQL->bindParam(':descuento',$txtDesc);
                $fecha= new DateTime();
                $nombreArchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";
                $tmpImagen=$_FILES["imagen"]["tmp_name"];
                    if ($tmpImagen!=""){
                        move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
                    }
                $sentenciaSQL->bindParam(':imagen',$nombreArchivo);

                $sentenciaSQL->execute();

                header("Location:productos.php");
            break;

            case "Editar":

                $sentenciaSQL = $conexion->prepare("UPDATE producto SET Nombre_Producto=:nameProduct, Descripcion_Producto=:descript, ID_Categoria=:categ, Cant_Por_Unidad=:cantidad, Precio_Unitario=:priceProduct, Talle=:talle, ID_Descuento=:descuento WHERE ID_Producto=:idProd");
                //Hago la cosulta a la db
                $sentenciaSQL->bindParam(':nameProduct', $txtNombre);
                $sentenciaSQL->bindParam(':descript', $txtDescr);
                $sentenciaSQL->bindParam(':categ', $txtCateg);
                $sentenciaSQL->bindParam(':cantidad', $unidades);
                $sentenciaSQL->bindParam(':priceProduct', $txtPrecio);
                $sentenciaSQL->bindParam(':talle', $txtTalle);
                $sentenciaSQL->bindParam(':descuento', $txtDesc);

                $sentenciaSQL->bindParam(':idProd', $txtID);
                $sentenciaSQL->execute();
                //tiene algo?
                if ($imagen!="") {
                        //Modifico la imagen: renombro y obtengo nuevos archivos
                        $fecha= new DateTime();
                        $nombreArchivo=($imagen!="")?$fecha->getTimestamp()."_".$_FILES["imagen"]["name"]:"imagen.jpg";

                        $tmpImagen=$_FILES["imagen"]["tmp_name"];
                        move_uploaded_file($tmpImagen,"../../img/".$nombreArchivo);
                        //busco la anterior y
                        $sentenciaSQL = $conexion->prepare("SELECT Foto FROM producto WHERE ID_Producto=:idProd");
                        $sentenciaSQL->bindParam(':idProd', $txtID);
                        $sentenciaSQL->execute();
                        $prenda=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
                        //Borro la foto anterior
                        if( isset($prenda["Foto"]) &&($prenda["Foto"]!="imagen.jpg") ){
                            if (file_exists("../../img/".$prenda["Foto"])){
                                unlink("../../img/".$prenda["Foto"]);
                            }
                        }
                    //actualizamos con la imagen
                    $sentenciaSQL = $conexion->prepare("UPDATE producto SET Foto=:imagen WHERE ID_Producto=:idProd");
                    $sentenciaSQL->bindParam(':imagen', $nombreArchivo);
                    $sentenciaSQL->bindParam(':idProd', $txtID);
                    $sentenciaSQL->execute();
                }

                //echo "Se modificó tu producto";
                header("Location:productos.php");
                break;

            case "Cancelar":
                //echo "Se canceló tu producto";
                header("Location:productos.php");
                break;

            case "Ver":
                $sentenciaSQL = $conexion->prepare("SELECT * FROM producto WHERE ID_Producto=:idProd"); //Hago la cosulta a la db
                $sentenciaSQL->bindParam(':idProd', $txtID);
                $sentenciaSQL->execute();
                $prenda=$sentenciaSQL->fetch(PDO::FETCH_LAZY); //Cargar datos uno a uno y rellenarlos

                $txtNombre=$prenda['Nombre_Producto'];
                $txtTalle=$prenda['Talle'];
                $txtCateg=$prenda['ID_Categoria'];
                $txtDescr=$prenda['Descripcion_Producto'];
                $txtPrecio=$prenda['Precio_Unitario'];
                $txtDesc=$prenda['ID_Descuento'];
                $unidades=$prenda['Cant_Por_Unidad'];
                $imagen=$prenda['Foto'];


                //echo "Se seleccionó tu producto";
                break;

            case "Borrar":

                //Borrar imagen primero
                $sentenciaSQL = $conexion->prepare("SELECT Foto FROM producto WHERE ID_Producto=:idProd"); //Hago la cosulta a la db
                $sentenciaSQL->bindParam(':idProd', $txtID);
                $sentenciaSQL->execute();
                $prenda=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

                //debemos usar el if
                if( isset($prenda["Foto"]) &&($prenda["Foto"]!="imagen.jpg") ){
                    if (file_exists("../../img/".$prenda["Foto"])){
                        unlink("../../img/".$prenda["Foto"]);
                    }
                }
                //Luego borramos el registro
                $sentenciaSQL = $conexion->prepare("DELETE FROM producto WHERE ID_Producto=:idProd");
                $sentenciaSQL->bindParam(':idProd', $txtID);
                $sentenciaSQL->execute();
                //echo "Se borró tu producto";

                header("Location:productos.php");
                break;
        }

    //MOSTRAR MIS PRODUCTOS EN LA TABLA
        $sentenciaSQL = $conexion->prepare("SELECT * FROM producto");
        $sentenciaSQL->execute();
        $listadoProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    //--------------------------------
    ?>

<!-- INFORMACIÓN DEL PRODUCTO-->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>INFORMACIÓN DEL PRODUCTO</strong>
                    
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class = "form-group">
                            <label for="txtID">ID: </label>
                            <input type="text" required readonly class="form-control" id="txtID" name="txtID" placeholder="ID" value="<?php echo $txtID; ?>">
                        </div>
                        <div class = "form-group">
                            <label for="txtNombre">Nombre: </label>
                            <input type="text" required class="form-control" id="txtNombre" name="txtNombre" placeholder="Nombre del producto" value="<?php echo $txtNombre; ?>">
                        </div>
                        <div class = "row form-group">
                            <div class="col">
                                <label for="txtTalle">Talle: </label>
                                <input type="text" class="form-control" id="txtTalle" name="txtTalle" placeholder="Talle" value="<?php echo $txtTalle; ?>">
                            </div>
                            <div class="col">
                                <label for="txtCateg" >Categoría: </label> <br>
                                <select class="form-select form-select-lg" id="txtCateg" name="txtCateg" >
                                    <option value="<?php echo $txtCateg; ?>"></option>
                                    <option value="Mujer">Mujer</option>
                                    <option value="Hombre">Hombre</option>
                                    <option value="Ofertas">Ofertas</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtDescr">Descripción: </label>
                            <input type="text" class="form-control" id="txtDescr" name="txtDescr" size="200" placeholder="Describe tu producto." value="<?php echo $txtDescr; ?>">
                        </div>
                        <div class = "row form-group">
                            <div class="col">
                                <label for="txtPrecio">Precio: </label>
                                <input type="number" min="1" step="any" class="form-control" id="txtPrecio" name="txtPrecio" placeholder="Precio" value="<?php echo $txtPrecio; ?>">
                            </div>
                            <div class="col">
                                <label for="txtDesc" >Descuento: </label><br>
                                <select class="form-select form-select-lg" id="txtDesc" name="txtDesc">
                                    <option value="<?php echo $txtDesc; ?>"></option>
                                    <option value="0">No aplica</option>
                                    <option value="20">20%</option>
                                    <option value="35">35%</option>
                                    <option value="50">50%</option>
                                </select>
                            </div>
                        </div> 
                        <div class="form-group">
                                <label for="unidades">Cantidad: </label>
                                <input type="number" class="form-control" id="unidades" name="unidades" placeholder="Unidades" value="<?php echo $unidades; ?>">
                        </div>
                        <div class = "form-group">
                            <label for="imagen">Imagen: </label>
                                <br>
                                <?php  if ($imagen!=""){ ?>
                                    <img class="img-thumbnail rounded-1" src="../../img/<?php echo $imagen;?>" width="50" alt="" srcset="">
                                <?php }  ?>
                            <input type="file" class="form-control" id="imagen" name="imagen">
                        </div>
                        <div class="text-center" >
                            <button type="submit" <?php echo ($action=="Ver")?"disabled":"";?> name="action" class="btn btn-success btn-sm" value="Agregar">Agregar</button>
                            <button type="submit" <?php echo ($action!="Ver")?"disabled":"";?> name="action" class="btn btn-warning btn-sm" value="Editar">Editar</button>
                            <button type="submit" <?php echo ($action!="Ver")?"disabled":"";?> name="action" class="btn btn-danger btn-sm" value="Cancelar">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div> <br>
        </div>
        <div class="col-md-6"></div>
    </div>




<!-- LISTADO DE PRODUCTOS __________________________________________________________-->
<div class="container">
    <h1 class="text-center display-3">LISTADO DE PRODUCTOS</h1>
    <br>
    <a href="reporteStock.php" target="_blank" style="text-decoration: none; color: white; background-color: black; border-radius: 3px 3px 3px 3px; padding: 4px;"> - Imprimir Reporte de Stock - </a>
    <br> <br>
    <div class="row">
        <div class="col">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Talle</th>
                        <th>Categoria</th>
                        <th>Descripción.</th>
                        <th>Precio</th>
                        <th>Desc%</th>
                        <th>Cant.</th>
                        <th>Imagen</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                <?php foreach ($listadoProductos as $prenda) { ?>
                    <tr>
                        <td><?php echo $prenda['ID_Producto'];?> </td>
                        <td><?php echo $prenda['Nombre_Producto'];?> </td>
                        <td><?php echo $prenda['Talle'];?> </td>
                        <td><?php echo $prenda['ID_Categoria'];?> </td>
                        <td><?php echo $prenda['Descripcion_Producto'];?> </td>
                        <td><?php echo $prenda['Precio_Unitario'];?> </td>
                        <td><?php echo $prenda['ID_Descuento'];?> </td>
                        <td><?php echo $prenda['Cant_Por_Unidad'];?> </td>
                        <td>
                            <img class="img-thumbnail rounded-1" src="../../img/<?php echo $prenda['Foto'];?>" width="50" alt="" srcset="">

                        </td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="txtID" id="txtID" value="<?php echo $prenda['ID_Producto'];?>"/>
                                <input type="submit" name="action" class="btn btn-dark btn-sm" value="Ver"/>
                                <input type="submit" name="action" class="btn btn-danger btn-sm"value="Borrar"/>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include("../template/footer.php");   ?>
