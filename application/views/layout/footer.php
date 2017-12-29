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

$( document ).ready(function() {
    $.post('<?php echo base_url(); ?>home/getSaldoTodaslasAgencias',
        function(data){
            var c = JSON.parse(data);
            var saldoAllAgencias = c[0].saldoTotalAgencias;
            if(saldoAllAgencias != null){
                $("#saldotodaslasAgencias").val('$ '+saldoAllAgencias);
            }
        });
    $("#saldoAgencia").val('');
    $("#tdAgencias").hide();
    $("#saldoAgencia").hide();
    $('#tabla-clientes').DataTable({
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
            'url': '<?php echo base_url(); ?>home/getAllClientes',
            'type': 'POST',
            dataSrc: ''
        },
        'columns': [
            {data: 'id_cliente'},
            {data: 'nombre', 'sClass': 'mayus'},
            {data: 'apellido', 'sClass': 'mayus'},
            {data: 'telefono'},
            {data: 'agencia'},
            {data: 'saldo'},
            {data: 'ultimafecha'},
            {'orderable': true,
                render:function(data, type, row){
                    return '<a href="<?php echo base_url(); ?>apuestas/'+row.id_cliente+'/'+row.agencia+'" style="margin-right:5px;" class="btn btn-success"><i class="fa fa-search"></i></a>'+
                           '<a onclick="borrar_cliente('+row.id_cliente+')" style="margin-right:5px;" class="btn btn-danger"><i class="fa fa-trash"></i></a>'+
                           '<a onClick="editarcliente(\''+row.id_cliente+'\',\''+row.nombre+'\',\''+row.apellido+'\',\''+row.telefono+'\')" data-target="#modal-edit" data-toggle="modal" style="margin-right:5px;" class="btn btn-warning"><i class="fa fa-pencil"></i></a>';
                }
            }
        ],
        "order": [[ 0, "asc" ]],
    });
});

