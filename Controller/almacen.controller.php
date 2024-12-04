<?php
require_once 'model/almacen.php';

class AlmacenController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new almacen();
    }

    //Llamado plantilla principal
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/almacen/almacen.php';
        require_once 'view/footer.php';
    }

    public function Crud(){
        $prod = new almacen();

        if(isset($_REQUEST['id'])){
            $prod = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/almacen/almacen-editar.php';
        require_once 'view/footer.php';
    }

    public function Nuevo(){
        $prod = new almacen();

        require_once 'view/header.php';
        require_once 'view/almacen/almacen-nuevo.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $prod = new almacen();

        $prod->nombre = $_REQUEST['nombre'];
        $prod->presentacion = $_REQUEST['presentacion'];
        $prod->cant_empaque = $_REQUEST['cant_empaque'];
        $prod->estado = $_REQUEST['estado'];
        $prod->categoria_id = $_REQUEST['categoria_id'];
        $prod->min_stock = $_REQUEST['min_stock'];
        $imagen_anterior = $_REQUEST['imagen_anterior'];

        // Validar si la imagen fue cargada
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $allowed_formats = ['image/png', 'image/jpeg', 'image/gif'];
            $file_type = $_FILES['imagen']['type'];

            // Validar el formato de la imagen
            if (in_array($file_type, $allowed_formats)) {
                $nombre = substr($_REQUEST['nombre'], 0, 4);
                $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $imagen_nombre = $nombre . '.' . $extension;
                $ruta_destino = 'assets/img/almacens/' . $imagen_nombre;

                // Mover la imagen a la carpeta de destino
                move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);
                $prod->imagen = $imagen_nombre;
            } else {
                // Formato de imagen no permitido
                $prod->imagen = 'no-imagen.png';
            }
        } else {
            // No se cargó ninguna imagen
            $prod->imagen = 'no-imagen.png';
        }

        $this->model->Registrar($prod);


        header('Location: index.php?c=almacen');
    }

    public function Editar(){
        $prod = new almacen();

        $prod->nombre = $_REQUEST['nombre'];
        $prod->presentacion = $_REQUEST['presentacion'];
        $prod->cant_empaque = $_REQUEST['cant_empaque'];
        $prod->estado = $_REQUEST['estado'];
        $prod->categoria_id = $_REQUEST['categoria_id'];
        $prod->min_stock = $_REQUEST['min_stock'];
        $prod->id = $_REQUEST['id'];
        $imagen_anterior = $_REQUEST['imagen_anterior'];

        // Validar si la imagen fue cargada
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $allowed_formats = ['image/png', 'image/jpeg', 'image/gif'];
            $file_type = $_FILES['imagen']['type'];

            // Validar el formato de la imagen
            if (in_array($file_type, $allowed_formats)) {
                $nombre = substr($_REQUEST['nombre'], 0, 4);
                $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $imagen_nombre = $nombre . '.' . $extension;
                $ruta_destino = 'assets/img/almacens/' . $imagen_nombre;

                // Mover la imagen a la carpeta de destino
                move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);
                $prod->imagen = $imagen_nombre;
            } else {
                // Formato de imagen no permitido
                $prod->imagen = 'no-imagen.png';
            }
        } else {
            // No se cargó ninguna imagen
            $prod->imagen = $imagen_anterior;
        }


        $this->model->Actualizar($prod);

        header('Location: index.php?c=almacen');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?c=almacen');
    }
}
