<header class="dashboardHeader">
    <h1>&#9874; Professional'S &#9874;</h1>
    <nav class="navLog">
        <?php
        session_start();
        if($_SESSION["login"]) {
            echo "<a href='/logout'>Cerrar Sesion</a>";
        } else {
            echo '<a href="registro">Registrarse</a><a href="login">Iniciar Sesion</a>';
        }
        ?>
        <div class="darkmode">
            <i class="fa fa-moon"></i>
            <i class="fa fa-sun"></i>
        </div>
    </nav>
</header>