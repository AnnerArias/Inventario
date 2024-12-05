<?php
//Se incluye el modelo donde conectará el controlador.
require_once 'model/proveedor.php';

class ProveedorController{

    private $model;

    //Creación del modelo
    public function __CONSTRUCT(){
        $this->model = new proveedor();
    }

    //Llamado plantilla principal
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/proveedor/proveedor.php';
        require_once 'view/footer.php';
    }

    //Llamado a la vista proveedor-editar
    public function Crud($id){
        $pvd = new proveedor();

        //Se obtienen los datos del proveedor a editar.
        if(isset($id)){
            $pvd = $this->model->Obtener($id);
        }

        //Llamado de las vistas.
        require_once 'view/header.php';
        require_once 'view/proveedor/proveedor-editar.php';
        require_once 'view/footer.php';
  }

    //Llamado a la vista proveedor-nuevo
    public function Nuevo(){
        $pvd = new proveedor();

        //Llamado de las vistas.
        require_once 'view/header.php';
        require_once 'view/proveedor/proveedor-nuevo.php';
        require_once 'view/footer.php';
    }

    //Método que registrar al modelo un nuevo proveedor.
    public function Guardar(){
        $pvd = new proveedor();

        //Captura de los datos del formulario (vista).
        $pvd->rif = $_REQUEST['rif'];
        $pvd->nombre = $_REQUEST['nombre'];
        $pvd->direccion = $_REQUEST['direccion'];
        $pvd->telefono = $_REQUEST['telefono'];
        

        // Validar si la imagen fue cargada
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $allowed_formats = ['image/png', 'image/jpeg', 'image/gif'];
            $file_type = $_FILES['imagen']['type'];

            // Validar el formato de la imagen
            if (in_array($file_type, $allowed_formats)) {
                $nombre = $_REQUEST['rif'];
                $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $imagen_nombre = $nombre . '.' . $extension;
                $ruta_destino = 'http://localhost/Sistemainventario/assets/img/proveedores/' . $imagen_nombre;

                // Mover la imagen a la carpeta de destino
                move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);
                $pvd->logo = $imagen_nombre;
            } else {
                // Formato de imagen no permitido
                $pvd->logo = 'no-imagen.png';
            }
        } else {
            // No se cargó ninguna imagen
            $pvd->logo = 'no-imagen.png';
        }

        //Registro al modelo proveedor.
        $_SESSION['accion']='Proveedor creado con éxito';
        $this->model->Registrar($pvd);

        
        header('Location: /Sistemainventario/proveedor');
    }

    //Método que modifica el modelo de un proveedor.
    public function Editar(){
        $pvd = new proveedor();

        $pvd->rif = $_REQUEST['rif'];
        $pvd->nombre = $_REQUEST['nombre'];
        $pvd->direccion = $_REQUEST['direccion'];
        $pvd->telefono = $_REQUEST['telefono'];
        $pvd->rif_anterior = $_REQUEST['rif_anterior'];
        $imagen_anterior = $_REQUEST['imagen_anterior'];

         // Validar si la imagen fue cargada
         if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
            $allowed_formats = ['image/png', 'image/jpeg', 'image/gif'];
            $file_type = $_FILES['imagen']['type'];

            // Validar el formato de la imagen
            if (in_array($file_type, $allowed_formats)) {
                $nombre = $_REQUEST['rif'];
                $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $imagen_nombre = $nombre . '.' . $extension;
                $ruta_destino = 'http://localhost/Sistemainventario/assets/img/proveedores/' . $imagen_nombre;

                // Mover la imagen a la carpeta de destino
                move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);
                $pvd->logo = $imagen_nombre;
            } else {
                // Formato de imagen no permitido
                $pvd->logo = 'no-imagen.png';
            }
        } else {
            // No se cargó ninguna imagen
            $pvd->logo = $imagen_anterior;
        }

        $_SESSION['accion']='Proveedor actualizado con éxito';
        $this->model->Actualizar($pvd);

        header('Location: /Sistemainventario/proveedor');
    }

    //Método que elimina la tupla proveedor con el rif dado.
    public function Eliminar($id){
        $_SESSION['accion']='Proveedor eliminado con éxito';
        $this->model->Eliminar($id);
        header('Location: /Sistemainventario/proveedor');
    }
}
