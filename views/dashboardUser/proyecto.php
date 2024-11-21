<main class="inicioUsuario">
    <?php include_once 'dashboard.php'; ?>
    <section class="profesionales">
        <h3>Profesional</h3>
        <div class="alertas"><?php alertas($alertas); ?></div>
        <form method="post" enctype="multipart/form-data">
            <fieldset class="formulario">
                <div class="formulario__campo">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $proyecto->nombre; ?>">
                </div>
                <div class="formulario__campo">
                    <label for="descripcion">Descripcion</label>
                    <textarea name="descripcion" id="descripcion" maxlength="255"><?php echo $proyecto->descripcion; ?></textarea>
                </div>
                <div class="formulario__campo">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" id="precio" value="<?php echo $proyecto->precio; ?>">
                </div>
                <div class="formulario__campo">
                    <label for="profesionals">Etiqueta</label>
                    <input type="text" name="profesionals" id="profesionals" placeholder="Ej. PHP JavaScript Node.js">
                </div>
                <ul class="nombreProfesionalesSeleccionados"></ul>
                <div class="profesionals"></div>
                <div class="formulario__submit">
                    <input type="submit" value="Actualizar" class="btn verde">
                    <a href="/admin" class="btn naranja">Volver</a>
                </div>
                <input type="hidden" name="profesional_id" id="profesional" value="<?php echo $proyecto->tags; ?>">
            </fieldset>
        </form>
    </section>
</main>
<?php scripts("proyecto"); ?>