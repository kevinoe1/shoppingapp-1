
<div class="col-md-2 bordered">
            <div class="card card-left">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <form action="./registro_datos.php" method="POST">
                            <input type="hidden" name="menu" value="registro_categoria" />
                            <button type="submit" class="col-md-12 btn btn-primary">Nueva</button>
                        </form>
                    </li>
                    <li class="list-group-item">
                        <form action="./registro_datos.php" method="POST">
                            <input type="hidden" name="menu" value="ver_categorias" />
                            <button type="submit" class="col-md-12 btn btn-primary">Ver todas</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
<div style="height:100%;margin-bottom:60px;" class="col-md-7 bordered">
    <div class="card">
    <div class="card-body">
        <h5 class="card-title text-right">Gestión de categoría - Nuevo</h5>
        <br>
        <form action="../scripts/registro_datos.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inputAddress">Nombre de la categoría</label>
                <input type="text" class="form-control" name="input_nombreCategoria" id="inputCategoryName" placeholder="">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Descripción</label>
                <input type="text" class="form-control" name="input_descripcion" id="inputDescripcion" placeholder="">
            </div>
            <label for="inputAddress2">Imagen</label>
            <div class="custom-file">
                <input type="file" accept="image/*" class="custom-file-input" id="inputImagen" name="input_imagen">
                <label class="custom-file-label" for="customFile">Escoger archivo</label>
            </div>
            <br>
            <br>
            <fieldset class="form-group">
            <label for="inputAddress2">Estado</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="input_estado" id="inputRadioActivo" value="1" checked>
                <label class="form-check-label" for="inputRadioActivo">
                    Activa
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="input_estado" id="inputRadioInactivo" value="0">
                <label class="form-check-label" for="inputRadioInactivo">
                    Inactiva
                </label>
                </div>
            </fieldset>
            <br>
            <input type="hidden" value="registrar_categoria" name="action">
            <input type="hidden" value="registrar_categoria" name="menu">
            <button type="submit" class="btn btn-primary">Agregar</button>
        </form>

    </div>
    </div>
</div>
<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>