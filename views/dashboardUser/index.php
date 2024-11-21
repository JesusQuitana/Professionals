<main class="inicioUsuario">
    <?php include_once 'dashboard.php'; ?>
    <input type="hidden" id="idUser" value=<?php echo $id; ?>>
    <section class="usuarios">
        <h3>Proyectos</h3>
        <div class="alertas"><?php alertas($alertas); ?></div>
        <a href="/proyecto" class="btn verde new"><i class="fa-solid fa-circle-plus"></i>&nbsp;</a>

        <div class="projectUser"></div>
    </section>
</main>
<?php scripts("projects"); ?>