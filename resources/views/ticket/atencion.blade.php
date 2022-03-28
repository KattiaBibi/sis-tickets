@extends('adminlte::page')
@section('content_header')
    <h1>Atención</h1>
    @section('title', 'Atención')
@endsection

@section('css')


@endsection

@section('content')

<div class="card text-center">
  <div class="card-header text-right">
   
    <button type="submit" class="btn btn-dark">REGISTRAR LA ATENCIÓN</button>
 
  </div>

  <div class="card-body">
    <h5 class="card-title"><a  href='/ticket' class="btn btn-danger">REGRESAR</a></h5>
    <p class="card-text"></p>


    <input type="hidden" name="usuarioadmin_id" value="{{ auth()->user()->id}}" id="">

    <div class="form-row">

      <div class="form-group col-md-3">
        <label for="inputEmail4">PROBLEMA</label>
        <textarea class="form-control" id="mostrarProblema" rows="8" readonly></textarea>

      </div>

      <div class="form-group col-md-6">
        <label for="inputAddress">DETALLE</label>
        <textarea class="form-control" id="mostrarDetalle" rows="8" readonly></textarea>
      </div>

      <div class="form-group text-center col-md-3">
        <p>
         <img src="{{ asset('vendor/adminlte/dist/img/reparacion.png') }}" alt=""  style="height: 200px; width: 200px;">
        </p>

      </div>

    </div>


    <div class="form-row">

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


    <div class="form-row">


      <div class="form-group col-md-4">
        <label for="inputState">Colaboradores a cargo</label>

        @foreach ($colaboradores as $c)

        <div class="form-check">
  
            <input class="form-check-input" type="checkbox" value="{{$c->id}}" name="permission[]" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">{{$c->nombres}} {{$c->apellidos}}.</label>
          </div>
   @endforeach
      </div>


      <div class="form-group col-md-4">

        <label for="inputAddress2">Descripción</label>
        <textarea maxlength="200" class="form-control" id="txtDescripcion" placeholder="Ingrese la descripción de la atención." rows="7" name="descripcion"></textarea>

        <div id="contador3">0/200</div>
      </div>

      <div class="form-group col-md-4">

      

      </div>


    </div>


    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
  <div class="card-footer text-muted">
    2 days ago
  </div>
</div>


@endsection



@section('js')



<script> console.log('¡HOLA!');

</script>
{{-- <script src="{{asset('js/rol.js')}}"></script> --}}



<script>

listar()
</script>
@endsection
