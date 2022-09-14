@extends('adminlte::page')
@section('content_header')

<div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-12">
        <h1>Perfil</h1>
      </div>

    </div>
  </div><!-- /.container-fluid -->

    @section('title', 'Perfil')
@endsection

@section('css')

@endsection

@section('content')

    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">


                        <img class="profile-user-img img-fluid img-circle" value="{{$usuario->imagen}}" id="imagenuser" src="{{ asset('vendor/adminlte/dist/img/sinimg.jpg') }}" alt="Foto de perfil">




                </div>

                <h3 class="profile-username text-center">{{ $usuario->uname }}</h3>

                <p class="text-muted text-center">{{ $usuario->role_name }}</p>

                <ul class="list-group list-group-unbordered mb-3">

                  <li class="list-group-item">
                    <b>Correo:</b> <a class="">{{ $usuario->uemail }}</a>
                  </li>

                </ul>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Sobre mí</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Nombres y Apellidos</strong>

                <p class="text-muted">
                  {{ $usuario->apellidos_nombres }}
                </p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Dirección</strong>

                <p class="text-muted">{{ $usuario->direccion }}</p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Edad </strong>

                <p class="text-muted">{{ $usuario->edad }} años.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  {{-- <li class="nav-item"><a class="nav-link " href="#requerimientos" data-toggle="tab">Requerimientos</a></li> --}}
                  <li class="nav-item"><a class="nav-link active" href="#datosusuario" data-toggle="tab">Datos Usuario</a></li>
                  <li class="nav-item"><a class="nav-link" href="#datoscolaborador" data-toggle="tab">Datos Colaborador</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">

  
                  <div class="active tab-pane" id="datosusuario">

                        <form class="form-horizontal" id="frmeditar" enctype="multipart/form-data">

                        <input type="hidden" value="{{ $usuario->uid }}" id="idusuario" name="id">
                        <input type="hidden" value="{{ $usuario->ucolaborador_id }}" name="colaborador_id">
                      <div class="form-group row" >
                        <label for="inputFoto" class="col-sm-2 col-form-label">Nueva foto</label>
                        <div class="col-sm-8" style="text-align: center;">
                          

                            <input type="file"  accept="image/*" class="img form-control-file" id="imn" name="imagennue">

                            
                            <img id="imag"  onerror="this.style.display='none'" class="imagenPrevisualizacion mt-2" style="height: 200px; width: 200px;display: none;">


                        </div>

                        <div class="col-sm-2 row justify-content-center align-items-center" style="text-align: center;">
           

                          <button type="button" id="consim" style="display: none;" class="retirar btn btn-info btn-sm" >QUITAR IMAGEN</button>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Nombre usuario</label>
                        <div class="col-sm-8">
                          <input type="text"  value="{{ $usuario->uname }}" name="name" maxlength="50" class="form-control" id="inputName" placeholder="Nombre usuario">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Correo</label>
                        <div class="col-sm-8">
                          <input type="email" value="{{ $usuario->uemail }}" name="email" maxlength="80" class="form-control" id="inputEmail" placeholder="Correo">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-4 col-form-label">Contraseña nueva</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="inputName2" name="password" maxlength="50"  placeholder="Nueva contraseña">
                        </div>
                      </div>

                    <div class="form-group row">
                        <label for="inputName2" class="col-sm-4 col-form-label">Rol</label>
                        <div class="col-sm-8">

                            <select name="role" class="form-control disabled_class" value="{{ $usuario->role_id }}"  id="rol">

                                @foreach ($roles as $r)
                                <option value="{{ $r->id }}">{{$r->name}}</option>
                              @endforeach

                            </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="offset-sm-4 col-sm-8">
                          <button type="" id="btnactualizaruser" class="btn btn-danger">Editar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->


                  <div class="tab-pane" id="datoscolaborador">
                     <form  id="frmeditarcolab" class="form-horizontal">

                        <input type="hidden" value="{{ $usuario->ucolaborador_id }}" name="id">

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">N° documento:</label>
                        <div class="col-sm-8">
                          <input type="number"  value="{{ $usuario->nrodoc }}"  maxlength="11" class="form-control" id="inputName" name="nrodocumento" placeholder="N° documento">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Nombre(s):</label>
                        <div class="col-sm-8">
                          <input type="text" value="{{ $usuario->cnombres }}" class="sololetras form-control" maxlength="50" id="inputNombre" name="nombres" placeholder="Nombre(s) colaborador">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Apellidos:</label>
                        <div class="col-sm-8">
                          <input type="text" value="{{ $usuario->capellidos }}"b class="sololetras form-control" maxlength="50" id="inputApellidos" name="apellidos" placeholder="Apellidos colaborador">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Fecha de nacimiento:</label>
                        <div class="col-sm-8">
                          <input type="date" name="fechanacimiento" value="{{ $usuario->fechanac }}" class="form-control" id="inputFechaNac">
                        </div>
                      </div>


                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Dirección:</label>
                        <div class="col-sm-8">
                          <input type="text" name="direccion" value="{{ $usuario->direccion }}" maxlength="50" class="form-control" id="inputNombre" placeholder="Dirección">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Teléfono:</label>
                        <div class="col-sm-8">
                          <input type="text" name="telefono" value="{{ $usuario->tf }}" class="solonros form-control" maxlength="12" id="inputNombre" placeholder="Teléfono colaborador">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Empresa(s):</label>
                        <div class="col-sm-8">

                            <select class="form-control" id="empresa_area" name="empresa_area_id" disabled multiple>

                                @foreach ($usuario->empresas as $e)
                                  <option value="{{ $e->id }}">{{$e->nombre_empresa_area}}</option>
                                @endforeach

                            </select>

                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-4 col-sm-8">
                            <button type="" id="btnactualizarcolab" class="btn btn-danger">Editar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endsection




@section('js')


</script>
<script src="{{asset('js/perfil.js')}}"></script>


<script>


</script>
@endsection


