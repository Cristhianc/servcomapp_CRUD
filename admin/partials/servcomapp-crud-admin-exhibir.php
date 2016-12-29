<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
/**
 * Provee una vista al area de administracion del plugin.
 *
 * Este archivo es usado para colocar el lenguaje de marcado (HTML) y asi
 * reflejar los aspectos visuales necesarios del lado del administrador del
 * plugin.
 *
 * @link
 * @since      1.0.0
 *
 * @package    servcomapp_CRUD
 * @subpackage servcomapp_CRUD/admin/partials
 */
?>
<!-- Este archivo deberia consistir principalmente de HTML con un poco de PHP. -->
<div class="wrap">
  <h1 id="servcomapp_titulo">
    Pagina administrativa de los datos del sistema de informacion
  </h1>
  <!-- Fila que contiene las pestañas de la interfaz -->
  <div class="row" id="cab_servcomapp">
    <div class="col-md-12">
      <!-- Pestañas que separan el contenido del plugin -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a href="#usuarios" aria-controls="usuarios" role="tab" data-toggle="tab">
            <strong>Usuarios</strong>
          </a>
        </li>
        <li role="presentation" id="tab_programas">
          <a href="#programas" aria-controls="programas" role="tab" data-toggle="tab">
            <strong>Programas y Proyectos</strong>
          </a>
        </li>
        <li role="presentation">
          <a href="#tutores" aria-controls="tutores" role="tab" data-toggle="tab">
            <strong>Tutores</strong>
          </a>
        </li>
        <li role="presentation">
          <a href="#instituciones" aria-controls="instituciones" role="tab" data-toggle="tab">
            <strong>Instituciones</strong>
          </a>
        </li>
        <li role="presentation">
          <a href="#inscripciones" aria-controls="inscripciones" role="tab" data-toggle="tab">
            <strong>Inscripciones de Estudiantes</strong>
          </a>
        </li>
      </ul>
      <!-- /Pestañas que separan el contenido del plugin -->
    </div>
  </div>
  <!-- /Fila que contiene las pestañas de la interfaz -->


  <!-- Hojas de contenido que referencia a las disintas pestañas existentes -->
  <div class="tab-content">
    <!-- Contenido de USUARIOS -->
    <div role="tabpanel" class="tab-pane active" id="usuarios">
      <!-- Fila del contenido de los Usuarios -->
      <div class="row">
        <div class="col-md-5">
          <!-- Panel de Usuario-->
          <div class="panel panel-primary" id="panel">
            <div class="panel-heading">
              <h2 class="titulo_crear">Crear Usuario</h2>
            </div>
            <div class="panel-body">
              <!-- Botones del tipo radio para seleccionar el tipo de usuario -->
              <div class="btn-group" id="rbtn_usuarios" data-toggle="buttons">
                <label class="btn btn-primary active" id="rbtn_estud">
                  <input type="radio" name="options" autocomplete="off">
                  Estudiante
                </label>
                <label class="btn btn-primary" id="rbtn_coord">
                  <input type="radio" name="options" autocomplete="off">
                  Coordinador
                </label>
              </div>
              <!-- /Botones del tipo radio para seleccionar el tipo de usuario -->

              <!-- Formulario de Usuarios-->
              <form class="form-horizontal" id="form_usuarios">
                <div class="form-group" id="us_nombre">
                  <label for="" class="col-md-4 control-label">Nombre (*):</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="">
                  </div>
                </div>
                <div class="form-group" id="us_apellido">
                  <label for="" class="col-md-4 control-label">Apellido (*):</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="">
                  </div>
                </div>
                <div class="form-group" id="us_correo">
                  <label for="" class="col-md-4 control-label">Correo (*):</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="" placeholder="ejemplo@gmail.com">
                  </div>
                </div>
                <div class="form-group" id="us_cedula">
                  <label for="" class="col-md-4 control-label">Cedula (*):</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="" placeholder="Ej.: 20.230.455">
                  </div>
                </div>
                <div class="form-group" id="us_telefono">
                  <label for="" class="col-md-4 control-label">Telefono:</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="" placeholder="Ej.: 0412-3406089">
                  </div>
                </div>
                <div class="form-group" id="us_carrera">
                  <label for="" class="col-md-4 control-label">Carrera (*):</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="">
                  </div>
                </div>
              </form>
              <!-- /Formulario de Usuarios-->
              <!-- Grupo de botones del formulario -->
              <div class="btns_formulario">
                <button type="button" class="btn btn-primary">Enviar</button>
                <button type="button" class="btn btn-primary">Limpiar</button>
              </div>
              <!-- /Grupo de botones del formulario -->
            </div>
          </div>
          <!-- /Panel de Usuario-->
        </div>
        <div class="col-md-7">
          <h2>Registros de los Usuarios</h2>
          <table class="table table-hover">
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Cedula</th>
              <th>Telefono</th>
              <th>Carrera</th>
              <th>Editar</th>
              <th>Borrar</th>
            </tr>
          </table>
        </div>
      </div>
      <!-- /Fila del contenido de los Usuarios -->
    </div>
    <!-- /Contenido de USUARIOS -->


    <!-- Contenido de PROGRAMAS -->
    <div role="tabpanel" class="tab-pane" id="programas">
      <!-- Fila del contenido de Programas-->
      <div class="row">
        <div class="col-md-12">
          <!--button type="button" class="btn btn-primary btn-lg" id="add_programa">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            Agregar
          </button-->
          <div class="well center-block" id="bloque_programas">
            <button type="button" class="btn btn-primary btn-lg btn-block">
              Programas de Servicio Comunitario de la Facultad de Ingeniería
            </button>
            <button type="button" class="btn btn-primary btn-lg btn-block">
              Programas de Servicio Comunitario de la Facultad de Ciencias Sociales
            </button>
            <button type="button" class="btn btn-primary btn-lg btn-block">
              Programas de Servicio Comunitario de la Facultad de Ciencias de la Educación
            </button>
            <button type="button" class="btn btn-primary btn-lg btn-block">
              Programas de Servicio Comunitario de la Facultad de Ciencias de la Salud
            </button>
            <button type="button" class="btn btn-primary btn-lg btn-block">
              Programas de Servicio Comunitario de la Facultad de Ciencias Jurídicas y Políticas
            </button>
          </div>
        </div>
      </div>
      <!-- /Fila del contenido de Programas-->
    </div>
    <!-- /Contenido de PROGRAMAS -->

    <!-- Contenido de TUTORES -->
    <div role="tabpanel" class="tab-pane" id="tutores">
      <!-- Fila del contenido de Tutores-->
      <div class="row">
        <div class="col-md-5">
          <div class="panel panel-primary" id="panel">
            <div class="panel-heading">
              <h2 class="titulo_crear">Crear Tutor</h2>
            </div>
            <div class="panel-body">
              <!-- Formulario de Tutores-->
              <form class="form-horizontal" id="form_tutores">
                <div class="form-group" id="tut_nombre">
                  <label for="" class="col-md-4 control-label">Nombre (*):</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="">
                  </div>
                </div>
                <div class="form-group" id="tut_apellido">
                  <label for="" class="col-md-4 control-label">Apellido (*):</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="">
                  </div>
                </div>
                <div class="form-group" id="tut_correo">
                  <label for="" class="col-md-4 control-label">Correo (*):</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="" placeholder="ejemplo@gmail.com">
                  </div>
                </div>
                <div class="form-group" id="tut_cedula">
                  <label for="" class="col-md-4 control-label">Cedula (*):</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="" placeholder="Ej.: 20.230.455">
                  </div>
                </div>
                <div class="form-group" id="tut_telefono">
                  <label for="" class="col-md-4 control-label">Telefono:</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="" placeholder="Ej.: 0412-3406089">
                  </div>
                </div>
                <div class="form-group" id="tut_institucion">
                  <label for="" class="col-md-4 control-label">Institucion (*):</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="">
                  </div>
                </div>
              </form>
              <!-- /Formulario de Tutores-->
              <!-- Grupo de botones del formulario -->
              <div class="btns_formulario">
                <button type="button" class="btn btn-primary">Enviar</button>
                <button type="button" class="btn btn-primary">Limpiar</button>
              </div>
              <!-- /Grupo de botones del formulario -->
            </div>
          </div>

        </div>
        <div class="col-md-7">
          <h2>Registros de los Tutores</h2>
          <table class="table table-hover">
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Correo</th>
              <th>Cedula</th>
              <th>Telefono</th>
              <th>Institucion</th>
              <th>Editar</th>
              <th>Borrar</th>
            </tr>
          </table>
        </div>
      </div>
      <!-- /Fila del contenido de Tutores-->
    </div>
    <!-- /Contenido de TUTORES -->

    <!-- Contenido de INSTITUCIONES -->
    <div role="tabpanel" class="tab-pane" id="instituciones">
      <!-- Fila del contenido de las Instituciones-->
      <div class="row">
        <div class="col-md-5">
          <div class="panel panel-primary" id="panel">
            <div class="panel-heading">
              <h2 class="titulo_crear">Crear Institucion</h2>
            </div>
            <div class="panel-body">
              <!-- Formulario de Instituciones-->
              <form class="form-horizontal" id="form_instituciones">
                <div class="form-group" id="inst_nombre">
                  <label for="" class="col-md-4 control-label">Nombre (*):</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="">
                  </div>
                </div>
                <div class="form-group" id="inst_telefono">
                  <label for="" class="col-md-4 control-label">Telefono:</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="" placeholder="Ej.: 0412-3406089">
                  </div>
                </div>
                <div class="form-group" id="inst_correo">
                  <label for="" class="col-md-4 control-label">Correo:</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="" placeholder="ejemplo@gmail.com">
                  </div>
                </div>
                <div class="form-group" id="inst_url">
                  <label for="" class="col-md-4 control-label">Pagina Web:</label>
                  <div class="col-md-5">
                    <input type="email" class="form-control" id="" placeholder="Ej.: www.paginaweb.com">
                  </div>
                </div>
              </form>
              <!-- /Formulario de Instituciones-->
              <!-- Grupo de botones del formulario -->
              <div class="btns_formulario">
                <button type="button" class="btn btn-primary">Enviar</button>
                <button type="button" class="btn btn-primary">Limpiar</button>
              </div>
              <!-- /Grupo de botones del formulario -->
            </div>
          </div>


        </div>
        <div class="col-md-7">
          <h2>Registros de las Instituciones</h2>
          <table class="table table-hover">
            <tr>
              <th>Nombre</th>
              <th>Telefono</th>
              <th>Correo</th>
              <th>Pagina Web</th>
              <th>Editar</th>
              <th>Borrar</th>
            </tr>
          </table>
        </div>
      </div>
      <!-- /Fila del contenido de las Instituciones-->

    </div>
    <!-- /Contenido de INSTITUCIONES -->

    <!-- Contenido de INSCRIPCIONES -->
    <div role="tabpanel" class="tab-pane" id="inscripciones">
    </div>
    <!-- /Contenido de INSCRIPCIONES -->
  </div>
  <!-- /Hojas de contenido que referencia a las disintas pestañas existentes -->
</div>
<!-- Fin del contenido HTML5-->
