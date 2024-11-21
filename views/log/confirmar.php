<section class="confirmar contenedor-min">
    <form method="POST">
        <fieldset class="formulario">
            <legend>Confirmar Cuenta</legend>
            <div class="formulario__campo">
                <label for="token">Ingresa el Token Valido:</label>
                <input type="number" name="token" id="token">
            </div>
            <div class="formulario__loading"></div>
        </fieldset>
    </form>
</section>
<?php scripts("confirmarToken"); ?>