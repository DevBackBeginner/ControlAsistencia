<?php include_once __DIR__ . '/../../views/gestion/dashboard/layouts/header_main.php'; ?>
    <!-- Incluir SweetAlert2 desde un CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <main id="main" class="main">
        <!-- end header -->
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">

        <div class="pagetitle">
            <h1>Perfil</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="Inicio">Inicio</a></li>
                <li class="breadcrumb-item active">Perfil</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">
                    <div class="card" style="width: 100%;">
                            
                            <?php if (!empty($_SESSION['mensaje'])): ?>
                                <div class="alert <?= $_SESSION['tipo_mensaje'] === 'error' ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show" role="alert">
                                    <?= htmlspecialchars($_SESSION['mensaje']) ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                                </div>
                                <?php
                                // Limpiar el mensaje después de mostrarlo
                                unset($_SESSION['mensaje']);
                                unset($_SESSION['tipo_mensaje']);
                                ?>
                            <?php endif; ?>
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            <img src="<?= $_SESSION['usuario']['foto_perfil'] ?>" alt="Perfil" class="rounded-circle">
                            <h2><?= $_SESSION['usuario']['nombre']?></h2>
                            <h3><?= ($_SESSION['usuario']['rol'] === 'admin') ? 'Administrador' : (htmlspecialchars($_SESSION['usuario']['rol']) === 'guarda' ? 'Guardia de portería' : htmlspecialchars($_SESSION['usuario']['rol'])) ?></h3>

                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card" style="width: 95%;">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">
                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Resumen</button>
                                </li>
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar Perfil</button>
                                </li>
                                <!-- <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Configuraciones</button>
                                </li> -->
                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Cambiar Contraseña</button>
                                </li>
                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">Acerca de</h5>
                                    <p class="" style="color: #00304D;">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                                    <h5 class="card-title">Detalles del Perfil</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Nombre Completo</div>
                                        <div class="col-lg-9 col-md-8" style="color: #00304D;"><?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos']?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Compañía</div>
                                        <div class="col-lg-9 col-md-8" style="color: #00304D;">Centro de Desarrollo Agroindustrial y Empresarial - CDAE (Villeta, Cundinamarca)</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Trabajo</div>
                                        <div class="col-lg-9 col-md-8" style="color: #00304D;"><?= ($_SESSION['usuario']['rol'] === 'admin') ? 'Administrador' : htmlspecialchars($_SESSION['usuario']['rol'])?> del sistema</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Dirección</div>
                                        <div class="col-lg-9 col-md-8" style="color: #00304D;">Cl. 2 #13 - 3, Villeta, Cundinamarca</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Teléfono</div>
                                        <div class="col-lg-9 col-md-8" style="color: #00304D;"><?= $_SESSION['usuario']['telefono'] ?></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Correo Electrónico</div>
                                        <div class="col-lg-9 col-md-8" style="color: #00304D;"><?= $_SESSION['usuario']['correo'] ?></div>
                                    </div>
                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                    <!-- Profile Edit Form -->
                                    <form method="POST" action="actualizar" enctype="multipart/form-data">
                                        <div class="row mb-3 justify-content-center">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label text-center">Imagen de Perfil</label>
                                            <div class="col-md-8 col-lg-9 text-center">
                                                <!-- Mostrar la imagen de perfil actual o una imagen por defecto -->
                                                <img src="<?= $_SESSION['usuario']['foto_perfil'] ?? 'default.png' ?>" alt="Perfil" class="rounded-circle">
                                                <div class="pt-2">
                                                    <!-- Input de archivo (oculto) -->
                                                    <input type="file" name="imagen" id="imagen" style="display: none;" accept="image/*">

                                                    <!-- Botón para subir una nueva imagen -->
                                                    <a href="#" class="btn btn-primary btn-sm" onclick="document.getElementById('imagen').click(); return false;">
                                                    <i class="bi bi-upload me-1"></i> Subir imagen de perfil
                                                </a>
                                                <!-- Botón para eliminar la imagen -->
                                                <button class="btn btn-danger btn-sm" onclick="eliminarImagen()">
                                                    <i class="bi bi-trash me-1"></i> Eliminar mi imagen de perfil
                                                </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="nombre" class="col-md-4 col-lg-3 col-form-label">Nombre</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nombre" type="text" class="form-control" id="nombre" 
                                                    value="<?= htmlspecialchars($_SESSION['usuario']['nombre'] ?? '') ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="apellidos" class="col-md-4 col-lg-3 col-form-label">Apellidos</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="apellidos" type="text" class="form-control" id="apellidos" 
                                                    value="<?= htmlspecialchars($_SESSION['usuario']['apellidos'] ?? '') ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Teléfono</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="phone" type="text" class="form-control" id="Phone" 
                                                    value="<?= htmlspecialchars($_SESSION['usuario']['telefono'] ?? '') ?>">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="Email" class="col-md-4 col-lg-3 col-form-label">Correo Electrónico</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="email" class="form-control" id="Email" 
                                                    value="<?= htmlspecialchars($_SESSION['usuario']['correo'] ?? '') ?>">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </form>
                                </div>

                                <!-- <div class="tab-pane fade pt-3" id="profile-settings"> -->
                                    <!-- Settings Form
                                    <form>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Notificaciones por Correo</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="changesMade" checked>
                                                    <label class="form-check-label" for="changesMade">
                                                        Cambios realizados en tu cuenta
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="newProducts" checked>
                                                    <label class="form-check-label" for="newProducts">
                                                        Información sobre nuevos productos y servicios
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="proOffers">
                                                    <label class="form-check-label" for="proOffers">
                                                        Ofertas de marketing y promociones
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                                                    <label class="form-check-label" for="securityNotify">
                                                        Alertas de seguridad
                                                    </label>
                                                </div>
                                            </div>
                                        </div> -->

                                        <!-- <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                        </div>
                                    </form>End settings Form -->
                                <!-- </div> -->

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form action="actualizar-contrasena" method="POST">
                                    <div class="row mb-3">
                                        <label for="contrasena_actual" class="col-md-4 col-lg-3 col-form-label" style="color: #007832;">Contraseña Actual</label>
                                        <div class="col-md-8 col-lg-9 input-group">
                                            <input name="contrasena_actual" type="password" class="form-control" id="contrasena_actual">
                                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('contrasena_actual')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nueva_contrasena" class="col-md-4 col-lg-3 col-form-label" style="color: #007832;">Nueva Contraseña</label>
                                        <div class="col-md-8 col-lg-9 input-group">
                                            <input name="nueva_contrasena" type="password" class="form-control" id="nueva_contrasena">
                                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('nueva_contrasena')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="confirmar_contrasena" class="col-md-4 col-lg-3 col-form-label" style="color: #007832;">Reingresa la Nueva Contraseña</label>
                                        <div class="col-md-8 col-lg-9 input-group">
                                            <input name="confirmar_contrasena" type="password" class="form-control" id="confirmar_contrasena">
                                            <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('confirmar_contrasena')">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                    </div>


                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                                        </div>
                                    </form><!-- End Change Password Form -->
                                </div>

                            </div><!-- End Bordered Tabs -->
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

