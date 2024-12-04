<?php
require_once 'model/despachos.php';
class DespachosController{

    private $model;

    public function __CONSTRUCT(){
        $this->model = new despachos();
    }

    //Llamado plantilla principal
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/despachos/despachos.php';
        require_once 'view/footer.php';
    }

    public function Crud(){
        $desp = new despachos();

        if(isset($_REQUEST['id'])){
            $desp = $this->model->Obtener($_REQUEST['id']);
        }

        require_once 'view/header.php';
        require_once 'view/despachos/despachos-editar.php';
        require_once 'view/footer.php';
    }

    public function Nuevo(){
        $desp = new despachos();

        require_once 'view/header.php';
        require_once 'view/despachos/despachos-nuevo.php';
        require_once 'view/footer.php';
    }
    public function Detalles(){
        $desp = new despachos();

        require_once 'view/header.php';
        require_once 'view/despachos/despachos-detalles.php';
        require_once 'view/footer.php';
    }

    public function Guardar(){
        $desp = new despachos();
        
        $desp->emisor_id = $_REQUEST['emisor_id'];
        $desp->fecha = $_REQUEST['fecha'];
        $desp->factura = $_REQUEST['factura'];

        $this->model->Registrar($desp);
// dirigir al formulario de agregar detalles
        $i = $this->model->Ultima();
        header('Location: index.php?c=despachos&a=Detalles&i='.$i.'');
    }
    // guardar detalles
    public function GuardarDetalles(){
        $desp = new despachos();
        
        $desp->id_despacho = $_REQUEST['id_despacho'];
        $desp->producto_id = $_REQUEST['id_producto'];
        $desp->disponible = $_REQUEST['disponible'];
        $desp->cantidad = $_REQUEST['cantidad'];

        $desp->total = $_REQUEST['disponible'] - $_REQUEST['cantidad'];

        


        $this->model->RegistrarDetalles($desp);

// dirigir al formulario de agregar detalles
        $i = $_REQUEST['id_despacho'];
        header('Location: index.php?c=despachos&a=Detalles&i='.$i.'');
    }

    public function Editar(){
        $desp = new despachos();

        $desp->id = $_REQUEST['id'];
        $desp->emisor_id = $_REQUEST['emisor_id'];
        $desp->fecha = $_REQUEST['fecha'];
        $desp->factura = $_REQUEST['factura'];

        $this->model->Actualizar($desp);

        header('Location: index.php?c=despachos');
    }

    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['id']);
        header('Location: index.php?c=despachos');
    }
    public function EliminarDetalle(){

        $this->model->EliminarDetalle($_REQUEST['id']);
        
         $i = $_REQUEST['i'];
        header('Location: index.php?c=despachos&a=Detalles&i='.$i.'');
    }
}
