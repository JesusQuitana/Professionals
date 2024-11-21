<section class="registro">
    <form method="post" class="contenedor-min" enctype="multipart/form-data">
        <fieldset class="formulario">
            <legend>Registro</legend>
            <div class="alertas">
                <?php alertas($alertas); ?>
            </div>
            <div class="formulario__campo">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" autocomplete="off" maxlength="45" value="<?php echo $usuario->nombre; ?>" required>
            </div>
            <div class="formulario__campo">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" id="apellido" autocomplete="off" maxlength="45" value="<?php echo $usuario->apellido; ?>" required>
            </div>
            <div class="formulario__campo">
                <label for="email">E-Mail</label>
                <input type="email" name="email" id="email" autocomplete="off" maxlength="45" value="<?php echo $usuario->email; ?>" required>
            </div>
            <div class="formulario__campo">
                <label for="img" class="img_name">Seleccione una Imagen</label>
                <input type="file" name="img" id="img" autocomplete="off" accept="image/*">
                <div class="img_upload" id="img_up"></div>
            </div>
            <div class="formulario__campo">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="formulario__campo">
                <label for="password_repeat">Repita Contraseña</label>
                <input type="password" name="password_repeat" id="password_repeat" required>
            </div>
            <div class="formulario__redes">
                <p>¿Ya tienes cuenta? &raquo;&nbsp;<a href="/login">Inicia Sesion</a></p>
            </div>
            <div class="formulario__submit">
                <input type="submit" value="Registrar" class="btn verde">
            </div>
        </fieldset>
    </form>
</section>
<?php scripts("upload_img"); ?>