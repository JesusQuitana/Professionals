<header class="header">
    <div class="manto">
        <img src="/build/img/grafico.svg" alt="">   
        <img src="/build/img/grafico.svg" alt="">   
    </div>
    <h1>&#9874; Professional'S &#9874;</h1>
    <div class="informacion">
        <a href="profesionals">Ver Catalogo y Profesionales</a>
    </div>
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
<div class="barra">
    <h2>&#9874; Professional'S &#9874;</h2>
    <div class="barra_nav">
        <a href="/">Inicio</a>
        <a href="/profesionals">Profesionales</a>
        <a href="/boletos">Boletos</a>
        <a href="/contacto">Acerca de Nosotros</a>
    </div>
</div>
<main class="contenedor">