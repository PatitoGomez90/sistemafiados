</div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="<?php echo base_url(); ?>assets/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url(); ?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url(); ?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url(); ?>assets/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
<script>
$(function () {
	Date.prototype.yyyymmdd = function() {
	  var mm = this.getMonth() + 1; // getMonth() is zero-based
	  var dd = this.getDate();

	  return [this.getFullYear()+'-',
	          (mm>9 ? '' : '0') + mm +'-',
	          (dd>9 ? '' : '0') + dd
	         ].join('');
	};

	var date = new Date();
	var fecha_actual = date.yyyymmdd();
	$("#fecha").val(fecha_actual);
	$('#fecha').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true 
	});

	$("#add_apuesta").click(function(){
		$("#ingrese").html('');
		var id = $("#id_apuesta").val();
		var fecha = $("#fecha").val();
		var jugo = $("#jugo_apuesta").val();
		var pago = $("#pago_apuesta").val();
		if(jugo == 0 && pago == 0){
		$("#ingrese").append('<p>Ingrese al menos un registro</p>');
		} else {
			$.post("<?php echo base_url(); ?>home/guardarapuesta",
				{
					id: id,
					fecha: fecha,
					jugo: jugo,
					pago: pago,
					saldo: 0 
				},
				function(data){
					if(data == 1){
						$(".modal").modal('hide');
						$("#guardareditado").hide();
						$("#hola").html('');
						$.post("<?php echo base_url(); ?>home/saldo",
							{id: id},
							function(data){
								var c = JSON.parse(data);
								// $("#cliente").val(' '+nombre+' '+apellido);
								$("#saldo-total").val(c[0].saldo);
							}
						);
							
						$.post("<?php echo base_url(); ?>home/apuestas",
							{ id: id },
							function(data){
								var c = JSON.parse(data);
								$.each(c, function(i, item){
									console.log('id ap '+item.id_ap);
									console.log('id apuesta '+item.id_apuesta)
									var saldo = item.saldo;
									$("#hola").append(
										'<tr>'+
											'<td><input style="background-color: transparent; border: none;" class="inp'+item.id_ap+' form-control" id="inp1'+item.id_ap+'" value="'+item.fecha+'" readonly></td>'+
											'<td><input style="background-color: transparent; border: none;" class="inp'+item.id_ap+' form-control" id="inp2'+item.id_ap+'" value="'+item.jugo+'" readonly></td>'+
											'<td><input style="background-color: transparent; border: none;" class="inp'+item.id_ap+' form-control" id="inp3'+item.id_ap+'" value="'+item.pago+'" readonly></td>'+
											'<td>'+
												'<a href="#" onClick="borra_id_apuesta('+item.id_ap+');" style="margin-right:5px;" class="btn btn-danger"><i class="fa fa-trash"></i></a>'+
												'<a href="#" onClick="edita_id_apuesta('+item.id_ap+', '+item.id_apuesta+', \''+item.fecha+'\', '+item.jugo+', '+item.pago+');" class="btn btn-warning"><i class="fa fa-pencil"></i></a>'+
											'</td>'+
										'</tr>'
									);
									
								});
								$("#modal-saldos").modal('show');
							}
						);
						
					}
				}
			);
		}
	});

	$("#btn_ver").click(function(){
		var agencia = $("#agencia").val();
		$("#tabla").show();
		$('#example1').DataTable({
			"language": {
	            "lengthMenu": "Mostrando _MENU_ registros",
	            "zeroRecords": "No se han encontrado registros",
	            "info": "Mostrando _PAGE_ de _PAGES_",
	            "infoEmpty": "No hay registros",
	            "search": "Buscar",
	            "paginate": {
			      	"previous": "Anterior",
			      	"next": "Siguiente"
			    }
	        },
			'paging': true,
			'info': true,
			'filter': true,
			'stateSave': true,
			'bDestroy': true,
			'ajax': {
				'url': '<?php echo base_url(); ?>home/getClientes/'+agencia,
				'type': 'POST',
				dataSrc: ''
			},
			'columns': [
				{data: 'id_cliente'},
				{data: 'nombre', 'sClass': 'mayus'},
				{data: 'apellido', 'sClass': 'mayus'},
				{data: 'telefono'},
				{'orderable': true,
					render:function(data, type, row){
						return 	'<a href="#" style="margin-right:5px;" onClick="id_cliente(\''+row.id_cliente+'\',\''+row.nombre+'\',\''+row.apellido+'\')" class="btn btn-success" data-target="#modal-saldos" data-toggle="modal"><i class="fa fa-search"></i></a>'+
								'<a href="#" style="margin-right:5px;" onClick="id_apuesta(\''+row.id_cliente+'\',\''+row.nombre+'\',\''+row.apellido+'\')" data-target="#modal-addapuesta" data-toggle="modal" class="btn btn-primary"><i class="fa fa-plus"></i></a>'+
								'<a href="#" style="margin-right:5px;" onClick="delCliente(\''+row.id_cliente+'\')" class="btn btn-danger" data-target="#modal-delete" data-toggle="modal"><i class="fa fa-trash"></i></a>'+
								'<a href="#" style="margin-right:5px;" onClick="editPersona(\''+row.id_cliente+'\',\''+row.nombre+'\',\''+row.apellido+'\',\''+row.telefono+'\')" class="btn btn-warning" data-target="#modal-edit" data-toggle="modal"><i class="fa fa-pencil"></i></a>'
					}
				}
			],
			"order": [[ 0, "asc" ]],
		});
	});

	selPersona = function(id, nombre, apellido, telefono){
		$("#id_del_cliente").val(id);
		$("#nombre").val(nombre);
		$("#apellido").val(apellido);
		$("#telefono").val(telefono);
	}

	delCliente = function(id){
		$("#id_cliente_delete").val(id);
	};

	id_apuesta = function(id, nombre, apellido){
		console.log('holaa id '+id);
		$("#id_apuesta").val(id);
		$('#jugo_apuesta').click(function(){
			$(this).select();	
		});
		$("#jugo_apuesta").val(0);
		$('#pago_apuesta').click(function(){
			$(this).select();	
		});
		$("#pago_apuesta").val(0);
		$("#cliente").val(nombre+' '+apellido);
	}

	id_cliente = function(id, nombre, apellido){
		$("#guardareditado").hide();
		$("#hola").html('');
		$.post("<?php echo base_url(); ?>home/saldo",
			{id: id},
			function(data){
				var c = JSON.parse(data);
				$("#cliente").val(' '+nombre+' '+apellido);
				$("#saldo-total").val(c[0].saldo);
			}
		);
			
		$.post("<?php echo base_url(); ?>home/apuestas",
			{ id: id },
			function(data){
				var c = JSON.parse(data);
				$.each(c, function(i, item){
					var saldo = item.saldo;
					$("#hola").append(
						'<tr>'+
							'<td><input style="background-color: transparent; border: none;" class="inp'+item.id_ap+' form-control" id="inp1'+item.id_ap+'" value="'+item.fecha+'" readonly></td>'+
							'<td><input style="background-color: transparent; border: none;" class="inp'+item.id_ap+' form-control" id="inp2'+item.id_ap+'" value="'+item.jugo+'" readonly></td>'+
							'<td><input style="background-color: transparent; border: none;" class="inp'+item.id_ap+' form-control" id="inp3'+item.id_ap+'" value="'+item.pago+'" readonly></td>'+
							'<td>'+
								'<a href="#" onClick="borra_id_apuesta('+item.id_ap+');" style="margin-right:5px;" class="btn btn-danger"><i class="fa fa-trash"></i></a>'+
								'<a href="#" onClick="edita_id_apuesta('+item.id_ap+', '+item.id_apuesta+', \''+item.fecha+'\', '+item.jugo+', '+item.pago+');" class="btn btn-warning"><i class="fa fa-pencil"></i></a>'+
							'</td>'+
						'</tr>'
					);
					
				});
			}
		);
	}

	borra_id_apuesta = function(id){
		$.post("<?php echo base_url(); ?>home/borra_id_apuesta",
			{ id: id },
			function(data){
				if(data == 1){
					$(".modal").modal('hide');
				}
			}
		)
	}

	edita_id_apuesta = function(id_ap, id_apuesta, fecha, jugo, pago){

		$("#stack1").modal('show');
		$("#id_de_la_ap").val(id_ap);
		$("#id_de_la_apuesta").val(id_apuesta);
		$("#editfecha").val(fecha);
		$("#editjugo").val(jugo);
		$("#editpago").val(pago);

		$("#guardar_apuesta_editada").click(function(){
			var id_ap = $("#id_de_la_ap").val();
			var id_apuesta = $("#id_de_la_apuesta").val();
			var fecha = $("#editfecha").val();
			fecha = fecha.substring(6, 10) + '-' + fecha.substring(3, 5) + '-' + fecha.substring(0, 2);
			var jugo = $("#editjugo").val();
			var pago = $("#editpago").val();

			$.post("<?php echo base_url(); ?>home/edita_id_apuesta",
				{ 
					id_ap: id_ap,
					id_apuesta: id_apuesta,
					fecha: fecha,
					jugo: jugo,
					pago: pago
				},
				function(data){
					if(data == 1){
						$(".modal").modal('hide');
						$("#stack1").modal('hide');
					}
				}
			)
		});
	}

	// LISTO
	editPersona = function(id, nombre, apellido, telefono){
		$("#id_del_cliente").val(id);
		$("#editnombre").val(nombre);
		$("#editapellido").val(apellido);
		$("#edittelefono").val(telefono);
	}

	// FALTA HACER
	saldoCliente = function(nombre, apellido){
		$("#cliente").html(' '+nombre+' '+apellido);
	}



	// LISTO
	$("#btn-borrar-cliente").click(function(){
		var id = $("#id_cliente_delete").val();
		$.post("<?php echo base_url(); ?>home/delete",
			{ id: id },
			function(data){
				if (data == 1){
					$.post("<?php echo base_url(); ?>home/deleteapuesta",
					{ id: id },	
					function(data){
						if (data == 1){
							$('#example1').DataTable().ajax.reload();
						}
					});
				}
			}
		);
	});

	// LISTO
	$('#btn-editcliente').click(function(){
		var id = $("#id_del_cliente").val();
		var nombre = $('#editnombre').val();
		var apellido = $('#editapellido').val();
		var telefono = $('#edittelefono').val();
		$.post("<?php echo base_url(); ?>home/editarcliente",	
		{
			id: id,
			nombre: nombre,
			apellido: apellido,
			telefono: telefono
		},			
		function(data){
			if (data == 1) {
				$(".modal").modal('hide');
				$('#example1').DataTable().ajax.reload();
			}
		});
	});
});
	


</script>
</body>
</html>