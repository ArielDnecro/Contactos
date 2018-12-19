<?php  
	class TipoClienteModel extends AppModel
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function getTiposClientes()
		{
			$contactos = $this->_db->query("SELECT * FROM tipos");
			return $contactos->fetchall();			
		}
 
		public function find($id)
		{
			$query = $this->_db->prepare("SELECT * FROM tipos WHERE id=:id");
			$query->bindParam(":id",$id);
			$query->execute();
			$type = $query->fetch();

			if($type)
			{
				return $type;
			}
			else
			{
				return false;
			}
		}

		public function add($data = array())
		{
			$query = $this->_db->prepare("INSERT INTO tipos (nombre) VALUES (:nombre)");

			$query->bindParam(":nombre",$data["nombre"]);

			if($query->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function update($data = array())
		{
			$query = $this->_db->prepare(
				"UPDATE tipos SET nombre=:nombre WHERE id=:id"				
			);

			$query->bindParam(":id",$data["id"]);
			$query->bindParam(":nombre",$data["nombre"]);

			if($query->execute())
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		public function delete($id)
		{
			$query = $this->_db->prepare("DELETE FROM tipos WHERE id=:id");
			echo $id;
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