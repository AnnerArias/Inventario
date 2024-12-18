<?php
require_once 'model/despachos.php';
class SalidasController{

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

    public function Crud($id){
        $desp = new despachos();

        if(isset($id)){
            $desp = $this->model->Obtener($id);
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
    public function Detalles($id){
        $desp = new despachos();
        $id_comp = $id;
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
        header('Location: /Sistemainventario/salidas/Detalles/'.$i.'');
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
        header('Location: /Sistemainventario/salidas/Detalles/'.$i.'');
    }

    public function Editar(){
        $desp = new despachos();

        $desp->id = $_REQUEST['id'];
        $desp->emisor_id = $_REQUEST['emisor_id'];
        $desp->fecha = $_REQUEST['fecha'];
        $desp->factura = $_REQUEST['factura'];

        $this->model->Actualizar($desp);

        header('Location: /Sistemainventario/salidas');
    }

    public function Eliminar($id){
        $this->model->Eliminar($id);
        header('Location: /Sistemainventario/salidas');
    }
    public function EliminarDetalle($id, $i){

        $this->model->EliminarDetalle($id);
        
        header('Location: /Sistemainventario/salidas/Detalles/'.$i.'');
    }
}
