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

                  <!-- /.tab-pane -->
                  {{-- <div class="active tab-pane" id="requerimientos">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-danger">
                          10 Feb. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- requerimientos item -->
                      <div>
                        <i class="fas fa-envelope bg-primary"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 12:05</span>

                          <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

                          <div class="timeline-body">
                            Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                            weebly ning heekya handango imeem plugg dopplr jibjab, movity
                            jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                            quora plaxo ideeli hulu weebly balihoo...
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-primary btn-sm">Read more</a>
                            <a href="#" class="btn btn-danger btn-sm">Delete</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-user bg-info"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                          <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
                          </h3>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-comments bg-warning"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                          <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

                          <div class="timeline-body">
                            Take me to your leader!
                            Switzerland is small and neutral!
                            We are more like Germany, ambitious and misunderstood!
                          </div>
                          <div class="timeline-footer">
                            <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                          </div>
                        </div>
                      </div>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <div class="time-label">
                        <span class="bg-success">
                          3 Jan. 2014
                        </span>
                      </div>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <div>
                        <i class="fas fa-camera bg-purple"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                          <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

                          <div class="timeline-body">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                            <img src="https://placehold.it/150x100" alt="...">
                          </div>
                        </div>
                      </div>
                      <!-- END requerimientos item -->
                      <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div>
                    </div>
                  </div> --}}
                  <!-- /.tab-usuario -->

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
           

                          <button type="button" id="consim" style="display: none;" class="retirar btn btn-info btn-sm" style="">QUITAR IMAGEN</button>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Nombre usuario</label>
                        <div class="col-sm-8">
                          <input type="text"  value="{{ $usuario->uname }}" name="name" class="form-control" id="inputName" placeholder="Nombre usuario">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Correo</label>
                        <div class="col-sm-8">
                          <input type="email" value="{{ $usuario->uemail }}" name="email" class="form-control" id="inputEmail" placeholder="Correo">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-4 col-form-label">Contraseña nueva</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="inputName2" name="password" placeholder="Nueva contraseña">
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
                          <input type="number"  value="{{ $usuario->nrodoc }}" class="form-control" id="inputName" name="nrodocumento" placeholder="N° documento">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Nombre(s):</label>
                        <div class="col-sm-8">
                          <input type="text" value="{{ $usuario->cnombres }}" class="form-control" id="inputNombre" name="nombres" placeholder="Nombre(s) colaborador">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Apellidos:</label>
                        <div class="col-sm-8">
                          <input type="text" value="{{ $usuario->capellidos }}"b class="form-control" id="inputApellidos" name="apellidos" placeholder="Apellidos colaborador">
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
                          <input type="text" name="direccion" value="{{ $usuario->direccion }}" class="form-control" id="inputNombre" placeholder="Dirección">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Teléfono:</label>
                        <div class="col-sm-8">
                          <input type="text" name="telefono" value="{{ $usuario->tf }}" class="form-control" id="inputNombre" placeholder="Teléfono colaborador">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label">Empresa y área:</label>
                        <div class="col-sm-8">

                            <select class="form-control disabled_class"  value="{{ $usuario->empresa_area_id }}" id="empresa_area" name="empresa_area_id">

                                @foreach ($empresa_areas as $e)
                                <option value="{{ $e->eaid }}">{{$e->enombre}} - {{$e->anombre}}</option>
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


