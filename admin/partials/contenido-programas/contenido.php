<div class="row">
   <div id="btn-inicio" class="col-xs-1 hide">        
      <button type="button" onclick="home()" style="margin-top:30px" class="btn btn-primary">
      Inicio
      </button>        
   </div>
   <div id="btn-add" class="col-xs-11">        
      <button type="button" onclick="add()" style="margin-top:30px" class="btn btn-primary">
      Agregar Programa
      </button>        
   </div>
</div>
<div id="buttons" class="row">
   <div class="col-md-12">
      <div class="center-block" id="bloque_programas">
         <button type="button" onclick="onSelect(0)" class="btn btn-primary btn-lg btn-block btn-edit">
         Programas de Servicio Comunitario de la Facultad de Ingeniería
         </button>
         <button type="button" onclick="onSelect(1)" class="btn btn-primary btn-lg btn-block btn-edit">
         Programas de Servicio Comunitario de la Facultad de Ciencias Sociales
         </button>
         <button type="button" onclick="onSelect(2)" class="btn btn-primary btn-lg btn-block btn-edit">
         Programas de Servicio Comunitario de la Facultad de Ciencias de la Educación
         </button>
         <button type="button" onclick="onSelect(3)" class="btn btn-primary btn-lg btn-block btn-edit">
         Programas de Servicio Comunitario de la Facultad de Ciencias de la Salud
         </button>
         <button type="button" onclick="onSelect(4)" class="btn btn-primary btn-lg btn-block btn-edit">
         Programas de Servicio Comunitario de la Facultad de Ciencias Jurídicas y Políticas
         </button>
      </div>
   </div>
</div>
<div class="row hide" id="add">
   <div class="col-xs-12">
      <!--Panel de programas-->
      <div class="panel panel-primary" id="panel-programas">
         <div class="panel-heading">
            <h2 class="titulo_programa" id="titulo">Crear Programa</h2>
         </div>
         <div class="panel-body">
            <!-- Formulario de programas-->
            <form class="form-horizontal" id="form_programas" method="post">
               <div class="form-group" id="pr_nombre">
                  <label for="pr_nom" class="col-md-4 control-label">Nombre (*):</label>
                  <div class="col-md-5">
                     <input type="text" class="form-control" name="pr_nom" id="pr_nom" required>
                  </div>
               </div>
               <div class="form-group" id="pr_apellido">
                  <label for="pr_ape" class="col-md-4 control-label">Objetivo General (*):</label>
                  <div class="col-md-5">
                     <textarea class="form-control" rows="5" name="pr_ape" id="pr_ape" required></textarea>
                  </div>
               </div>
               <div class="form-group" id="pr_correo">
                  <label for="pr_corr" class="col-md-4 control-label">Objetivos Específicos (*):</label>
                  <div class="col-md-5">
                     <textarea class="form-control" rows="5" name="pr_corr" id="pr_corr" required></textarea>
                  </div>
               </div>
               <div class="form-group" id="pr_cedula">
                  <label for="pr_ced" class="col-md-4 control-label">Cedula (*):</label>
                  <div class="col-md-5">
                     <input type="text" class="form-control" name="pr_ced" id="pr_ced" placeholder="Ej.: 20.230.455" required>
                  </div>
               </div>
               <div class="form-group" id="pr_telefono">
                  <label for="pr_tel" class="col-md-4 control-label">Telefono:</label>
                  <div class="col-md-5">
                     <input type="text" class="form-control" name="pr_tel" id="pr_tel" placeholder="Ej.: 0412-3406089">
                  </div>
               </div>
               <div class="form-group" id="pr_apodo">
                  <label for="pr_apo" class="col-md-4 control-label">programa (*):</label>
                  <div class="col-md-5">
                     <input type="text" class="form-control" name="pr_apo" id="pr_apo" placeholder="Nombre del programa" required>
                  </div>
               </div>
               <div class="form-group" id="pr_clave">
                  <label for="pr_cla" class="col-md-4 control-label">Clave (*):</label>
                  <div class="col-md-5">
                     <input type="text" class="form-control" name="pr_cla" id="pr_cla" placeholder="" required>
                  </div>
               </div>
               <!-- Grupo de botones del formulario -->
               <div class="form-group" id="pr_botones">
                  <div class="btns_formulario" id="btns_programas">
                     <button type="submit" class="btn btn-primary" id="btn_pr_enviar">Enviar</button>
                     <button type="reset" class="btn btn-primary" id="btn_pr_limpiar">Limpiar</button>
                  </div>
               </div>
               <!-- /Grupo de botones del formulario -->
            </form>
            <!-- /Formulario de programas-->
         </div>
      </div>
   </div>
   <!--/Panel de programas-->
</div>