<style>
	.tdFechas{
		display: none;
	}
</style>
<h2>Ver Apuestas de <?php foreach($nombre as $nombre) { ?>
                    <span id="nombresPrint"><?php echo $nombre->nombre; ?> <?php echo $nombre->apellido; ?></span>
                        
            <?php } ?></h2>
<div class="panel panel-default">
    <div class="panel-heading">
    <table>
      <tr>
        <td style="width: 100%; float: right;" align="right">
          <table style="width: 100%; float: right;" align="right">
            <tr>
              <td><span style="margin-right: 10px;">ELIJA UNA OPCION: </span></td>
              <td>
                <select class="form-control" id="apuestas" style="width: auto !important;margin-right: 20px;">
                  <option value="0">Todas las apuestas</option>
                  <option value="1">Apuestas por fecha</option>
                </select>
              </td>
              <td class="tdFechas"><label for="apuesta_desde" style="margin: 5px;">DESDE</label></td>
              <td class="tdFechas">
                <input type="text" class="datepicker form-control" readonly id="apuesta_desde" style="width: 100px !important;margin-right: 4px;">
              </td>
              <td class="tdFechas"><label for="apuesta_hasta" style="margin: 5px;">HASTA</label></td>
              <td class="tdFechas">
              	<input hidden id="idclienteapuestas" value="<?php echo $id ?>">
                <input type="text" class="datepicker form-control" readonly id="apuesta_hasta" style="width: 100px !important;margin-right: 20px;">
              </td>
              <input hidden id="nro_agencia" value="<?php echo $agencia ?>">
              <td><button style="margin-right: 20px;" type="button" class="btn btn-primary" id="btnFiltrarApuestas"><i class="glyphicon glyphicon-search"></i></button></td>
              <td><button style="margin-right: 20px;" type="button" class="btn btn-success" id="btnAgregarApuestas" data-target="#modal-addapuesta" data-toggle="modal">Agregar Apuestas</button></td>
              <td><button style="margin-right: 20px;" type="button" class="btn btn-warning" onclick="javascript:history.back()">Volver</button></td>
              <td><button type="button" onclick="printDivAll()" class="btn btn-secondary" id="btnPrintAll">Imprimir <i class="glyphicon glyphicon-print"></i></button></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  <!-- código pañol – código evhsa – denominación – fecha comprado - valor -->
  <div class="row">
    <div class="col-md-12">
		<section style="margin-top: 10px; max-height: 350px; overflow-y: scroll;" id="DivIdToPrint">
	    	<table class="table table-striped" style="width: 100% !important;" >
	          <thead>
	            <tr>
	              <th>FECHA</th>
	              <th>DEBE</th>
	              <th>HABER</th>
	              <th>SALDO</th>
	              <th class="no-print">ACCIONES</th>
	            </tr>
	          </thead>
	          <tbody id="tbodyapuestas">
	            
	          </tbody>
	        </table>
    	</section>
    </div><!--div col xs12 -->
  </div><!--div row -->
</div>

