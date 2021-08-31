@extends('web.plantilla-sitio')
@section('contenido')


<section class="ftco-section contact-section">
    <div class="container mt-5">
      <div class="row block-9 justify-content-center">
        <div class="col-md-12 ftco-animate">
          <form action="#" class="contact-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
            
            <div class="row justify-content-center" >
              <div class="col-12 col-md-8 mx-3">
                <h2>Completá tus datos</h2>
              </div>
              <div class="col-12 col-md-8">
                <div class="form-group">
                  <input type="text" class="form-control" name="txtUsuario" placeholder="Correo">
                </div>
              </div>
              <div class="col-12 col-md-8 px-3">
                <div class="form-group">
                  <input type="text" name="txtClave" class="form-control" placeholder="Clave">
                </div>
              </div>
              <div class="col-12 col-md-8">
                <div class="form-group">
                  <input type="text" name="txtNombre" class="form-control" placeholder="Nombre">
                </div>
              </div>
              <div class="col-12 col-md-8">
                <div class="form-group">
                  <input type="text" name="txtApellido" class="form-control" placeholder="Apellido">
                </div>
              </div>
              <div class="col-12 col-md-8">
                <div class="form-group">
                  <input type="text" name="txtTelefono" class="form-control" placeholder="Teléfono">
                </div>
              </div>
              <div class="col-12 col-md-8 mt-3">
                <button class="btn btn-primary" type="submit">REGISTRARTE </button> 
                <div>
                </div>
                <p class="mt-3"> ¿Ya tenés una cuenta? <a href="/login"> Iniciá sesión </a> 
              </div>

          </form>
        </div>
      </div>
    </div>
</section>

    <div id="map"></div>
    @endsection
