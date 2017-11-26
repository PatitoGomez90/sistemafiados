<style>
  
  label {
    width: 80px !important;
  }

  .box-footer {
    padding-left: 300px !important;
  }

</style>
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Consultar Saldo de Cliente</h3>
    </div>
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
                <label for="nombre" class="col-sm-2 control-label">Cliente</label>
                <div class="col-sm-6">
                    <select class="form-control" name="cliente" id="cliente" placeholder="Seleccione un cliente">
                        <option value="agencia1">Agencia 1</option>
                        <option value="agencia2">Agencia 2</option>
                        <option value="agencia3">Agencia 3</option>
                        <option value="agencia4">Agencia 4</option>
                    </select>
                    <!-- <input type="text" style="text-transform: uppercase;" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required> -->
                </div>
            </div>
            <div class="form-group">
                <label for="apellido" class="col-sm-2 control-label">Desde</label>
                <div class="col-sm-6">
                    <input type="text" style="text-transform: uppercase;" name="apellido" class="form-control" id="apellido" placeholder="Apellido" required>
                </div>
            </div>
            <div class="form-group">
                <label for="apellido" class="col-sm-2 control-label">Hasta</label>
                <div class="col-sm-6">
                    <input type="text" name="telefono" class="form-control" id="apellido" placeholder="Telefono" required>
                </div>
            </div>
        </div>
        <div class="box-footer">
        <button type="submit" class="btn btn-primary">Consultar</button>
        </div>
    </form>
</div>