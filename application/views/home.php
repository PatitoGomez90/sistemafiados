<div class="box box-info">
	<div class="container">
		<div class="col-md-10" style="margin-bottom: 30px;">
			<h1>Elija una Agencia</h1>
			<div class="col-md-10">
				<form class="form-horizontal" role="form">
					<div class="row">
						<div class="col-md-4">
						<select class="form-control" name="agencia" id="agencia">
							<option value="agencia1">AGENCIA 1</option>
							<option value="agencia2">AGENCIA 2</option>
							<option value="agencia3">AGENCIA 3</option>
							<option value="agencia4">AGENCIA 4</option>
						</select>
						</div>
						<div class="col-md-4">
							<button type="button" id="btn_ver" class="btn btn-primary">Ver</button>
							<button type="button" id="btn_agregar_cliente" class="btn btn-success" data-target="#modal-add" data-toggle="modal">Agregar Cliente</button>	
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="box" id="tabla" style="margin-top: 20px; display: none;">
      	<div class="box-header">
        	<h3 class="box-title">Clientes
      	</div>
      	<!-- /.box-header -->
     	<div class="box-body">
        	<table id="example1" class="table table-bordered table-striped">
          		<thead>
          			<tr>
            			<th>ID</th>
			            <th>Nombre</th>
			            <th>Apellido</th>
			            <th>Telefono</th>
			            <th>Acciones</th>
          			</tr>
          		</thead>
          		<tbody>
          		</tbody>
        	</table>
      	</div>
      	<!-- /.box-body -->
    </div>
</div>

<style>
    .example-modal .modal {
      position: relative;
      top: auto;
      bottom: auto;
      right: auto;
      left: auto;
      display: block;
      z-index: 1;
    }

    .example-modal .modal {
      background: transparent !important;
    }
  </style>

<div class="modal fade" id="modal-delete">
	<div class="modal-dialog modal-sm">
		<div class="modal-content panel-warning">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST">
					<div class="box-body">
						<div class="box box-info">
							<div class="box-header">
								<input type="hidden" id="id_cliente_delete">
							</div>
							<div class="box-body" style="text-center">
								<h4>Esta seguro que desea eliminar este cliente?</h4>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
				<button type="button" id="btn-borrar-cliente" class="btn btn-success pull-right" data-dismiss="modal">Aceptar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Agregar Cliente</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="<?php echo base_url(); ?>home/addcliente" method="POST">
			        <div class="box-body">
			            <div class="form-group">
			                <label for="nombre" class="col-sm-2 control-label">Agencia</label>
			                <div class="col-sm-6">
			                    <select class="form-control" name="agencia" id="agencia" placeholder="Seleccione una agencia">
			                        <option value="agencia1">Agencia 1</option>
			                        <option value="agencia2">Agencia 2</option>
			                        <option value="agencia3">Agencia 3</option>
			                        <option value="agencia4">Agencia 4</option>
			                    </select>
			                </div>
			            </div>
			            <div class="form-group">
			                <label for="nombre" class="col-sm-2 control-label">Nombre</label>
			                <div class="col-sm-6">
			                    <input type="text" style="text-transform: uppercase;" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
			                </div>
			            </div>
			            <div class="form-group">
			                <label for="apellido" class="col-sm-2 control-label">Apellido</label>
			                <div class="col-sm-6">
			                    <input type="text" style="text-transform: uppercase;" name="apellido" class="form-control" id="apellido" placeholder="Apellido" required>
			                </div>
			            </div>
			            <div class="form-group">
			                <label for="apellido" class="col-sm-2 control-label">Telefono</label>
			                <div class="col-sm-6">
			                    <input type="text" name="telefono" class="form-control" id="apellido" placeholder="Telefono" required>
			                </div>
			            </div>
			        </div>
			        <div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
						<button type="submit" id="btn-addcliente" class="btn btn-primary">Agregar</button>
					</div>
			    </form>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Editar Cliente</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="<?php echo base_url(); ?>home/editarcliente" method="POST">
					<div class="box-body">
						<div class="form-group">
							<input type="hidden" id="id_del_cliente">
							<label for="nombre" class="col-sm-2 control-label">Nombre</label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="nombre" id="editnombre" placeholder="Nombre" required>
							</div>
						</div>
						<div class="form-group">
							<label for="apellido" class="col-sm-2 control-label">Apellido</label>
							<div class="col-sm-6">
								<input type="text" name="apellido" class="form-control" id="editapellido" placeholder="Apellido" required>
							</div>
						</div>
						<div class="form-group">
							<label for="apellido" class="col-sm-2 control-label">Telefono</label>
							<div class="col-sm-6">
								<input type="text" name="telefono" class="form-control" id="edittelefono" placeholder="Telefono" required>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
				<button type="button" id="btn-editcliente" class="btn btn-primary">Guardar</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bd-example-modal-lg" id="modal-saldos">
	<div class="modal-dialog modal-lg" style="overflow-y: initial !important;">
		<div class="modal-content">
			<div class="modal-header" style="padding: 0; border-bottom: 1px solid #BBD4EA;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span></button>
				<div class="col-md-12">
					<div class="modal-title">
						<form class="form-horizontal" role="form">
							<div class="row">
								<div class="col-md-5">
								    <div class="form-group">
								        <label for="saldo-total" class="col-md-3 control-label"><span style="font-size: 20px;">Cliente: </span></label>
										<div class="col-md-6">
										  <input type="text" style="text-transform: uppercase;" class="form-control" id="cliente" readonly>
										</div>
								    </div>
								</div>
								<div class="col-md-5 pull-right">
								    <div class="form-group">
								      <label for="saldo-total" class="col-md-3 control-label"><span style="font-size: 20px;">Saldo: </span></label>
								      <div class="col-md-6">
								          <input type="text" class="form-control" id="saldo-total" readonly>
								      </div>
								    </div>
							    </div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="modal-body" style="height: 400px; overflow-y: auto;">
				<form class="form-horizontal">
					<table id="apuestas1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Fecha</th>
								<th>Jugo</th>
								<th>Pago</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody id="hola">

						</tbody>
					</table>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
				<button type="button" class="btn btn-success pull-right" style="display: none;" id="guardareditado">Guardar</button>
			</div>
		</div>
	</div>
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
							<div class="col-md-2" style="margin-right: 10px;">
								<div class="form-group">
									<label>Fecha</label>
									<input type="text" id="fecha" class="form-control"></input>
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

