<?php  
	class ContactoModel extends AppModel
	{
		public function __construct()
		{
			parent::__construct();
		}

		

		public function getContactos()
		{
			$contactos = $this->_db->query("SELECT TC.* ,CO.*,C.* FROM clientes CO 
             INNER JOIN categorias C ON C.id=CO.categoria_id 
             INNER JOIN tipos TC ON TC.id=CO.tipo_id");
			
			foreach (range(0, $contactos->columnCount()-1) as $column_index) {
				$meta[] = $contactos->getColumnMeta($column_index);
			}
			
			$resultados = $contactos->fetchAll(PDO::FETCH_NUM);

			for ($i=0; $i < count($resultados); $i++) { 
				$j = 0;
				foreach ($meta as $value) {
					$rows[$i][$value["table"]][$value["name"]] = $resultados[$i][$j];
					$j++;
				}
			}
			return $rows;		
		}

		public function agregar($datos = array())
		{
			$consulta=$this->_db->prepare(
				"INSERT INTO clientes
				(categoria_id,tipo_id,nombre,apellidos,telefono,celular,correo_electronico, fecha_alta)
				VALUES
				(:categoria_id,:tipo_id,:nombre,:apellidos,:telefono,:celular,:correo_electronico,:fecha_alta)"
			);

			$consulta->bindParam(":categoria_id",$datos["categoria"]);
			$consulta->bindParam(":tipo_id",$datos["tipocliente"]);
			$consulta->bindParam(":nombre",$datos["nombre"]);
			$consulta->bindParam(":apellidos",$datos["apellidos"]);
			$consulta->bindParam(":telefono",$datos["telefono"]);
			$consulta->bindParam(":celular",$datos["celular"]);
			$consulta->bindParam(":correo_electronico",$datos["correo"]);
			$consulta->bindParam(":fecha_alta",$datos["fecha"]);			

			if($consulta->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function actualizar($datos = array())
		{
			$consulta=$this->_db->prepare(
				"UPDATE clientes SET
				categoria_id=:categoria_id,
				tipo_id=:tipo_id,
				nombre=:nombre,
				apellidos=:apellidos,
				telefono=:telefono,
				celular=:celular,
				correo_electronico=:correo_electronico,
				fecha_alta=:fecha_alta				
				WHERE id=:id"
			);

			$consulta->bindParam(":categoria_id",$datos["categoria"]);
			$consulta->bindParam(":tipo_id",$datos["tipocliente"]);
			$consulta->bindParam(":nombre",$datos["nombre"]);
			$consulta->bindParam(":apellidos",$datos["apellidos"]);
			$consulta->bindParam(":telefono",$datos["telefono"]);
			$consulta->bindParam(":celular",$datos["celular"]);
			$consulta->bindParam(":correo_electronico",$datos["correo"]);
			$consulta->bindParam(":fecha_alta",$datos["fecha"]);		
			$consulta->bindParam(":id",$datos["id"]);		

			if($consulta->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function buscarPorId($id)
		{
			$contacto = $this->_db->prepare("SELECT * FROM clientes WHERE id=:id");
			$contacto->bindParam(":id",$id);
			$contacto->execute();
			$registro = $contacto->fetch();

			if ($registro) 
			{
				return $registro;
			}
			else
			{
				return false;
			}
		}

		public function eliminar($id)
		{
			$query = $this->_db->prepare("DELETE FROM clientes WHERE id=:id");
			$query->bindParam(":id",$id);
			if($query->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		
	}
?>