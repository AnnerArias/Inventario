<?php
require_once 'model/compras.php';
class ComprasController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new compras();
    }

    //Llamado plantilla principal
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/compras/compras.php';
        require_once 'view/footer.php';
    }

    public function Crud(){
        $comp = new compras();

        if(isset($_REQUEST['id'])){
            $comp = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/compras/compras-editar.php';
        require_once 'view/footer.php';
    }

    public function Nuevo(){
        $comp = new compras();

        require_once 'view/header.php';
        require_once 'view/compras/compras-nuevo.php';
        require_once 'view/footer.php';
    }
    public function Detalles(){
        $comp = new compras();

        require_once 'view/header.php';
        require_once 'view/compras/compras-detalles.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $comp = new compras();
        
        $comp->proveedor_id = $_REQUEST['proveedor_id'];
        $comp->fecha = $_REQUEST['fecha'];
        $comp->factura = $_REQUEST['factura'];

        $this->model->Registrar($comp);
// dirigir al formulario de agregar detalles
        $i = $this->model->Ultima();
        header('Location: index.php?c=compras&a=Detalles&i='.$i.'');
    }
    // guardar detalles
    public function GuardarDetalles(){
        $comp = new compras();
        
        $comp->id_compra = $_REQUEST['id_compra'];
        $comp->producto_id = $_REQUEST['id_producto'];
        $comp->disponible = $_REQUEST['disponible'];
        $comp->cantidad = $_REQUEST['cantidad'];

        $comp->total = $_REQUEST['disponible'] + $_REQUEST['cantidad'];

        


        $this->model->RegistrarDetalles($comp);

// dirigir al formulario de agregar detalles
        $i = $_REQUEST['id_compra'];
        header('Location: index.php?c=compras&a=Detalles&i='.$i.'');
    }

    public function Editar(){
        $comp = new compras();

        $comp->id = $_REQUEST['id'];
        $comp->proveedor_id = $_REQUEST['proveedor_id'];
        $comp->fecha = $_REQUEST['fecha'];
        $comp->factura = $_REQUEST['factura'];

        $this->model->Actualizar($comp);

        header('Location: index.php?c=compras');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?c=compras');
    }
    public function EliminarDetalle(){

        $this->model->EliminarDetalle($_REQUEST['id']);
        
         $i = $_REQUEST['i'];
        header('Location: index.php?c=compras&a=Detalles&i='.$i.'');
    }
}
