<?php
// login.php
session_start();

// Si el usuario ya está logueado, lo mandamos al index
if(isset($_SESSION['usuario_logueado'])){
    header("Location: index.php");
    exit;
}

// Lógica simple para cerrar sesión si recibe el parámetro logout
if(isset($_GET['logout'])){
    session_destroy();
    header("Location: login.php");
    exit;
}

include("head.php");
?>

<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h3 class="font-weight-light my-2"><i class="fas fa-user-lock"></i> Iniciar Sesión</h3>
                </div>
                <div class="card-body">
                    <form id="formLogin">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Usuario" required />
                            <label for="usuario">Nombre de Usuario</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="password" name="password" type="password" placeholder="Contraseña" required />
                            <label for="password">Contraseña</label>
                        </div>
                        
                        <div id="mensaje_login"></div>

                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                            <button class="btn btn-primary w-100" type="submit">Ingresar al Sistema</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>