$(function () {

    // CLIENTES
    $("#btnFiltrarClientes").click(function(){
        $("#tdTodaslasAgencias").show();
        $("#saldotodaslasAgencias").show(); 
        $("#tdAgencias").hide();
        $("#saldoAgencia").hide();
        var agencia = $("#agencia").val();
        if(agencia == 0){
            $.post('<?php echo base_url(); ?>home/getSaldoTodaslasAgencias',
                function(data){
                    var c = JSON.parse(data);
                    var saldoAllAgencias = c[0].saldoTotalAgencias;
                    if(saldoAllAgencias != null){
                        $("#saldotodaslasAgencias").val('$ '+saldoAllAgencias);
                    } else {
                        alert('no');
                    }
                });
            $('#tabla-clientes').DataTable({
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
                    'url': '<?php echo base_url(); ?>home/getAllClientes',
                    'type': 'POST',
                    dataSrc: ''
                },
                'columns': [
                    {data: 'id_cliente'},
                    {data: 'nombre', 'sClass': 'mayus'},
                    {data: 'apellido', 'sClass': 'mayus'},
                    {data: 'telefono'},
                    {data: 'agencia'},
                    {data: 'saldo'},
                    {data: 'ultimafecha'},
                    {'orderable': true,
                        render:function(data, type, row){
                            return '<a href="<?php echo base_url(); ?>apuestas/'+row.id_cliente+'/'+row.agencia+'" style="margin-right:5px;" class="btn btn-success"><i class="fa fa-search"></i></a>'+
                                   '<a onclick="borrar_cliente('+row.id_cliente+')" style="margin-right:5px;" class="btn btn-danger"><i class="fa fa-trash"></i></a>'+
                                   '<a onClick="editarcliente(\''+row.id_cliente+'\',\''+row.nombre+'\',\''+row.apellido+'\',\''+row.telefono+'\')" data-target="#modal-edit" data-toggle="modal" style="margin-right:5px;" class="btn btn-warning"><i class="fa fa-pencil"></i></a>';
                        }
                    }
                ],
                "order": [[ 0, "asc" ]],
            });
        } else {
            $("#tdTodaslasAgencias").hide();
            $("#saldotodaslasAgencias").hide();
            $("#saldotodaslasAgencias").val('');
            $("#saldoAgencia").val('');
            $("#tdAgencias").show();
            $("#saldoAgencia").show();
            $.post('<?php echo base_url(); ?>home/getSaldoTotalAgencia',
            {
                agencia: agencia
            },
            function(data){
                var c = JSON.parse(data);
                var saldoTotal = c[0].saldoAgencia;
                if(saldoTotal != null){
                    $("#saldoAgencia").val('$ '+saldoTotal);    
                } else {
                    $("#saldoAgencia").val('$ '+0);
                }
            });
            $('#tabla-clientes').DataTable({
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
                    'url': '<?php echo base_url(); ?>home/getClientesByAgencia/'+agencia,
                    'type': 'POST',
                    dataSrc: ''
                },
                'columns': [
                    {data: 'id_cliente'},
                    {data: 'nombre', 'sClass': 'mayus'},
                    {data: 'apellido', 'sClass': 'mayus'},
                    {data: 'telefono'},
                    {data: 'agencia'},
                    {data: 'saldo'},
                    {data: 'ultimafecha'},
                    {'orderable': true,
                        render:function(data, type, row){
                            return '<a href="<?php echo base_url(); ?>apuestas/'+row.id_cliente+'/'+row.agencia+'" style="margin-right:5px;" class="btn btn-success"><i class="fa fa-search"></i></a>'+
                                   '<a onclick="borrar_cliente('+row.id_cliente+')" style="margin-right:5px;" class="btn btn-danger"><i class="fa fa-trash"></i></a>'+
                                   '<a onClick="editarcliente(\''+row.id_cliente+'\',\''+row.nombre+'\',\''+row.apellido+'\',\''+row.telefono+'\')" data-target="#modal-edit" data-toggle="modal" style="margin-right:5px;" class="btn btn-warning"><i class="fa fa-pencil"></i></a>';
                        }
                    }
                ],
                "order": [[ 0, "asc" ]],
            });
        }
    });

    $("#btnsubmitcliente").click(function(){
        var agencia = $("#addagencia").val();
        var nombre = $("#addnombre").val();
        var apellido = $("#addapellido").val();
        var telefono = $("#addtelefono").val();
        $.post('<?php echo base_url(); ?>home/agregarcliente',
        {
            agencia : agencia,
            nombre: nombre,
            apellido: apellido,
            telefono: telefono
        },
        function(data){
            if(data == 1){
                location.reload();
            }
        });
    });

    borrar_cliente = function(id){
        var r = confirm("Esta seguro que desea eliminar este cliente?");
        if (r == true) {
            $.post('<?php echo base_url(); ?>home/delete',
            {
                id: id     
            },
            function(data){
                if(data == 1){
                    $.post("<?php echo base_url(); ?>home/deleteapuesta",
                    { id: id }, 
                    function(data){
                        if (data == 1){
                            $('#tabla-clientes').DataTable().ajax.reload();
                        }
                    });
                }
            });
        }
    }

    // APUESTAS
    
    $("#apuesta_desde").datepicker({format: 'dd-mm-yyyy'});
    $("#apuesta_hasta").datepicker({format: 'dd-mm-yyyy'});
    $("#fechadeapuesta").datepicker({format: 'dd-mm-yyyy'});
    $("#add_apuesta").click(function(){
        $("#ingrese").html('');
        var id = $("#idclienteapuestas").val();
        console.log('id: '+id);
        var fecha = $("#fechadeapuesta").val();
        fecha = fecha.substring(6, 10) + '-' + fecha.substring(3, 5) + '-' + fecha.substring(0, 2);
        console.log('fecha: '+fecha);
        var jugo = $("#jugo_apuesta").val();
        console.log('jugo: '+jugo);
        var pago = $("#pago_apuesta").val();
        console.log('pago: '+pago);
        var agencia = $("#agencia_cliente").val();
        console.log('agencia: '+agencia);
        if(jugo == 0 && pago == 0){
            $("#ingrese").append('<p>Ingrese al menos un registro</p>');
        } else {
            $.post("<?php echo base_url(); ?>home/guardarapuesta",
                {
                    id: id,
                    fecha: fecha,
                    jugo: jugo,
                    pago: pago,
                    agencia: agencia
                },
                function(data){
                    if(data == 1){
                        location.reload();
                    }
                }
            );
        }
    });

    $("#apuestas").change(function(){
        var apuesta = $("#apuestas").val();
        if(apuesta == 1){
            $(".tdFechas").show();
        } else {
            $(".tdFechas").css('display','none');
        }
    });

    $("#btnFiltrarApuestas").click(function(){
        $("#tbodyapuestas").html('');
        var apuesta = $("#apuestas").val();
        var id = $("#idclienteapuestas").val();
        if(apuesta == 0){
            $("#btnPrintAll").show();
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
                        console.log(primersaldo);
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
                                        '<button onclick="editar_apuesta('+item.id_ap+', '+item.id_apuesta+', '+fecha+', '+item.jugo+', '+item.pago+')" type="button" class="btn btn-warning">'+
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
                    } else {
                        alert('no hay registros para este cliente');
                    }
                });
        } else {
            // por fecha
            var desde = $("#apuesta_desde").val();
            var hasta = $("#apuesta_hasta").val();
            desde = desde.substring(6,10) + '-' + desde.substring(3,5) + '-' + desde.substring(0,2);
            hasta = hasta.substring(6,10) + '-' + hasta.substring(3,5) + '-' + hasta.substring(0,2);
            $.post('<?php echo base_url(); ?>home/getApuestasByFecha',
                {
                    id: id,
                    desde: desde,
                    hasta: hasta
                },
                function(data){
                    var c = JSON.parse(data);
                    if(c.apuestas.length != 0){
                        var primersaldo = c.primersaldo[0].saldo;
                        if(primersaldo == 'null'){
                            primersaldo = 0;
                        }
                        var apuestas = c.apuestas;
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
                                        '<button onclick="borrar_apuesta('+item.id_ap+', '+item.id_apuesta+');" style="margin-right: 10px;" type="button" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>'+
                                        '<button onclick="editar_apuesta('+item.id_ap+', '+item.id_apuesta+', '+fecha+', '+item.jugo+', '+item.pago+')" type="button" class="btn btn-warning"><i class="glyphicon glyphicon-pencil"></i></button>'+
                                    '</td>'+
                                '</tr>'
                            );

                            if (i == 0){
                                var debe = $("#tbodyapuestas > tr:nth-child(1) > td:nth-child(2)").text();
                                var haber = $("#tbodyapuestas > tr:nth-child(1) > td:nth-child(3)").text();
                                debe = parseFloat(debe);
                                haber = parseFloat(haber);
                                saldo = debe - haber;
                                saldo = saldo + parseFloat(primersaldo);
                                $("#tbodyapuestas > tr:nth-child(1) > td:nth-child(4)").html(saldo);
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
                    } else {
                        alert('no hay mas');
                    }
                });
        }
    });

    var desde = $("#apuesta_desde").val();
    var hasta = $("#apuesta_hasta").val();
    // FUNCION PARA IMPRIMIR
    printDivAll = function() {
        var desde = $("#apuesta_desde").val();
        var hasta = $("#apuesta_hasta").val();
        if(desde != '' && hasta != ''){
            var nombrePrint = $("#nombresPrint").text();
            nombrePrint = nombrePrint.toUpperCase();
            var agenciaPrint = $("#nro_agencia").val();

            var divToPrint=document.getElementById('DivIdToPrint');

            var newWin=window.open('','Print-Window');

            newWin.document.open();

            newWin.document.write('<html><style>.no-print{display:none;} .to-print{text-align: center; border: 1px solid black;}</style><body onload="window.print()"><h1 style="text-align: center;">Cliente: '+nombrePrint+'</h1><p style="text-align:center;">Agencia: '+agenciaPrint+'</p><h1 style="text-align: justify;">Consulta de Apuestas desde '+desde+' hasta '+hasta+'</h1>'+divToPrint.innerHTML+'</body></html>');

            newWin.document.close();

            setTimeout(function(){newWin.close();},10);
        } else {
            var nombrePrint = $("#nombresPrint").text();
            nombrePrint = nombrePrint.toUpperCase();
            var agenciaPrint = $("#nro_agencia").val();

            var divToPrint=document.getElementById('DivIdToPrint');

            var newWin=window.open('','Print-Window');

            newWin.document.open();

            newWin.document.write('<html><style>.no-print{display:none;} .to-print{text-align: center; border: 1px solid black;}</style><body onload="window.print()"><h1 style="text-align: center;">Cliente: '+nombrePrint+'</h1><p style="text-align:center;">Agencia: '+agenciaPrint+'</p>'+divToPrint.innerHTML+'</body></html>');

            newWin.document.close();

            setTimeout(function(){newWin.close();},10);
        }
    }

    // FUNCION PARA BORRAR APUESTA
    borrar_apuesta = function(id, id_apuesta){
        var r = confirm("Esta seguro que desea eliminar esta apuesta?");
        if(r == true){
            $.post('<?php echo base_url(); ?>home/borrar_apuesta',
                {
                    id: id
                },
                function(data){
                    if(data == 1){
                        $("#tbodyapuestas").html('');
                        alert('Se borro la apuesta con exito');
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
                                                '<button onclick="editar_apuesta('+item.id_ap+', '+item.id_apuesta+', '+fecha+', '+item.jugo+', '+item.pago+')" type="button" class="btn btn-warning">'+
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
                            } else {
                                alert('no hay registros para este cliente');
                            }
                        });
                    }
                }
            );
        }
    }

    editarcliente = function(id, nombre, apellido, telefono){
        $("#id_del_cliente").val(id);
        $("#editnombre").val(nombre);
        $("#editapellido").val(apellido);
        $("#edittelefono").val(telefono);
    }  

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
                $('#tabla-clientes').DataTable().ajax.reload();
            }
        });
    });
});

</script>
</body>
</html>