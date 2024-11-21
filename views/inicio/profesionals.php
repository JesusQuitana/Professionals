<section class="profesionals">
    <h2>Profesionales</h2>

    <article class="carrusel__profesionales slider swiper">
        <div class="swiper-wrapper">
            <?php foreach($profesionales as $profesional) : ?>
                <div class="profesionalCarrusel swiper-slide">
                    <div class="profesionalCarrusel--info">
                        <p class="nombre"><?php echo $profesional->nombre." ".$profesional->apellido; ?></p>
                        <picture>
                            <source srcset="/build/img/profes/<?php echo $profesional->imagen; ?>.png" type="image/png">
                            <img width="70" loading="lazy" src="/build/img/profes/<?php echo $profesional->imagen ?>.jpg" alt="profesional">
                        </picture>
                    </div>
                    <div class="profesionalCarrusel--tags">
                        <?php $tags= explode(",", $profesional->tags); foreach($tags as $tag) : ?>
                            <p><?php echo $tag; ?></p>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </article>

    <article>
        <picture>
            <img width="300" loading="lazy" src="/build/img/computer.jpg" alt="boletos"/>
        </picture>
        <div>
            <h3>Todos nuestros profesionales estan capacitados</h3>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum dolores nesciunt quaerat, repellendus in modi similique dolor enim ex voluptate odio natus adipisci officiis labore laudantium a! Voluptatum, id similique Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus incidunt consequuntur voluptatibus maxime qui atque cum voluptates dolores quaerat corrupti accusantium perferendis molestiae rem, autem placeat nam temporibus quos vero Lorem ipsum dolor sit amet, consectetur adipisicing elit. In nulla itaque id iusto voluptatum provident doloremque nemo, ipsam vel at nesciunt unde voluptatibus quos laudantium non ipsum, molestiae sed quaerat.</p>
        </div>
    </article>
</section>
<?php scripts("main"); ?>