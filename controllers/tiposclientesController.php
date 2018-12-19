<?php  
	
	class tiposclientesController extends AppController
	{
		public function __construct()
		{
			parent::__construct();
		}

		public function index()
		{
			$tiposclientes = $this->loadModel("tipocliente");
			$this->_view->tiposclientes=$tiposclientes->getTiposClientes();
			$this->_view->titulo="Pagina principal";
			$this->_view->renderizar("index");
		}

		public function agregar()
		{
			if($_POST)
			{
				$tipocliente = $this->loadModel("tipocliente");
				$tipocliente->add($_POST);
				$this->redirect(array("controller"=>"tiposclientes"));
			}
			$this->_view->titulo="Nuevo tipo cliente";
			$this->_view->renderizar("agregar");
		}

		public function editar($id=null)
		{
			if($_POST)
			{
				$tipocliente = $this->loadModel("tipocliente");
				$tipocliente->update($_POST);
				$this->redirect(array("controller"=>"tiposclientes"));
			}
			$tipocliente = $this->loadModel("tipocliente");
			$this->_view->tipocliente=$tipocliente->find($id);
			$this->_view->titulo="Editar tipo cliente";
			$this->_view->renderizar("editar");
		}

		public function eliminar($id = null)
		{
			$tipocliente = $this->loadModel("tipocliente");
			$item = $tipocliente->find($id);
			print_r($item);
			if($item)
			{
				$tipocliente->delete($id);
				$this->redirect(array("controller"=>"tiposclientes"));
			}
		}
	}
?>