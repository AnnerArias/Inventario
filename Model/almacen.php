<?php
class almacen
{
	private $pdo;

    public $id;
    public $nombre;
	public $presentacion;
	public $cant_empaque;
	public $imagen;
	public $estado;
	public $categoria_id;
	public $min_stock;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::Conectar();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM stock");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function ListarAlertas()
{
    try
    {
        $result = array();

        $sql = "SELECT s.*, p.min_stock 
                FROM stock s 
                JOIN productos p ON s.id_producto = p.id 
                WHERE s.cantidad <= p.min_stock";
                
        $stm = $this->pdo->prepare($sql);
        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }
    catch(Exception $e)
    {
        die($e->getMessage());
    }
}


	public function Obtener($id)
	{
		try
		{
			$stm = $this->pdo->prepare("SELECT * FROM stock WHERE id = ?");
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM stock WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try
		{
			$sql = "UPDATE stock SET
						nombre        	= ?,
						presentacion 	= ?,
            			cant_empaque	= ?,
						imagen			= ?,
						estado  		= ?,
						categoria_id 	= ?,
						min_stock 		= ?
				    WHERE id = ?";
					
			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->nombre,
						$data->presentacion,
						$data->cant_empaque,
						$data->imagen,
						$data->estado,
						$data->categoria_id,
						$data->min_stock,
						$data->id
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Registrar(almacen $data)
	{
		try
		{
		$sql = "INSERT INTO stock (nombre, presentacion, cant_empaque, imagen, estado, categoria_id, min_stock)
		        VALUES (?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->nombre,
					$data->presentacion,
					$data->cant_empaque,
					$data->imagen,
					$data->estado,
					$data->categoria_id,
					$data->min_stock,
                )
			);

			$id_almacen = $this->pdo->lastInsertId();

			// Insertar en la tabla stock
			$sql_stock = "INSERT INTO stock (id_almacen, cantidad) VALUES (?, 0)";
			$stmt_stock = $this->pdo->prepare($sql_stock);
			$stmt_stock->execute([$id_almacen]);

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}


