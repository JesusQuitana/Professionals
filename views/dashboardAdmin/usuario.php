<main class="admin">
    <?php include_once 'dashboard.php'; ?>
    <section class="usuarios">
        <h3>Usuario</h3>
        <div class="alertas"><?php alertas($alertas); ?></div>
        <form method="post" enctype="multipart/form-data">
            <fieldset class="formulario">
                <div class="formulario__campo">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $profesional->nombre; ?>" disabled>
                </div>
                <div class="formulario__campo">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" value="<?php echo $profesional->apellido; ?>" disabled>
                </div>
                <div class="formulario__campo">
                    <label for="email">Pais</label>
                    <input type="text" name="email" id="email" value="<?php echo $profesional->email; ?>" disabled>
                </div>
                <div class="formulario__campo">
                    <label for="img" class="img_name">Seleccione una Imagen</label>
                    <input type="file" name="img" id="img" autocomplete="off" accept="image/*" disabled>
                    <div class="img_upload" id="img_up">
                        <picture>
                            <source srcset="/build/img/profes/<?php echo $profesional->imagen ?>.webp" type="image/webp">
                            <img loading="lazy" src="/build/img/profes/<?php echo $profesional->imagen ?>.png" alt="profesional">
                        </picture>
                    </div>
                </div>
                <div class="formulario__submit">
                    <a href="/usuarios" class="btn naranja">Volver</a>
                </div>
                <input type="hidden" name="tags" id="tag" value="<?php echo $profesional->tags; ?>">
            </fieldset>
        </form>
    </section>
</main>
<?php scripts("upload_img"); ?>