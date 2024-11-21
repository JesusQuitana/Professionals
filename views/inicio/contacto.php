<section class="contacto">
    <h2>Acerca de Nosotros</h2>
    <picture>
        <source srcset="/build/img/contacto.webp" type="image/webp">
        <img width="500" loading="lazy" src="/build/img/contacto.jpg" alt="contacto"/>
    </picture>

    <form class="formulario contenedor-min" method="post">
        <fieldset>
            <legend>Contacta con Nosotros</legend>

            <div class="alertas">
                <?php alertas($alertas); ?>
            </div>

            <div class="formulario__campo">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name">
            </div>
            <div class="formulario__campo">
                <label for="mensaje">Mensaje</label>
                <textarea name="mensaje" id="mensaje"></textarea>
            </div>
            <div class="formulario__campo">
                <label for="contacto">¿Cómo desearia ser contactado?</label>
                <div class="contacto__campo">
                    <input type="radio" name="contacto" class="contacto_radio" value="1"><label>Telefono</label>
                </div>
                <div class="contacto__campo">
                    <input type="radio" name="contacto" class="contacto_radio" value="2"><label>E-Mail</label>
                </div>
            </div>
            <div class="formulario__campo acerca_de"></div>
            <div class="formulario__submit">
                <input type="submit" value="Enviar" class="btn verde">
            </div>
        </fieldset>
    </form>
</section>
<?php scripts("inicio"); ?>