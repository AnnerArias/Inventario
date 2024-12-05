<?php
class usuario
{
	private $pdo;

    public $id;
    public $nombres;
	public $apellidos;
    public $correo;
    public $clave;
	public $rol;
	public $estado;
	public $avatar;

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

			$stm = $this->pdo->prepare("SELECT * FROM usuarios");
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
			$stm = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function comprobarClave($id, $clave)
	{
		try
		{
			$stm = $this->pdo->prepare("SELECT clave FROM usuarios WHERE id = ?");
			$stm->execute(array($id));
			$usuario = $stm->fetch(PDO::FETCH_OBJ);

			// Verificar si la clave proporcionada coincide con la clave almacenada
			if ($usuario && md5($clave) === $usuario->clave) {
				return true;
			} else {
				return false;
			}
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}


	public function Eliminar($id)
	{
		try {
			$stm = $this->pdo->prepare("UPDATE usuarios SET estado = CASE WHEN estado = 'Activo' THEN 'Suspendido' ELSE 'Activo' END WHERE id = ?");
			$stm->execute(array($id));
		} catch (Exception $e) {
			die($e->getMessage());
		}
		
	}

	public function Actualizar($data)
	{
		try
		{
			$sql = "UPDATE usuarios SET
						nombres		=?,
						apellidos	=?,
						rol			=?,
						correo		=?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
						$data->nombres,
						$data->apellidos,
						$data->rol,
						$data->correo,
                        $data->id
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	// cambiar clave
	public function updateClave($id, $nuevaClave)
		{
			try
			{
				$sql = "UPDATE usuarios SET clave = ? WHERE id = ?";
				$stm = $this->pdo->prepare($sql);
				$stm->execute(array($nuevaClave, $id));
			} catch (Exception $e)
			{
				die($e->getMessage());
			}
		}


	public function Registrar(usuario $data)
	{
		try
		{
		$sql = "INSERT INTO usuarios (nombres,apellidos,rol,correo,clave,estado,avatar)
		        VALUES (?, ?, ?, ?, ?, ?, ?)";
		
		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->nombres,
					$data->apellidos,
					$data->rol,
                    $data->correo,
                    $data->clave,
					$data->estado,
					$data->avatar,
                )
			);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}
