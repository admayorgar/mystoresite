<?php
session_start();

$mensaje="";

//primero valido el boton de agregar btnAction

    if (isset($_POST['btnAction'])) {
        switch($_POST['btnAction']) {
            case 'Add':
                //Recepciono los datos
                if (is_numeric(openssl_decrypt($_POST['txtID'], COD, KEY))) {
                    $IDdes= openssl_decrypt($_POST['txtID'], COD, KEY);
                } else { $mensaje.= "Oops... ID incorrecto" . $IDdes."<br>";
                }
                if (is_string(openssl_decrypt($_POST['txtNombre'], COD, KEY))) {
                    $nombreDes= openssl_decrypt($_POST['txtNombre'], COD, KEY);
                } else { $mensaje.= "Oops... Algo pasa con el nombre" . $nombreDes."<br>"; break;
                }
                if (is_numeric(openssl_decrypt($_POST['cantCart'], COD, KEY))) {
                    $cantCartDes= openssl_decrypt($_POST['cantCart'], COD, KEY);
                } else { $mensaje.= "Oops... algo pasa con la cantidad" . $cantCartDes."<br>"; break;
                }
                if (is_numeric(openssl_decrypt($_POST['txtPrecio'], COD, KEY))) {
                    $precioDes= openssl_decrypt($_POST['txtPrecio'], COD, KEY);
                } else { $mensaje.= "Oops... algo pasa con la El precio" . $precioDes."<br>"; break;
                }
            if(!isset($_SESSION['CARRITO'])){
        //Obtengo toda la informacion enviada a través del POST a mi carrito, y utilizo una variable de sesion que se llama carrito, y lo estoy metiendo desde la primera posicion, metemos la informacion de la variable elProducto
                $elProducto=array(
                    'IDdes'=>$IDdes,
                    'nombreDes'=>$nombreDes,
                    'cantCartDes'=>$cantCartDes,
                    'precioDes'=>$precioDes
                );
                $_SESSION['CARRITO'][0]=$elProducto;
                //$mensaje= "Producto Agregado al Carrito";
            }else{
                $numeroProductos=count($_SESSION['CARRITO']); // contabilizar el carrito de compras--> cantidad de productos
                $elProducto=array(
                    'IDdes'=>$IDdes,
                    'nombreDes'=>$nombreDes,
                    'cantCartDes'=>$cantCartDes,
                    'precioDes'=>$precioDes
                );
                $_SESSION['CARRITO'][$numeroProductos]=$elProducto;

            }
            //$mensaje= print_r($_SESSION,true);
                $mensaje= "Producto Agregado al Carrito";
        break;
            case "subtract":
                if (is_numeric(openssl_decrypt($_POST['txtID'], COD, KEY))) {
                    $IDdes= openssl_decrypt($_POST['txtID'], COD, KEY);

                    foreach ($_SESSION['CARRITO'] as $indice=>$elProducto ){
                        if ($elProducto['IDdes']==$IDdes){
                            unset($_SESSION['CARRITO'][$indice]);
                            echo "<script>alert('Artículo Eliminado de la Lista')</script>";
                        }
                    }
                } else { $mensaje.= "Oops... ID incorrecto" ."<br>";
                }
            break;
        }
    }


