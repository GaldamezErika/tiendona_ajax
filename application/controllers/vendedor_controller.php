<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class vendedor_controller extends CI_Controller {

	public function __construct(){

		parent:: __construct();
		$this->load->model('vendedor_model');
	}

	public function index()
	{
		$data = array('title' => 'Tiendona || Home');
		$this->load->view('template/header',$data);
		$this->load->view('vendedor_view');
		$this->load->view('template/footer');
	}

	public function get_vendedor(){

		$respuesta = $this->vendedor_model->get_vendedor();
		echo json_encode($respuesta);
	}

	public function eliminar(){

		$id = $this->input->post('id');
		$respuesta = $this->vendedor_model->eliminar($id);
		echo json_encode($respuesta);
	}

	public function get_categoria(){

		$respuesta = $this->vendedor_model->get_categoria();
		echo json_encode($respuesta);
	}

	public function get_sexo(){

		$respuesta = $this->vendedor_model->get_sexo();
		echo json_encode($respuesta);
	}

	public function insertar(){

		$datos['nombre'] = $this->input->post('nombre');
		$datos['apellido'] = $this->input->post('apellido');
		$datos['categoria'] = $this->input->post('categoria');
		$datos['sexo'] = $this->input->post('sexo');

		$respuesta = $this->vendedor_model->set_vendedor($datos);
		echo json_encode($respuesta);
	}

	public function get_datos(){

		$id = $this->input->post('id');
		$respuesta = $this->vendedor_model->get_datos($id);
		echo json_encode($respuesta);
	}

	public function actualizar(){

		$datos['id'] = $this->input->post('id');
		$datos['nombre'] = $this->input->post('nombre');
		$datos['apellido'] = $this->input->post('apellido');
		$datos['categoria'] = $this->input->post('categoria');
		$datos['sexo'] = $this->input->post('sexo');

		$respuesta = $this->vendedor_model->actualizar($datos);
		echo json_encode($respuesta);
	}
}
