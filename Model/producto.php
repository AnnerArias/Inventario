<?php
require_once 'model/database.php';
class producto
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
// consultar estock
	public function ConsultarStock()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT p.nombre, p.id, p.min_stock, s.cantidad
FROM productos p
JOIN stock s ON p.id = s.id_producto
WHERE s.cantidad <= p.min_stock  ;
");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
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

			$stm = $this->pdo->prepare("SELECT * FROM productos");
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
			$stm = $this->pdo->prepare("SELECT * FROM productos WHERE id = ?");
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
			            ->prepare("DELETE FROM productos WHERE id = ?");

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
			$sql = "UPDATE productos SET
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

	public function Registrar(producto $data)
	{
		try
		{
		$sql = "INSERT INTO productos (nombre, presentacion, cant_empaque, imagen, estado, categoria_id, min_stock)
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

			$id_producto = $this->pdo->lastInsertId();

			// Insertar en la tabla stock
			$sql_stock = "INSERT INTO stock (id_producto, cantidad) VALUES (?, 0)";
			$stmt_stock = $this->pdo->prepare($sql_stock);
			$stmt_stock->execute([$id_producto]);

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}


