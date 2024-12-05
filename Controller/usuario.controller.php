<?php
require_once 'model/usuario.php';

class UsuarioController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new usuario();
    }

    //Llamado plantilla principal
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/usuario/usuario.php';
        require_once 'view/footer.php';
    }

    public function Crud($id){
        $prod = new usuario();

        if(isset($id)){
            $prod = $this->model->Obtener($id);
        }

        require_once 'view/header.php';
        require_once 'view/usuario/usuario-editar.php';
        require_once 'view/footer.php';
    }

    public function Nuevo(){
        $prod = new usuario();

        require_once 'view/header.php';
        require_once 'view/usuario/usuario-nuevo.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $prod = new usuario();
        
        $prod->nombres = $_REQUEST['nombres'];
        $prod->apellidos = $_REQUEST['apellidos'];
        $prod->correo = $_REQUEST['correo'];
        $prod->rol = $_REQUEST['rol'];
        $prod->clave = md5('Pas$word123');
        $prod->estado = 'Activo';
        $prod->avatar = 'no-avatar';

        $_SESSION['accion']='Usuario creado con éxito';
        $this->model->Registrar($prod);

        header('Location: /Sistemainventario/usuario');
    }

    public function Editar(){
        $prod = new usuario();

        $prod->id = $_REQUEST['id'];
        $prod->nombres = $_REQUEST['nombres'];
        $prod->apellidos = $_REQUEST['apellidos'];
        $prod->correo = $_REQUEST['correo'];
        $prod->rol = $_REQUEST['rol'];

        $_SESSION['accion']='Usuario actualizado con éxito';
        $this->model->Actualizar($prod);

        header('Location: /Sistemainventario/usuario');
    }

    public function Eliminar($id){
        $_SESSION['accion']='Estado Cambiado';
        $this->model->Eliminar($id);
        header('Location: /Sistemainventario/usuario');
    }
}
