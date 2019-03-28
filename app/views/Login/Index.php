<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?= NOMBRE_SITIO;?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="<?= RUTA_URL;?>/font/iconsmind/style.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/font/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="<?= RUTA_URL;?>/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/css/vendor/bootstrap-float-label.min.css" />
	<link rel="stylesheet" href="<?= RUTA_URL;?>/css/main.css" />
    <link rel="stylesheet" href="<?= RUTA_URL;?>/js/vendor/sweetalert/sweetalert2.min.css">
</head>

<body class="background show-spinner">
    <div class="fixed-background"></div>
    <main>
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side ">

                            <p class=" text-white h2">FACTURATRON v1.0</p>

                            <p class="white mb-0">
                                Por favor ingrese sus credenciales para iniciar Sesion.
                            </p>
                        </div>
                        <div class="form-side">
                            <a href="#">
                                <span class="logo-single"></span>
                            </a>
                            <h6 class="mb-4">Iniciar Sesion</h6>
                            <form id="form_Login">
                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" name="Usuario[usuario]" placeholder="Nombre de Usuario" required/>
                                    <span>Usuario</span>
                                </label>

                                <label class="form-group has-float-label mb-4">
                                    <input class="form-control" name="Usuario[password]" type="password" placeholder="Password" required/>
                                    <span>Password</span>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button class="btn btn-primary btn-lg btn-shadow" type="submit">LOGIN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="<?= RUTA_URL;?>/js/vendor/jquery-3.3.1.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="<?= RUTA_URL;?>/js/vendor/sweetalert/sweetalert2.all.js"></script>	
	<script src="<?= RUTA_URL;?>/js/dore.script.js"></script>
	<script src="<?= RUTA_URL;?>/js/scripts.js"></script>
	<script src="<?= RUTA_URL;?>/js/Facturatron/Login.js"></script>
</body>

</html>