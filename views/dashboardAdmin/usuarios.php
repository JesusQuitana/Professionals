<main class="admin">
    <?php include_once 'dashboard.php'; ?>
    
    <section class="usuarios">
        <h3>Usuarios</h3>

        <div id="paginacion">
            <div class="btnAnterior ocultar">
                <i class="fa-regular fa-square-caret-left"></i>
            </div>
            <div class="paginacion__numeros"></div>
            <div class="btnSiguiente">
                <i class="fa-regular fa-square-caret-right"></i>
            </div>
        </div>

        <table class="tabla__profesionales tabla-admin-usuarios">
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Email</td>
                    <td>Accion</td>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </section>
</main>
<?php scripts("users"); ?>