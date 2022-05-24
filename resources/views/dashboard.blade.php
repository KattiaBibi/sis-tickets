@extends('adminlte::page')

<!-- @section('title', 'Dashboard') -->

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')


<div class="card">
  <div class="card-header">
    <h1 class="card-title">Accesos rápidos</h1>
  </div>
  <div class="card-body">

    <div class="row">

      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$total_citas}}</h3>

            <p>Reuniones</p>
          </div>
          <div class="icon">
            <i class="ion ion-calendar"></i>
          </div>

          @can('admin.reuniones')

          <a href="{{('cita')}}" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right"></i></a>

       @endcan


        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$total_requerimientos}}</h3>

            <p>Total Requerimientos</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>

          @can('admin.requerimientos')
             <a href="{{('requerimiento')}}" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right"></i></a>
          @endcan
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$total_colaboradores}}</h3>

            <p>Colaboradores</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>

        @can('admin.colaborador.listado')

            <a href="{{('colaborador')}}" class="small-box-footer">Ver todos<i class="fas fa-arrow-circle-right"></i></a>

       @endcan

        </div>
      </div>

      <!-- ./col -->
    </div>


  </div>
</div>


<!-- ./card2 -->


<div class="card">
  <div class="card-header border-transparent">
    <h3 class="card-title">Requerimientos</h3>

    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
      </button>
      <button type="button" class="btn btn-tool" data-card-widget="remove">
        <i class="fas fa-times"></i>
      </button>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body pt-0">
    <div class="table-responsive">
      <table class="table m-0" id="tabla">
        <thead>
          <tr>
            <th>ID</th>
            <th>TITULO</th>
            <th>SOLICITANTE</th>
            <th>ENCARGADO(S)</th>
            <th>ASIGNADO(S)</th>
            <th>EMPRESA</th>
            <th>SERVICIO</th>
            <th>AVANCE</th>
            <th>ESTADO</th>
            <th>PRIORIDAD</th>
            <th>FECHA</th>
            <!-- <th>OPCIONES</th> -->
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <!-- /.table-responsive -->
  </div>
  <!-- /.card-body -->
  <div class="card-footer clearfix">
    <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Nuevo requerimiento</a> -->
    <a href="{{('requerimiento')}}" class="btn btn-sm btn-secondary float-right">Mostrar completo</a>
  </div>
  <!-- /.card-footer -->
</div>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
  const DATATABLE = $('#tabla').DataTable({
    searching: false,
    ordering: true,
    processing: true,
    serverSide: true,
    lengthMenu: [4],
    responsive: true,
    autoWidth: false,
    language: {
      url: "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    ajax: {
      url: 'dashboard/getLastRequerimientos',
      type: "GET",
      data: function(d) {
        return $.extend({}, d, {
          filters: {}
        });
      }
    },
    columns: [{
        data: "id",
        orderable: false
      },
      {
        data: "titulo_requerimiento",
        orderable: false
      },
      {
        data: "nom_ape_solicitante",
        orderable: false
      },
      {
        data: "encargados",
        orderable: false,
        render: function(data, type, row, meta) {
          let encargados = data
            .map((item) => {
              return item.nom_ape;
            })
            .toString();
          return `<span>${encargados}</span>`;
        },
      },
      {
        data: "asignados",
        orderable: false,
        render: function(data, type, row, meta) {
          let asignados = data
            .map((item) => {
              return item.nom_ape;
            })
            .toString();
          return `<span>${asignados}</span>`;
        },
      },
      {
        data: "nombre_empresa",
        orderable: false
      },
      {
        data: "nombre_servicio",
        orderable: false
      },
      {
        data: "avance_requerimiento",
        orderable: false,
        render: function(data) {
          return `${data} %`;
        }
      },
      {
        data: "estado_requerimiento",
        orderable: false
      },
      {
        data: "prioridad_requerimiento",
        orderable: false
      },
      {
        data: "fecha_creacion",
        orderable: true,
        render: function(data, type, row, meta) {
          return `${new Date(data).toLocaleDateString()} ${new Date(data).toLocaleTimeString('es-PE', { hour12: true })}`
        },
      },
    ],
    order: [
      [8, 'desc']
    ]
  });
</script>
@stop
