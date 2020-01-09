<script>
	

	$(document).ready(function(){

		mostrarVendedor();

		function mostrarVendedor(){

			$.ajax({

				type: 'ajax',
				url: '<?= base_url('vendedor_controller/get_vendedor') ?>',
				dataType: 'json',

				success: function(datos){

					var tabla = '';
					var i;
					var n = 1;

					for (i = 0; i < datos.length; i++) {

						tabla+=
						'<tr>'+
						'<td>'+n+'</td>'+
						'<td>'+datos[i].nombre+'</td>'+
						'<td>'+datos[i].apellido+'</td>'+
						'<td>'+datos[i].nombre_categoria+'</td>'+
						'<td>'+datos[i].nombre_sexo+'</td>'+
						'<td><a href="javascript:;" class="btn btn-danger btn-sm borrar" data="'+datos[i].id_vendedor+'">Eliminar</a></td>'+
						'<td><a href="javascript:;" class="btn btn-info btn-sm item-edit" data="'+datos[i].id_vendedor+'">Actualizar</a></td>'+
						'</tr>';

						n++;
					}

					$('#tabla_vendedor').html(tabla);
				}
			});
		};


		$('#tabla_vendedor').on('click','.borrar', function(){

			var id = $(this).attr('data');

			$('#modalBorrar').modal('show');

			$('#btnBorrar').unbind().click(function(){

				$.ajax({

					type: 'ajax',
					method: 'post',
					url: '<?= base_url('vendedor_controller/eliminar') ?>',
					data: {id:id},
					dataType: 'json',

					success: function(respuesta){

						$('#modalBorrar').modal('hide');

						if (respuesta == true) {

							alertify.notify('Se elimino exitosamente','success',10,null);
							mostrarVendedor();

						} else {

							alertify.notify('Error al eliminar','error',10,null);

						}
					}
				});
			});
		});


		$('#NuevoVende').click(function(){

			$('#modalGuardar').modal('show');

			$('#modalGuardar').find('.modal-title').text('Nuevo Vendedor');

			$('#formVendedor').attr('action','<?= base_url('vendedor_controller/insertar') ?>');
		});

		mostrarCategoria();

		function mostrarCategoria(){

			$.ajax({

				type: 'ajax',
				url: '<?= base_url('vendedor_controller/get_categoria') ?>',
				dataType: 'json',

				success: function(datos){

					var op = '';
					var i;

					op+=
					'<option value="">--Seleccione categoria--</option>';

					for (i = 0; i < datos.length; i++) {
						
						op+=
						'<option value="'+datos[i].id_categoria+'">'+datos[i].nombre_categoria+'</option>';
					}
					$('#categoria').html(op);
				}
			});
		};


		mostrarSexo();

		function mostrarSexo(){

			$.ajax({

				type: 'ajax',
				url: '<?= base_url('vendedor_controller/get_sexo') ?>',
				dataType: 'json',

				success: function(datos){

					var op = '';
					var i;

					op+=
					'<option value="">--Seleccione sexo--</option>';

					for (i = 0; i < datos.length; i++) {
						
						op+=
						'<option value="'+datos[i].id_sexo+'">'+datos[i].nombre_sexo+'</option>';
					}
					$('#sexo').html(op);
				}
			});
		};


		$('#btnGuardar').click(function(){

			$val = validacion();

			if($val == true){

				$url = $('#formVendedor').attr('action');
				$data = $('#formVendedor').serialize();

				$.ajax({

					type: 'ajax',
					method: 'post',
					url: $url,
					data: $data,
					dataType: 'json',

					success: function(respuesta){

						$('#modalGuardar').modal('hide');

						if (respuesta == 'add') {

							alertify.notify('Se guardo exitosamente','success',10,null);

						} else if(respuesta == 'edi') {

							alertify.notify('Se modifico exitosamente','success',10,null);
						}else{

							alertify.notify('Error al realizar la accion','error',10,null);
						}

						$('#formVendedor')[0].reset();
						mostrarVendedor();
					}
				});
			}
		});


		$('#tabla_vendedor').on('click','.item-edit', function(){

			var id = $(this).attr('data');

			$('#modalGuardar').modal('show');

			$('#modalGuardar').find('.modal-title').text('Modificar Vendedor');

			$('#formVendedor').attr('action','<?= base_url('vendedor_controller/actualizar') ?>');

			$.ajax({

				type: 'ajax',
				method: 'post',
				url: '<?= base_url('vendedor_controller/get_datos') ?>',
				data: {id:id},
				dataType: 'json',

				success: function(datos){

					$('#id').val(datos.id_vendedor);
					$('#nombre').val(datos.nombre);
					$('#apellido').val(datos.apellido);
					$('#categoria').val(datos.id_categoria);
					$('#sexo').val(datos.id_sexo);
				}
			});
		});


		function validacion(){

			$nombre    = $('#nombre').val();
			$apellido  = $('#apellido').val();
			$categoria = $('#categoria option:selected').val();
			$sexo      = $('#sexo option:selected').val();

			if ($nombre.length == 0) {

				$('#nombre').css('boxShadow','inset 0 0 15px red');
				$('#nombre').attr('placeholder','Este campo es obligatorio');
				return false;

			} else {

				$('#nombre').css('boxShadow','inset 0 0 15px green');
			}


			if ($apellido.length == 0) {

				$('#apellido').css('boxShadow','inset 0 0 15px red');
				$('#apellido').attr('placeholder','Este campo es obligatorio');
				return false;

			} else {

				$('#apellido').css('boxShadow','inset 0 0 15px green');
			}

			if ($categoria == 0) {

				$('#categoria').css('boxShadow','inset 0 0 15px red');
				$('#categoria').attr('placeholder','Este campo es obligatorio');
				return false;

			} else {

				$('#categoria').css('boxShadow','inset 0 0 15px green');
			}


			if ($sexo == 0) {

				$('#sexo').css('boxShadow','inset 0 0 15px red');
				$('#sexo').attr('placeholder','Este campo es obligatorio');
				return false;

			} else {

				$('#sexo').css('boxShadow','inset 0 0 15px green');
			}

			return true;
		};



	});





</script>