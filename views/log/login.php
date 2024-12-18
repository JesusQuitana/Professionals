<section class="login">
    <form method="post" class="contenedor-min">
        <fieldset class="formulario">
            <legend>Log In</legend>

            <div class="alertas">
            <?php if(isset($alertas["error"]) || isset($alertas["exito"])) {
                    alertas($alertas);
                } ?>
            </div>

            <div class="formulario__campo">
                <label for="email">Correo</label>
                <input type="email" name="email" id="email" maxlength="45" autocomplete="off" required>
            </div>

            <div class="formulario__campo">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" maxlength="30" required>
            </div>

            <div class="formulario__campo" style="display: flex; flex-direction: row; justify-content:space-between;">
                <a href="/olvido">Olvido de Contraseña</a>
                <p>¿No tienes cuenta?&nbsp;<a href="/registro">Registrate</a></p>
            </div>

            <div class="formulario__submit">
                <input type="submit" value="Go It!" class="btn verde">
            </div>
        </fieldset>
    </form>
</section>