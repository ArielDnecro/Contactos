<?php  
	class contactosController extends AppController
	{ 
		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$contactos = $this->loadModel("contacto");
			$categorias = $this->loadModel("categoria");
			$tiposclientes = $this->loadModel("tipocliente");
			$this->_view->contactos=$contactos->getContactos();
			$this->_view->categorias=$categorias->getCategorias();
			$this->_view->tiposclientes=$tiposclientes->getTiposClientes();
			$this->_view->titulo="Pagina principal";
			$this->_view->renderizar("index");
		}

		/**
		 * Este metodo agregar una tarea
		 * Si detecta una entrada de datos mediante el POST, llama el metodo que guarda una tarea
		 */
		public function agregar()
		{
			if($_POST)
			{
				$contactos = $this->loadModel("contacto");
				$this->_view->contactos = $contactos->agregar($_POST);
				$this->redirect(array("controller"=>"contactos"));
			}
			$categorias = $this->loadModel("categoria");
			$tiposclientes = $this->loadModel("tipocliente");
			$this->_view->categorias=$categorias->getCategorias();
			$this->_view->tiposclientes=$tiposclientes->getTiposClientes();
			$this->_view->titulo="Agregar Contacto";
			$this->_view->renderizar("agregar");
		}

		
		public function editar($id=null)
		{
			if($_POST)
			{
				$contactos = $this->loadModel("contacto");
				$contactos->actualizar($_POST);
				$this->redirect(array("controller"=>"contactos"));
			}
			$contactos = $this->loadModel("contacto");
			$this->_view->contacto = $contactos->buscarPorId($id);

			$categorias = $this->loadModel("categoria");
			$this->_view->categorias=$categorias->getCategorias();

			$tiposclientes = $this->loadModel("tipocliente");
			$this->_view->tiposclientes=$tiposclientes->getTiposClientes();

			$this->_view->titulo="Editar Contacto";
			$this->_view->renderizar("editar");
		}
		/**
		 * Eliminar una aplicacion
		 * @param type $id 
		 * @return type
		 */
		public function eliminar($id)
		{
			$contacto = $this->loadModel("contacto");
			$registro = $contacto->buscarPorId($id);
			if(!empty($registro))
			{
				$contacto->eliminar($id);
				$this->redirect(array("controller"=>"contactos"));
			}			
		}
		
	}
?>