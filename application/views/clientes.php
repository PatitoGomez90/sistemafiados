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
<div class="box" style="border-top: none !important;">
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
            <th>Agencia</th>
            <th>Saldo</th>
            <th>Acciones</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($clientes->result() as $cliente) { ?>
            <tr>
              <td><?php echo $cliente->id_cliente ?></td>
              <td><?php echo $cliente->nombre ?></td>
              <td><?php echo $cliente->apellido ?></td>
              <td><?php echo $cliente->telefono ?></td>
              <td><?php echo $cliente->agencia ?></td>
              <td><?php echo $cliente->saldo ?></td>
              <td>
                <a href="<?php echo base_url(); ?>home/delete/<?php echo $cliente->id_cliente; ?>">
                  <button type="button" class="btn btn-danger">
                    <span class="glyphicon glyphicon-trash"></span>
                  </button>
                </a> 
                <a href="#">
                  <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default">
                    <span class="glyphicon glyphicon-pencil"></span>
                  </button>
                </a>
                <a href="<?php echo base_url(); ?>home/vercuenta/<?php echo $cliente->id_cliente; ?>">
                  <button type="button" class="btn btn-success">
                    <span class="glyphicon glyphicon-search"></span>
                  </button>
                </a>
              </td>
            </tr>
          <?php } ?>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- box -->

    <div class="modal fade" id="modal-default">
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
                  <label for="nombre" class="col-sm-2 control-label">Nombre</label>
                  <div class="col-sm-6">
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="apellido" class="col-sm-2 control-label">Apellido</label>
                  <div class="col-sm-6">
                    <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="apellido" class="col-sm-2 control-label">Telefono</label>
                  <div class="col-sm-6">
                    <input type="text" name="telefono" class="form-control" id="apellido" placeholder="Telefono" required>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary">Guardar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->