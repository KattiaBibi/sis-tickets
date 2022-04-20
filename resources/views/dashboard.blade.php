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

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$total_citas}}</h3>

              <p>Reuniones</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{('cita')}}" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$total_requerimientos}}</h3>

              <p>Total Requerimientos</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$total_colaboradores}}</h3>

              <p>Colaboradores</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$total_servicios}}</h3>

              <p>Servicios</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Ver todos <i class="fas fa-arrow-circle-right"></i></a>
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
        <table class="table m-0">
          <thead>
          <tr>
            <th>TÍTULO</th>
            <th>ENCARGADO</th>
            <th>SERVICIO</th>
            <th>ESTADO</th>
            <th>AVANCE</th>
            <th>ESTADO</th>
            <th>VER</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><a href="pages/examples/invoice.html">OR9842</a></td>
            <td>Call of Duty IV</td>
            <td>Call of Duty IV</td>
            <td>Call of Duty IV</td>
            <td>Call of Duty IV</td>
            <td><span class="badge badge-success">Pendiente</span></td>
            <td>
              <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
            </td>

          </tr>


          </tbody>
        </table>
      </div>
      <!-- /.table-responsive -->
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
      <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Nuevo requerimiento</a>
      <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">Ver todos</a>
    </div>
    <!-- /.card-footer -->
  </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
