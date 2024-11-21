<main class="admin">
    <?php include_once 'dashboard.php'; ?>
    <section class="profesionales">
        <h3>Profesional</h3>
        <div class="alertas"><?php alertas($alertas); ?></div>
        <form method="post" enctype="multipart/form-data">
            <fieldset class="formulario">
                <div class="formulario__campo">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $profesional->nombre; ?>">
                </div>
                <div class="formulario__campo">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" value="<?php echo $profesional->apellido; ?>">
                </div>
                <div class="formulario__campo">
                    <label for="pais">Pais</label>
                    <input type="text" name="pais" id="pais" value="<?php echo $profesional->pais; ?>">
                </div>
                <div class="formulario__campo">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" name="ciudad" id="ciudad" value="<?php echo $profesional->ciudad; ?>">
                </div>
                <div class="formulario__campo">
                    <label for="tags">Etiquetas</label>
                    <input type="text" name="tag" id="tags" placeholder="Ej. PHP JavaScript Node.js">
                </div>
                <ul class="tags"></ul>
                <div class="formulario__campo">
                    <label for="img" class="img_name">Seleccione una Imagen</label>
                    <input type="file" name="img" id="img" autocomplete="off" accept="image/*">
                    <div class="img_upload" id="img_up">
                        <picture>
                            <source srcset="/build/img/profes/<?php echo $profesional->imagen ?>.webp" type="image/webp">
                            <img loading="lazy" src="/build/img/profes/<?php echo $profesional->imagen ?>.png" alt="profesional">
                        </picture>
                    </div>
                </div>
                <div class="formulario__campo redes">
                    <i class="fa-brands fa-facebook social"></i>
                    <input type="url" name="redes[facebook]" placeholder="Tu Facebook" value="<?php echo $redes->facebook; ?>">
                </div>
                <div class="formulario__campo redes">
                    <i class="fa-brands fa-github social"></i>
                    <input type="url" name="redes[github]" placeholder="Tu GitHub" value="<?php echo $redes->github; ?>">
                </div>
                <div class="formulario__campo redes">
                    <i class="fa-brands fa-instagram social"></i>
                    <input type="url" name="redes[instagram]" placeholder="Tu Instagram" value="<?php echo $redes->instagram; ?>">
                </div>
                <div class="formulario__campo redes">
                    <i class="fa-brands fa-tiktok social"></i>
                    <input type="url" name="redes[tiktok]" placeholder="Tu TikTok" value="<?php echo $redes->tiktok; ?>">
                </div>
                <div class="formulario__submit">
                    <input type="submit" value="Actualizar" class="btn verde">
                    <a href="/admin" class="btn naranja">Volver</a>
                </div>
                <input type="hidden" name="tags" id="tag" value="<?php echo $profesional->tags; ?>">
            </fieldset>
        </form>
    </section>
</main>
<?php scripts("upload_img"); scripts("tagsProfesionales"); ?>