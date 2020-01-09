<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class vendedor_model extends CI_Model {

	public function get_vendedor(){

		$pa_consultar = "CALL pa_consultar()";
		$query = $this->db->query($pa_consultar);

		if ($query->num_rows()>0) {
			return $query->result();
		}else{
			return false;
		}
	}

	public function eliminar($id){

		$pa_eliminar = "CALL pa_eliminar(?)";
		$arreglo = array('id_vendedor' => $id);
		$query = $this->db->query($pa_eliminar,$id);

		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function get_categoria(){

		$exe = $this->db->get('categoria');
		return $exe->result();
	}

	public function get_sexo(){

		$exe = $this->db->get('sexo');
		return $exe->result();
	}

	public function set_vendedor($datos){

		$pa_insertar = "CALL pa_insertar(?,?,?,?)";
		$arreglo = array('nombre'       => $datos['nombre'],
	                     'apellido'     => $datos['apellido'],
	                     'id_categoria' => $datos['categoria'],
	                     'id_sexo'      => $datos['sexo']);

		$query = $this->db->query($pa_insertar,$arreglo);

		if ($query !== null) {
			return 'add';
		}else{
			return false;
		}
	}

	public function get_datos($id){

		$this->db->where('id_vendedor',$id);
		$exe = $this->db->get('vendedor');

		if ($exe->num_rows()>0) {
			return $exe->row();
		}else{
			return false;
		}
	}

	public function actualizar($datos){

		$pa_modificar = "CALL pa_modificar(?,?,?,?,?)";
		$arreglo = array('nombre'       => $datos['nombre'],
	                     'apellido'     => $datos['apellido'],
	                     'id_categoria' => $datos['categoria'],
	                     'id_sexo'      => $datos['sexo'],
	                     'id_vendedor'      => $datos['id']);

		$query = $this->db->query($pa_modificar,$arreglo);

		if ($query) {
			return 'edi';
		}else{
			return false;
		}
	}
	
}
