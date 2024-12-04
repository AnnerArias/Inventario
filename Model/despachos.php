<?php
class despachos
{
	private $pdo;

    public $id;
    public $emisor_id;
	public $fecha;
	public $factura;
	public $id_despacho;
	public $producto_id;
	public $disponible;
	public $cantidad;
	public $total;

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

			$stm = $this->pdo->prepare("SELECT * FROM despachos");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ListarDestalles($i)
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM detalles_despachos WHERE id_despacho = $i");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function Ultima()
	{
		try
		{
			$stm = $this->pdo->prepare("SELECT id FROM despachos ORDER BY id DESC LIMIT 1");
			$stm->execute();

			$result = $stm->fetch(PDO::FETCH_OBJ);

			return $result->id;
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
			$stm = $this->pdo->prepare("SELECT * FROM despachos WHERE id = ?");
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
			// cambiar comportamiendo a actualizar estado
			$stm = $this->pdo
			            ->prepare("DELETE FROM despachos WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function EliminarDetalle($id)
	{
		try
		{
			// antes de eliminar sumar productos a stock
			$stm = $this->pdo
			            ->prepare("DELETE FROM detalles_despachos WHERE id = ?");

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
			$sql = "UPDATE despachos SET
						emisor_id    = ?,
						fecha 			= ?,
            			factura  		= ?
				    WHERE id = ?";
					
			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->emisor_id,
						$data->fecha,
						$data->factura,
						$data->id
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function RegistrarDetalles(despachos $data)
	{
		try
    {
        // Verificar si el producto ya existe en la compra
        $sql = "SELECT cantidad FROM detalles_despachos WHERE id_despacho = ? AND producto_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array($data->id_despacho, $data->producto_id));
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            // Si el producto ya existe, sumar la cantidad existente con la nueva
            $newQuantity = $existing['cantidad'] - $data->cantidad;
            $sql = "UPDATE detalles_despachos SET cantidad = ? WHERE id_despacho = ? AND producto_id = ?";
            $this->pdo->prepare($sql)->execute(array($newQuantity, $data->id_despacho, $data->producto_id));
        } else {
            // Si el producto no existe, insertar un nuevo registro
            $sql = "INSERT INTO detalles_despachos (id_despacho, producto_id, cantidad) VALUES (?, ?, ?)";
            $this->pdo->prepare($sql)->execute(array($data->id_despacho, $data->producto_id, $data->cantidad));
        }

        // Actualizar el stock
        $sql = "UPDATE stock SET cantidad = ? WHERE id_producto = ?";
        $this->pdo->prepare($sql)->execute(array($data->total, $data->producto_id));
    } catch (Exception $e)
    {
        die($e->getMessage());
    }
	}

	public function Registrar(despachos $data)
	{
		try
		{
		$sql = "INSERT INTO despachos (emisor_id, fecha, factura)
		        VALUES (?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->emisor_id,
					$data->fecha,
					$data->factura
                )
			);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}
