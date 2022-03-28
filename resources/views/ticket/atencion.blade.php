@extends('adminlte::page')
@section('content_header')
    <h1>Atención</h1>
    @section('title', 'Atención')
@endsection

@section('css')


@endsection

@section('content')

<div class="card text-center">

    <form action="{{ route('atencion.store') }}" id="frmguardar">
  <div class="card-header text-right">

    <button type="submit" id="btnguardar" class="btn btn-dark">REGISTRAR LA ATENCIÓN</button>

  </div>

  <div class="card-body">
    <h5 class="card-title"><a  href='/ticket' class="btn btn-danger">REGRESAR</a></h5>
    <p class="card-text"></p>


    <input type="hidden" name="ticket_id" value="{{ $id}}" id="">

    <div class="form-row pb-4">

      <div class="form-group col-md-3">
        <label for="inputEmail4">PROBLEMA</label>
        <textarea class="form-control" id="mostrarProblema" rows="8"  readonly>{{ $registro->problema}}</textarea>

      </div>

      <div class="form-group col-md-6">
        <label for="inputAddress">DETALLE</label>
        <textarea class="form-control" id="mostrarDetalle" rows="8" readonly>{{ $registro->detalle}}</textarea>
      </div>

      <div class="form-group text-center col-md-3">
        <p>
         <img src="{{ asset('vendor/adminlte/dist/img/reparacion.png') }}" alt=""  style="height: 200px; width: 200px;">
        </p>

      </div>

    </div>


    <div class="form-row pb-4">

      <div class="form-group col-md-4">
        <label for="inputState">Servicio</label>

    <select class="form-control" name="servicio_id">
      <option selected>Elegir</option>

      @foreach ($servicios as $s)
      <option value="{{ $s->id }}">{{$s->nombre}}</option>
    @endforeach
    </select>

      </div>

      <div class="form-group col-md-4">
        <label for="inputState">Prioridad</label>

        <select class="form-control" name="prioridad_id">
          <option selected>Elegir</option>

          @foreach ($prioridades as $p)
          <option value="{{ $p->id }}">{{$p->nombre}}</option>
        @endforeach
        </select>
      </div>
      <div class="form-group col-md-4">
        <label for="inputState">Estado</label>
      <select class="form-control" name="estado_id">
      <option selected>Elegir</option>

      @foreach ($estados as $e)
      <option value="{{ $e->id }}">{{$e->nombre}}</option>
    @endforeach
    </select>
      </div>
    </div>


    <div class="form-row pb-4">


      <div class="form-group col-md-4">
        <label for="inputState">Colaboradores a cargo</label>

        @foreach ($users as $u)

        <div class="form-check">

            <input class="form-check-input" type="checkbox" value="{{$u->id}}" name="usuario_colab_id[]" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">{{$u->nombres}} {{$u->apellidos}}.</label>
          </div>
   @endforeach
      </div>


      <div class="form-group col-md-8">

        <label for="inputAddress2">Descripción</label>
        <textarea maxlength="200" class="form-control" id="txtDescripcion" placeholder="Ingrese la descripción de la atención." rows="5" name="descripcion"></textarea>

        <div id="contador3">0/200</div>
      </div>

    </div>



  </div>

</form>
  <div class="card-footer text-muted">
    COMPUSISTEL SAC.
  </div>
</div>


@endsection



@section('js')



<script> console.log('¡HOLA!');

</script>
<script src="{{asset('js/atencion.js')}}"></script>



<script>

</script>
@endsection