<div id="stack1" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		  <div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		    <h4 class="modal-title">Editar Apuesta</h4>
		  </div>
  <div class="modal-body">
    <form class="form-horizontal">
		<div class="box-body">
			<div class="form-group">
				<input type="hidden" id="id_de_la_apuesta">
				<input type="hidden" id="id_de_la_ap">
				<label for="nombre" class="col-sm-2 control-label">Fecha</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" name="editfecha" id="editfecha">
				</div>
			</div>
			<div class="form-group">
				<label for="apellido" class="col-sm-2 control-label">Jugo</label>
				<div class="col-sm-6">
					<input type="text" name="editjugo" class="form-control" id="editjugo">
				</div>
			</div>
			<div class="form-group">
				<label for="apellido" class="col-sm-2 control-label">Pago</label>
				<div class="col-sm-6">
					<input type="text" name="editpago" class="form-control" id="editpago">
				</div>
			</div>
		</div>
	</form>
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-danger">Cerrar</button>
    <button type="button" id="guardar_apuesta_editada" class="btn btn-success">Guardar</button>
  </div>
  </div>
  </div>
</div>
 
<div id="stack2" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Stack Two</h4>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
    <p>One fine body…</p>
    <input class="form-control" type="text" data-tabindex="1">
    <input class="form-control" type="text" data-tabindex="2">
    <button class="btn btn-default" data-toggle="modal" href="#stack3">Launch modal</button>
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
    <button type="button" class="btn btn-primary">Ok</button>
    </div>
</div>
  </div>
</div>
 
<div id="stack3" class="modal fade" tabindex="-1" data-focus-on="input:first" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h4 class="modal-title">Stack Three</h4>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
    <input class="form-control" type="text" data-tabindex="1">
    <input class="form-control" type="text" data-tabindex="2">
  </div>
  <div class="modal-footer">
    <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
    <button type="button" class="btn btn-primary">Ok</button>
  </div>
  </div>
  </div>
</div>