<div class="modal fade bd-example-modal-lg" id="modal-addapuesta">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar apuesta</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="<?php echo base_url(); ?>home/addapuesta" method="POST">
          <div class="container">
            <div class="row">
              <input hidden id="id_apuesta">
              <input hidden id="agencia_cliente" value="<?php echo $agencia; ?>">
              <div class="col-md-2" style="margin-right: 10px;">
                <div class="form-group">
                  <label>Fecha</label>
                  <input type="text" id="fechadeapuesta" class="form-control"></input>
                </div>
              </div>
              <div class="col-md-2" style="margin-right: 10px;">
                <div class="form-group">
                  <label>Jugo</label>
                  <input id="jugo_apuesta" type="text" class="form-control"></input>
                </div>
              </div>
              <div class="col-md-2" style="margin-right: 10px;">
                <div class="form-group">
                  <label>Pago</label>
                  <input id="pago_apuesta" type="text" class="form-control"></input>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div id="ingrese"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" id="add_apuesta" class="btn btn-primary pull-right">Guardar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="modal-edit-apuesta">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar apuesta</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          <div class="container">
            <div class="row">
              <input hidden id="id_apuesta_edit">
              <div class="col-md-2" style="margin-right: 10px;">
                <div class="form-group">
                  <label>Fecha</label>
                  <input type="text" id="editfechadeapuesta" class="form-control"></input>
                </div>
              </div>
              <div class="col-md-2" style="margin-right: 10px;">
                <div class="form-group">
                  <label>Jugo</label>
                  <input id="editjugo_apuesta" type="text" class="form-control"></input>
                </div>
              </div>
              <div class="col-md-2" style="margin-right: 10px;">
                <div class="form-group">
                  <label>Pago</label>
                  <input id="editpago_apuesta" type="text" class="form-control"></input>
                </div>
              </div>
            </div>
          </div>
        </form>
        <div id="ingrese"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
        <button type="button" id="btn_editar_apuesta" class="btn btn-primary pull-right">Guardar</button>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script>
  $( document ).ready(function() {
    var id = $("#idclienteapuestas").val();
    $.post('<?php echo base_url(); ?>home/getAllApuestas',
    {
        id: id
    },
    function(data){
        var c = JSON.parse(data);
        if(c.apuestas.length != 0){
            var apuestas = c.apuestas;
            var jugo1 = apuestas[0].jugo;
            var pago1 = apuestas[0].pago;
            var primersaldo = jugo1 - pago1;
            $.each(apuestas, function(i, item){
                var fecha = item.fecha;
                    fecha = fecha.substring(8,10) + '-' + fecha.substring(5,7) + '-' + fecha.substring(0,4);
                $("#tbodyapuestas").append(
                    '<tr class="teerre">'+
                        '<td class="to-print">'+fecha+'</td>'+
                        '<td class="debe to-print">'+item.jugo+'</td>'+
                        '<td class="haber to-print">'+item.pago+'</td>'+
                        '<td class="saldo to-print"></td>'+
                        '<td class="no-print">'+
                            '<button onclick="borrar_apuesta('+item.id_ap+');" style="margin-right: 10px;" type="button" class="btn btn-danger">'+
                                '<i class="glyphicon glyphicon-trash"></i>'+
                            '</button>'+
                            '<button onclick="editar_apuesta('+item.id_ap+', \''+fecha+'\', '+item.jugo+', '+item.pago+')" type="button" class="btn btn-warning">'+
                                '<i class="glyphicon glyphicon-pencil"></i>'+
                            '</button>'+
                        '</td>'+
                    '</tr>'
                );

                if (i == 0){
                    $("#tbodyapuestas > tr:nth-child(1) > td:nth-child(4)").html(primersaldo);
                } else {
                    var debe = $("#tbodyapuestas > tr:nth-child("+(i+1)+") > td:nth-child(2)").text();
                    var haber = $("#tbodyapuestas > tr:nth-child("+(i+1)+") > td:nth-child(3)").text();
                    debe = parseFloat(debe);
                    haber = parseFloat(haber);
                    saldo = debe - haber;
                    var saldo_ant = $("#tbodyapuestas > tr:nth-child("+i+") > td:nth-child(4)").text();
                    saldo = parseFloat(saldo_ant) + saldo;
                    $('#tbodyapuestas > tr:nth-child('+(i+1)+') > td:nth-child(4)').html(saldo);
                }
            });
        }
    });
    editar_apuesta = function(id, fecha, jugo, pago){
      $("#modal-edit-apuesta").modal('show');
      $("#id_apuesta_edit").val(id);
      $("#editfechadeapuesta").val(fecha);
      $("#editjugo_apuesta").val(jugo);
      $("#editpago_apuesta").val(pago);
    }

    $("#btn_editar_apuesta").click(function(){
      var id_cliente = $("#id_apuesta_edit").val();
      var fecha = $("#editfechadeapuesta").val();
      fecha = fecha.substring(6,10) + '-' + fecha.substring(3,5) + '-' + fecha.substring(0,2);
      var jugo = $("#editjugo_apuesta").val();
      var pago = $("#editpago_apuesta").val();
      $.post('<?php echo base_url(); ?>home/saveApuestaEditada',
      {
        id: id_cliente,
        fecha: fecha,
        jugo: jugo,
        pago: pago
      },
      function(data){
        if(data == 1){

          location.reload();
        }
      });
    });
  });

  $("#btnAgregarApuestas").click(function(){
    var date = new Date();
    var dia = date.getDate();
    if(dia < 10){
      dia = '0'+dia
    }
    var mes = date.getMonth() + 1;
    if(mes < 10){
      mes = '0'+mes
    }
    if(mes > 12){
      mes = '01';
    }
    var year = date.getFullYear();
    var fecha = dia + '-' + mes + '-' + year;
    $("#fechadeapuesta").val(fecha);
    $("#jugo_apuesta").val(0);
    $("#pago_apuesta").val(0);
  });
</script>