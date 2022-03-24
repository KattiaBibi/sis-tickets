@extends('adminlte::page')
@section('content_header')
    <h1>Tickets</h1>
    @section('title', 'Tickets')
@endsection

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet"/>

@endsection

@section('content')

<div class="card">

  <div class="card-header">

  <div class="row">
        <div class="col-lg-10">
                <h2>Listar</h2>
        </div>
        <div class="col-lg-2">

        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalagregar">AGREGAR</button>

        </div>
    </div>
    </div>

  <div class="card-body">

  @if ($message = Session::get('success'))
        <div class="alert alert-success" id="mensaje">
            <p>{{ $message }}</p>
        </div>
    @endif


    <table id="tickets" class="table table-striped table-bordered" style="">
        <thead>
            <tr>
              <th colspan="3" style="text-align: center;">ACCIÓN</th>
              <th>ID</th>
              <th>USUARIO SOLICITANTE</th>
              <th>PROBLEMA</th>


            </tr>
        </thead>
       <tbody>


        </tbody>

    </table>

  </div>
</div>


<div class="modal fade" id="modalagregar" tabindex="-1" role="dialog" aria-labelledby="modalagregar" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Ups!</strong> Hubo algunos problemas con tus inputs.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('ticket.store') }}" id="frmguardar" >


        <div class="form-group text-center">

            <img src="{{ asset('vendor/adminlte/dist/img/soporte.png') }}" alt=""  style="height: 200px; width: 200px;">
        </div>

      <div class="form-group">
        <label for="">PROBLEMA:</label>

        <input type="hidden" name="" value="{{ auth()->user()->id }}" id="">
        <input type="text" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" name="nombre">
    </div>

        <div class="form-group">
            <label for="">DETALLE:</label>
            <textarea class="form-control" id="txtDetalle" placeholder="Ingrese el detalle de su problema" rows="10" name="nombres"></textarea>

        </div>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
        <button  id="btnguardar" class="btn btn-primary">GUARDAR</button>
      </div>
    </form>

    </div>
  </div>
</div>





  <!-- Modal -->
  <div class="modal fade"  id="modalver" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Ver Detalle de Ticket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

        </div>
      </div>
    </div>
  </div>




  <!-- Modal detalle -->



  <!-- Modal -->
  <div class="modal fade bd-example-modal-xl"  id="modalatender" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Generar atención</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">


            <form>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputAddress">Address</label>
                  <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                  <label for="inputAddress2">Address 2</label>
                  <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="inputState">State</label>
                    <select id="inputState" class="form-control">
                      <option selected>Choose...</option>
                      <option>...</option>
                    </select>
                  </div>
                  <div class="form-group col-md-2">
                    <label for="inputZip">Zip</label>
                    <input type="text" class="form-control" id="inputZip">
                  </div>
                </div>
      

              </form>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>

          <button  id="btnguardar" class="btn btn-primary">GUARDAR</button>

        </div>
      </div>
    </div>
  </div>

  <!-- Modal detalle -->

<div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="modaleditar" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Actualiza registro de ticket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        @if ($errors->any())
          <div class="alert alert-danger">
              <strong>¡Ups!</strong> Hubo algunos problemas con tus inputs.<br><br>
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif


      <form  id="frmeditar">

        <input type="hidden" class="form-control" id="idregistro"  name="id">

        <div class="form-group">
           <label for="">PROBLEMA:</label>
           <input type="text" class="form-control" id="editarProblema" placeholder="Ingrese el nombre" name="problema">
       </div>

           <div class="form-group">
               <label for="">DETALLE:</label>
               <textarea class="form-control" id="editarDetalle" placeholder="Ingrese el detalle de su problema" rows="10" name="detalle"></textarea>

           </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
            <button type="submit" id="btnactualizar" class="btn btn-primary">EDITAR</button>
        </div>
      </form>

      </div>
    </div>
  </div>

  </div>

@endsection




@section('js')

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
<script> console.log('¡HOLA!');

</script>
<script src="{{asset('js/ticket.js')}}"></script>



<script>

listar()
</script>
@endsection
