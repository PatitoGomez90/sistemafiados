<h2>Ver Clientes</h2>
<div class="panel panel-default">
    <div class="panel-heading">
    <table>
      <tr>
        <td style="width: 100%; float: right;" align="right">
          <table style="width: 100%; float: right;" align="right">
            <tr>
              <!-- <td>Filtrar&nbsp;</td> -->
              <td><span style="margin-right: 10px;">ELIJA UNA OPCION: </span></td>
              <td>
                <select class="form-control" id="agencia" style="width: auto !important; margin-right: 10px;">
                  <option value="0">Todas las agencias</option>
                  <option value="agencia1">Agencia 1</option>
                  <option value="agencia2">Agencia 2</option>
                  <option value="agencia3">Agencia 3</option>
                  <option value="agencia4">Agencia 4</option>
                </select>
              </td>
              <td><button type="button" class="btn btn-primary" id="btnFiltrarClientes"><i class="glyphicon glyphicon-search"></i></button></td>
              <td class="pull-right"  style="margin-left: 10px;">
                <div class="pull-right">
                  <button type="button" class="btn btn-success" id="btnAddCliente" data-target="#modal-add-cliente" data-toggle="modal">Agregar Cliente</button>
                </div>  
              </td>
              <td style="width: 300px;"></td>
              <td><span style="margin-right: 5px;" id="tdAgencias"><strong>Saldo de la Agencia</strong></span></td>
              <td><input type="text" class="form-control" id="saldoAgencia"></input></td>
              <td><span style="margin-right: 5px;" id="tdTodaslasAgencias"><strong>Saldo de todas las Agencias</strong></span></td>
              <td><input type="text" class="form-control" id="saldotodaslasAgencias"></input></td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
  <!-- código pañol – código evhsa – denominación – fecha comprado - valor -->
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <table class="table table-striped" id="tabla-clientes" style="width: 100% !important;">
            <thead>
              <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>APELLIDO</th>
                <th>TELEFONO</th>
                <th>AGENCIA</th>
                <th>SALDO</th>
                <th>Fecha Ult Apuesta</th>
                <th>ACCIONES</th>
              </tr>
            </thead>
            <tbody id="tbodyclientes">
              
            </tbody>
          </table>
      </div><!--div col xs12 -->
    </div><!--div row -->
  </div>
</div>

<div class="modal fade" id="modal-add-cliente">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Cliente</h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
              <div class="box-body">
                  <div class="form-group">
                      <label for="nombre" class="col-sm-2 control-label">Agencia</label>
                      <div class="col-sm-6">
                          <select class="form-control" name="agencia" id="addagencia" placeholder="Seleccione una agencia">
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
                          <input type="text" style="text-transform: uppercase;" class="form-control" name="nombre" id="addnombre" placeholder="Nombre" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="apellido" class="col-sm-2 control-label">Apellido</label>
                      <div class="col-sm-6">
                          <input type="text" style="text-transform: uppercase;" name="apellido" class="form-control" id="addapellido" placeholder="Apellido" required>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="telefono" class="col-sm-2 control-label">Telefono</label>
                      <div class="col-sm-6">
                          <input type="text" name="telefono" class="form-control" id="addtelefono" placeholder="Telefono" required>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnsubmitcliente">Agregar</button>
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
        <form class="form-horizontal">
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