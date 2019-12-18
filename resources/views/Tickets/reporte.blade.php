@extends("Template.layout")

@section('titulo')
Reporte Tickets
@endsection

@section('contenido')

<section class="content-header">
    <h1>Reporte Tickets</h1>
    <ol class="breadcrumb">
        <li><a href="dashboard"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Reporte</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>
<section class="content">
<div class="row">

        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                        <h3 class="box-title"><strong>Consultar Reporte Tickets</strong></h3>
                    <div class="box-tools pull-right">

                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            {!! Form::open(['id' => 'consultar','name' => 'consultar','files' => true,'autocomplete' => 'off','method'=>'post']) !!}
                            @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Tipo</label>
                                            {!! Form::select('id_tipo',$Tipo,null,['class'=>'form-control','id'=>'id_tipo']) !!}
                                        </div>
                                        <div class="col-md-2">
                                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Estado</label>
                                            {!! Form::select('id_estado',$Estado,null,['class'=>'form-control','id'=>'id_estado']) !!}
                                        </div>
                                        <div class="col-md-2">
                                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Prioridad</label>
                                            {!! Form::select('id_prioridad',$Prioridad,null,['class'=>'form-control','id'=>'id_prioridad']) !!}
                                        </div>
                                        <div class="col-md-3">
                                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Creado Por</label>
                                            {!! Form::select('id_creado',$Usuario,null,['class'=>'form-control','id'=>'id_creado']) !!}
                                        </div>
                                        <div class="col-md-3">
                                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Asignado A:</label>
                                            {!! Form::select('id_asignado',$Usuario,null,['class'=>'form-control','id'=>'id_asignado']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Categoria</label>
                                            {!! Form::select('id_categoriarepo',$Categoria,null,['class'=>'form-control','id'=>'id_categoriarepo']) !!}
                                        </div>
                                        <div class="col-md-3">
                                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Sede</label>
                                            {!! Form::select('id_sede',$Sede,null,['class'=>'form-control','id'=>'id_sede']) !!}
                                        </div>
                                        <div class="col-md-2">
                                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Fecha Inicio</label>
                                            {!! Form::text('fechaInicio',$FechaInicio,['class'=>'form-control','id'=>'fechaInicio','required']) !!}
                                        </div>
                                        <div class="col-md-2">
                                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Fecha Fin</label>
                                            {!! Form::text('fechaFin',$FechaInicio,['class'=>'form-control','id'=>'fechaFin','required']) !!}
                                        </div>
                                    </div>
                                </div>

                                {!! Form::button('Consultar',array('class'=>'btn btn-primary pull-right','id'=>'btnFormularioConsulta','tabindex'=>'16')) !!}
                            {!!  Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="row" id="panelResultado" hidden>
        <div class="col-md-12">
                <div class="box box-success">
                        <div class="box-body">
                                <div class="row">
                                        <div class="col-md-12">
                    <table id="reporte" class="display table-striped responsive no-wrap" style="width:100%">
                        <thead style="background: linear-gradient(60deg,rgba(51,101,155,1),rgba(66,132,206,1));color: #ECF0F1;">
                            <tr>
                                <th>Ticket</th>
                                <th>Fecha Creación</th>
                                <th>Fecha Actualización</th>
                                <th>Tipo</th>
                                <th>Prioridad</th>
                                <th>Estado</th>
                                <th>Creado Por</th>
                                <th>Asignado A</th>
                                <th>Asunto Ticket</th>
                                <th>Nombre Reportante</th>
                                <th>Telefono Reportante</th>
                                <th>Correo Reportante</th>
                                <th>Descripcion</th>
                                <th>Zona</th>
                                <th>Sede</th>
                                <th>Area</th>
                                <th>Actualizado Por</th>
                                <th>Historial Ticket</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                                </div>
                        </div>
            </div>
            </div>
    </div>



</section>

@endsection

@section('scripts')

    <script src="{{asset("assets/dist/js/tickets.js")}}"></script>
    <script>
        @if (session("mensaje"))
            toastr.success("{{ session("mensaje") }}");
        @endif

        @if (count($errors) > 0)
            @foreach($errors -> all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
    <script>
        $(function () {
            $('#fechaFin').datepicker({
                isRTL: false,
                autoclose: true,
                language: 'es',
                format: 'yyyy-mm-dd'
            });
            $('#fechaInicio').datepicker({
                isRTL: false,
                autoclose:true,
                language: 'es',
                format: 'yyyy-mm-dd'
            });
        });
        function categoriaFuncRepo() {
            var selectBox = document.getElementById("id_categoriarepo");
            var selectedValue = selectBox.options[selectBox.selectedIndex].value;
            var tipo = 'post';
            var select = document.getElementById("id_usuariorepo");

            $.ajax({
                url: "{{route('buscarCategoriaRepo')}}",
                type: "get",
                data: {_method: tipo, id_categoria: selectedValue},
                success: function (data) {
                    var vValido = data['valido'];

                    if (vValido === 'true') {
                        var ListUsuario = data['Usuario'];
                        select.options.length = 0;
                        for (index in ListUsuario) {
                            select.options[select.options.length] = new Option(ListUsuario[index], index);
                        }

                    }

                }
            });
        }
    </script>



@endsection
