<main class="admin">
    <?php include_once 'dashboard.php'; ?>

    <section class="profesionales">
        <h3>Profesionales</h3>
        <a href="/profesionales" class="btn verde new"><i class="fa-solid fa-circle-plus"></i>&nbsp;</a>

        <div id="paginacion">
            <div class="btnAnterior ocultar">
                <i class="fa-regular fa-square-caret-left"></i>
            </div>
            <div class="paginacion__numeros"></div>
            <div class="btnSiguiente">
                <i class="fa-regular fa-square-caret-right"></i>
            </div>
        </div>

        <table class="tabla__profesionales tabla-admin-profesionales">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Ubicacion</td>
                    <td>Accion</td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </section>
</main>
<?php scripts("profesionals"); ?>