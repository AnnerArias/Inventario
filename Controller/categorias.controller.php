<?php
require_once 'model/categorias.php';

class CategoriasController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new categorias();
    }

    //Llamado plantilla principal
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/categorias/categorias.php';
        require_once 'view/footer.php';
    }

    public function Crud(){
        $cate = new categorias();

        if(isset($_REQUEST['id'])){
            $cate = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/categorias/categorias-editar.php';
        require_once 'view/footer.php';
    }

    public function Nuevo(){
        $cate = new categorias();

        require_once 'view/header.php';
        require_once 'view/categorias/categorias-nuevo.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $cate = new categorias();
        
        $cate->nombre = $_REQUEST['nombre'];
        $_SESSION['accion']='Categoría creada con éxito';
        $this->model->Registrar($cate);

        header('Location: index.php?c=categorias');
    }

    public function Editar(){
        $cate = new categorias();

        $cate->id = $_REQUEST['id'];
        $cate->nombre= $_REQUEST['nombre'];
        $_SESSION['accion']='Categoría actualizada con éxito';
        $this->model->Actualizar($cate);

        header('Location: index.php?c=categorias');
    }

    public function Eliminar(){
        $_SESSION['accion']='Categoría eliminada con éxito';
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?c=categorias');
    }
}
