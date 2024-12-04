<?php
class categorias
{
	private $pdo;

    public $id;
    public $nombre;

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

			$stm = $this->pdo->prepare("SELECT * FROM categorias");
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
			$stm = $this->pdo->prepare("SELECT * FROM categorias WHERE id = ?");
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
			            ->prepare("DELETE FROM categorias WHERE id = ?");

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
			$sql = "UPDATE categorias SET
						nombre		=?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
						$data->nombre,
						$data->id,
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	

	public function Registrar(categorias $data)
	{
		try
		{
		$sql = "INSERT INTO categorias (nombre)
		        VALUES (?)";
		
		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->nombre,
                )
			);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}
