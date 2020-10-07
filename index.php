<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <!-- Bootswatch Cosmo Theme -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.5.2/cosmo/bootstrap.min.css">

    <!-- Custom CSS 
    <link rel="stylesheet" href="App.css">-->
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Registro de Inventario Permanente Valorizado</a>
    </nav>


    <div class="container">
        <!-- APPLICATION -->
        <div id="App" class="row pt-2">

            <!-- FORM -->
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Parámetros de Selección</h4>
                    </div>
                    <form id="product-form" class="card-body" action="/fpdf/pdf.php" method="post">
                        <div class="form-group">
						<select name="month" class="form-control" selected=''>
							<option value="1" <?php if (date("m")=="01") echo "selected";?> >Enero</option>
							<option value="2" <?php if (date("m")=="02") echo "selected";?> >Febrero</option>
							<option value="3" <?php if (date("m")=="03") echo "selected";?> >Marzo</option>
							<option value="4" <?php if (date("m")=="04") echo "selected";?> >Abril</option>
							<option value="5" <?php if (date("m")=="05") echo "selected";?> >Mayo</option>
							<option value="6" <?php if (date("m")=="06") echo "selected";?> >Junio</option>
							<option value="7" <?php if (date("m")=="07") echo "selected";?> >Julio</option>
							<option value="8" <?php if (date("m")=="08") echo "selected";?> >Agosto</option>
							<option value="9" <?php if (date("m")=="09") echo "selected";?> >Septiembre</option>
							<option value="10" <?php if (date("m")=="10") echo "selected";?> >Octubre</option>
							<option value="11" <?php if (date("m")=="11") echo "selected";?> >Noviembre</option>
							<option value="12" <?php if (date("m")=="12") echo "selected";?> >Diciembre</option>
						</select>
                        </div>
                        <div class="form-group">
                            <input type="number" name="year" id="year" min="1900" max="2099" step="1" value="<?php echo date("Y")?>"
                                class="form-control">
                        </div>
                        <input type="submit" value="Generar" class="btn btn-primary btn-block">
                    </form>
                </div>
            </div>
            <!-- PRODUCTS LIST 
            <div id="product-list" class="col-md-8"></div>-->
        </div>
    </div>
	<!--
    <script src="App.js" type="module"></script> -->
</body>
</html>