<?php

//Consulta seleccionar categorías
$select_categorias = $pdo->prepare("SELECT * FROM Categorias");
$select_categorias->execute();
$listaCategorias = $select_categorias->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="col-md-2 bordered">
            <div class="card card-left">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <form action="./registro_datos.php" method="POST">
                            <input type="hidden" name="menu" value="registro_categoria" />
                            <button type="submit" class="col-md-12 btn btn-primary">New</button>
                        </form>
                    </li>
                    <li class="list-group-item">
                        <form action="./registro_datos.php" method="POST">
                            <input type="hidden" name="menu" value="ver_categorias" />
                            <button type="submit" class="col-md-12 btn btn-primary">View all</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
<div style="height:100%;margin-bottom:60px;" class="col-md-7 bordered">
    <div class="card">
    <div class="card-body">
        <h5 class="card-title text-right">Category management - View all</h5>
  
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Category</th>
                    <th scope="col">Description</th>
                    <th scope="col">State</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($listaCategorias as $categoria){ ?>
                <tr WIDTH="100%">
                    <td WIDTH="30%"><img class="col-md-12" src="../uploads/<?php echo $categoria['Imagen'] ?>" alt=""></td>
                    <td WIDTH="20%"><?php echo $categoria['NombreCategoria'] ?></td>
                    <td WIDTH="40%"><?php echo $categoria['Descripcion'] ?></td>
                    <td WIDTH="10%"><?php echo $categoria['Estado'] ?></td>
                </tr>
                <?php }?>
            </tbody>
        </table>

    </div>
    </div>
</div>