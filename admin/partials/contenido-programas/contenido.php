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
                    <div class="form-group" id="pr_general">
                        <label for="pr_gen" class="col-md-4 control-label">Objetivo General (*):</label>
                        <div class="col-md-5">
                            <textarea class="form-control" rows="5" name="pr_gen" id="pr_gen" required></textarea>
                        </div>
                    </div>
                    <div class="form-group" id="pr_especificos">
                        <label for="pr_esp" class="col-md-4 control-label">Objetivos Específicos (*):</label>
                        <div class="col-md-5">
                            <textarea class="form-control" rows="5" name="pr_esp" id="pr_esp" required></textarea>
                        </div>
                    </div>
                    <div class="form-group" id="pr_facultades">
                        <label for="pr_fac" class="col-md-4 control-label">Facultades (*):</label>
                        <div class="col-md-5" id="pr_fac">
                            <input type="checkbox" class="form-control" name="pr_ing">Ingeniería<br/>
                            <input type="checkbox" class="form-control" name="pr_soc">Sociales<br/>
                            <input type="checkbox" class="form-control" name="pr_soc">Educación<br/>
                            <input type="checkbox" class="form-control" name="pr_soc">Salud<br/>
                            <input type="checkbox" class="form-control" name="pr_soc">Jurídicas<br/>
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

<div id="lista" class="container hide">
    <div class="row">
        <div class="col-xs-12 col-sm-offset-1 col-sm-8" style="margin-top: 30px">
            <ul class="event-list">
                <li>
                    <div class="cupos">
                        <br><br>
                        <span class="current">4</span><br>
                        <span class="total">8 cupos</span>
                    </div>
                    <div class="info">
                        <h2 class="title">Nombre del programa</h2><br>
                        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    </div>
                </li>

                <li>
                    <div class="cupos">
                        <br><br>
                        <span class="current">2</span><br>
                        <span class="total">10 cupos</span>
                    </div>
                    <div class="info">
                        <h2 class="title">Nombre del programa</h2><br>
                        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    </div>
                </li>

                <li>
                    <div class="cupos">
                        <br><br>
                        <span class="current">5</span><br>
                        <span class="total">4 cupos</span>
                    </div>
                    <div class="info">
                        <h2 class="title">Nombre del programa</h2><br>
                        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    </div>
                </li>

                <li>
                    <div class="cupos">
                        <br><br>
                        <span class="current">1</span><br>
                        <span class="total">12 cupos</span>
                    </div>
                    <div class="info">
                        <h2 class="title">Nombre del programa</h2><br>
                        <p class="desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>