<?php include_once __DIR__ . '/../../views/gestion/dashboard/layouts/footer_main.php'; ?>

<script>
    // Función para subir la imagen
    // Función para manejar la selección de la imagen
    document.getElementById('imagen').addEventListener('change', function(event) {
    const archivo = event.target.files[0]; // Obtener el archivo seleccionado
    if (archivo) {
        console.log("Archivo seleccionado:", archivo.name); // Verificar en la consola
        subirImagen(archivo);
    }
    });
        
    // Función para subir la imagen
    function subirImagen(archivo) {
        console.log("Subiendo imagen:", archivo.name); // Verificar en la consola
        const formData = new FormData();
        formData.append('imagen', archivo);

        fetch('subir-imagen', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log("Respuesta del servidor:", data); // Verificar en la consola
            if (data.success) {
                // Recargar la página para mostrar el mensaje de éxito
                window.location.reload();
            } else {
                // Recargar la página para mostrar el mensaje de error
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Recargar la página incluso si hay un error
            window.location.reload();
        });
    }
    // Función para eliminar la imagen
    function eliminarImagen() {
        if (confirm('¿Estás seguro de que deseas eliminar la imagen de perfil?')) {
            fetch('eliminar-imagen', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Recargar la página para mostrar el mensaje de éxito
                    window.location.reload();
                } else {
                    // Recargar la página para mostrar el mensaje de error
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Recargar la página incluso si hay un error
                window.location.reload();
            });
        }
    }
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = document.querySelector(`[onclick="togglePassword('${inputId}')"] i`);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }
    }
</script>