<main class="inicioUsuario">
    <?php include_once 'dashboard.php'; ?>
    <section class="usuarios">
        <h3>Informacion</h3>
        <div class="alertas"><?php alertas($alertas); ?></div>
        <form method="post" enctype="multipart/form-data">
            <fieldset class="formulario">
                <div class="formulario__campo">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $usuario->nombre; ?>">
                </div>
                <div class="formulario__campo">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" value="<?php echo $usuario->apellido; ?>">
                </div>
                <div class="formulario__campo">
                    <label for="email">Pais</label>
                    <input type="text" name="email" id="email" value="<?php echo $usuario->email; ?>">
                </div>
                <div class="formulario__campo">
                    <label for="img" class="img_name">Seleccione una Imagen</label>
                    <input type="file" name="img" id="img" autocomplete="off" accept="image/*">
                    <div class="img_upload" id="img_up">
                        <picture>
                            <source srcset="/build/img/users/<?php echo $usuario->imagen ?>.webp" type="image/webp">
                            <img loading="lazy" src="/build/img/users/<?php echo $usuario->imagen ?>.png" alt="usuario">
                        </picture>
                    </div>
                </div>
                <div class="formulario__campo">
                    <label for="password">Cambiar Contraseña</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="formulario__campo">
                    <label for="password_repeat">Repita la Nueva Contraseña</label>
                    <input type="password" name="password_repeat" id="password_repeat" required>
                </div>
                <div class="formulario__submit">
                    <input type="submit" value="Actualizar" class="btn verde">
                    <a href="/dashboard" class="btn naranja">Volver</a>
                </div>
            </fieldset>
            <input type="hidden" name="confirmado" value="<?php echo $usuario->confirmado; ?>">
        </form>
    </section>
</main>
<?php scripts("upload_img"); ?>