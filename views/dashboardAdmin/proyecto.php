<main class="admin">
    <?php include_once 'dashboard.php'; ?>
    <section class="proyectos">
        <h3>Proyectos</h3>

        <div id="paginacion">
            <div class="btnAnterior ocultar">
                <i class="fa-regular fa-square-caret-left"></i>
            </div>
            <div class="paginacion__numeros"></div>
            <div class="btnSiguiente">
                <i class="fa-regular fa-square-caret-right"></i>
            </div>
        </div>

        <table class="tabla__proyectos">
            <thead>
                <tr>
                    <td>Proyecto</td>
                    <td>Accion</td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </section>
    <?php scripts("proyectos"); ?>
</main>