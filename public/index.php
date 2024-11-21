<?php
require_once dirname(__DIR__) . '/includes/app.php';
use MVC\Router;
use Controller\InicioController;
use Controller\UserController;
use Controller\AdminController;
use Controller\ApiController;

//RUTAS GET
Router::rutasGETvalidas("/login", [InicioController::class, "login"]);
Router::rutasGETvalidas("/logout", [InicioController::class, "logOut"]);
Router::rutasGETvalidas("/registro", [InicioController::class, "registro"]);
Router::rutasGETvalidas("/olvido", [InicioController::class, "olvido"]);
Router::rutasGETvalidas("/confirmar", [InicioController::class, "confirmar"]);

Router::rutasGETvalidas("/", [InicioController::class, "inicio"]);
Router::rutasGETvalidas("/contacto", [InicioController::class, "contacto"]);
Router::rutasPOSTvalidas("/contacto", [InicioController::class, "contacto"]);
Router::rutasGETvalidas("/boletos", [InicioController::class, "boletos"]);
Router::rutasGETvalidas("/profesionals", [InicioController::class, "profesionales"]);
Router::rutasGETvalidas("/profesionals/profesionals", [ApiController::class, "profesionals"]);

Router::rutasGETvalidas("/dashboard", [UserController::class, "inicio"]);
Router::rutasGETvalidas("/proyecto", [UserController::class, "addProyecto"]);
Router::rutasGETvalidas("/informacion", [UserController::class, "informacion"]);

Router::rutasGETvalidas("/admin", [AdminController::class, "inicio"]);
Router::rutasGETvalidas("/admin/editar", [AdminController::class, "editarProfesional"]);
Router::rutasGETvalidas("/profesionales", [AdminController::class, "addProfesionales"]);
Router::rutasPOSTvalidas("/profesionales", [AdminController::class, "addProfesionales"]);
Router::rutasGETvalidas("/proyectos", [AdminController::class, "proyectos"]);
Router::rutasGETvalidas("/usuarios", [AdminController::class, "usuarios"]);
Router::rutasGETvalidas("/usuarios/editar", [AdminController::class, "editarUsuarios"]);


//RUTAS POST
Router::rutasPOSTvalidas("/login", [InicioController::class, "login"]);
Router::rutasPOSTvalidas("/registro", [InicioController::class, "registro"]);
Router::rutasPOSTvalidas("/olvido", [InicioController::class, "olvido"]);
Router::rutasPOSTvalidas("/admin/editar", [AdminController::class, "editarProfesional"]);
Router::rutasPOSTvalidas("/informacion", [UserController::class, "informacion"]);
Router::rutasPOSTvalidas("/proyecto", [UserController::class, "addProyecto"]);

//RUTAS CON ENDPOINT EN LA API
Router::rutasPOSTvalidas("/confirmar", [ApiController::class, "confirmar"]);
Router::rutasGETvalidas("/admin/profesional/count", [ApiController::class, "count"]);
Router::rutasPOSTvalidas("/admin/profesional/pages", [ApiController::class, "paginacion"]);
Router::rutasPOSTvalidas("/admin/profesional/editar", [ApiController::class, "editarProfesional"]);
Router::rutasGETvalidas("/proyectos/count", [ApiController::class, "countProyectos"]);
Router::rutasPOSTvalidas("/proyectos/pages", [ApiController::class, "paginacionProyectos"]);
Router::rutasPOSTvalidas("/proyectos/user", [ApiController::class, "findUser"]);
Router::rutasPOSTvalidas("/proyectos/profesios", [ApiController::class, "findProfesios"]);
Router::rutasPOSTvalidas("/proyectos/confirmar", [ApiController::class, "estatusProyecto"]);
Router::rutasGETvalidas("/usuarios/users/count", [ApiController::class, "countUsers"]);
Router::rutasPOSTvalidas("/usuarios/users/pages", [ApiController::class, "paginacionUsers"]);
Router::rutasPOSTvalidas("/usuarios/users/editar", [ApiController::class, "editarProfesionalUsers"]);
Router::rutasPOSTvalidas("/proyecto/profesionals", [ApiController::class, "profesionalesAll"]);
Router::rutasPOSTvalidas("/dashboard/api", [ApiController::class, "projectsAll"]);


Router::initApp();