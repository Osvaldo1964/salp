<?php
$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);
//echo '<pre>'; print_r($_SESSION); echo '</pre>';exit;
?>

<aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link bg-info">
        <!-- <img src="views/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light ml-3"> S.A.L.P.</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <?php if ($_SESSION["user"]->picture_user == null) : ?>
                    <img src="<?php echo TemplateController::srcImg() ?>views/img/users/default/default.png" class="img-circle elevation-2" alt="User Image">
                <?php else : ?>
                    <img src="<?php echo TemplateController::srcImg() ?>views/img/users/<?php echo $_SESSION["user"]->id_user ?>/<?php echo $_SESSION["user"]->picture_user ?>" class="img-circle elevation-2" alt="User Image">
                <?php endif ?>
            </div>
            <div class="info">
                <a href="#" class="d-block"><?php echo $_SESSION["user"]->fullname_user ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="/" class="nav-link <?php if (empty($routesArray[1])) : ?>active<?php  ?><?php endif ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Inicio
                        </p>
                    </a>
                </li>

                <!-- Menu de ADMINISTRACION - USUARIOS -->
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "admins") : ?>active bg-info<?php endif ?>">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            CONFIGURACION
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "admins" || $routesArray[1] == "modules" || $routesArray[1] == "roles") : ?>active bg-info<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Parámetros
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/settings" class="nav-link  <?php if (!empty($routesArray[1]) &&  $routesArray[1] == "settings") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Generales</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/reports" class="nav-link  <?php if (!empty($routesArray[1]) &&  $routesArray[1] == "reports") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Diseño Documentos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "admins" || $routesArray[1] == "modules" || $routesArray[1] == "roles") : ?>active bg-info<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    Control de Usuarios
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/cuadrillas" class="nav-link  <?php if (!empty($routesArray[1]) &&  $routesArray[1] == "modules") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Modulos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../examples/register.html" class="nav-link <?php if ($routesArray[1] == "roles") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Roles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/admins" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "admins") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Usuarios</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Menu de PQRs-->
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "subjects") : ?>active bg-info<?php endif ?>">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            PQRs
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "subjects") : ?>active bg-info<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    TABLAS
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/crews" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "crews") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cuadrillas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "subjects") : ?>active bg-info<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    MOVIMIENTOS
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/pqrs" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "pqrs") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Registro</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/setpqrs" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "setpqrs") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Seguimiento</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "generate") : ?>active bg-info<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    REPORTES
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/infpqrs" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "generate") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>PQRs por Fechas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/infindis" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Indice Disponibilidad</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Menu de ELEMENTOS-->
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "subjects") : ?>active bg-info<?php endif ?>">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            INVENTARIO
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "subjects") : ?>active bg-info<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    TABLAS
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/classes" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "powers") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Clases</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/technologies" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "technologies") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tecnologías</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/powers" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "powers") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Potencias</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/resources" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "powers") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Recursos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/rouds" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "powers") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Rutas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/materials" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "materials") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Materiales</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/transformers" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "transformers") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Transformadores</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/elements" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "elements") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Elementos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "subjects") : ?>active bg-info<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    MOVIMIENTOS
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/typedeliveries" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "typedeliveries") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Tipo de Actas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/itemdeliveries" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "itemdeliveries") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Subtipos de Actas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/deliveries" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "deliveries") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Registro de Actas</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "generate") : ?>active bg-info<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    REPORTES
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/generate" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "generate") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Generar Mandamientos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/controlpqrs" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Seguimiento PQRs</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Menu de PREDIAL-->
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "subjects") : ?>active bg-info<?php endif ?>">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            INFORMES
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "subjects") : ?>active bg-info<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    TABLAS
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/subjects" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "subjects") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sujetos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/titles" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "titles") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Títulos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/payorders" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "payorders") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Mandamientos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "generate") : ?>active bg-info<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    MOVIMIENTOS
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/generate" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "generate") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Generar Mandamientos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/controlpqrs" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Seguimiento PQRs</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    REPORTES
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../examples/login-v2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Repo 1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../examples/register-v2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Repo 2</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Menu de COACTIVO-->
                <li class="nav-item menu-close">
                    <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "subjects") : ?>active bg-info<?php endif ?>">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            GRAFICAS
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "subjects") : ?>active bg-info<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    PROCESOS
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/subjects" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "subjects") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Sujetos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/titles" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "titles") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Títulos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/payorders" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "payorders") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Mandamientos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "generate") : ?>active bg-info<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    MOVIMIENTOS
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/generate" class="nav-link <?php if (!empty($routesArray[1]) && $routesArray[1] == "generate") : ?>active bg-info<?php endif ?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Generar Mandamientos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/controlpqrs" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Seguimiento PQRs</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>
                                    REPORTES
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="../examples/login-v2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Repo 1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="../examples/register-v2.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Repo 2</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!--                 <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Cerrar Sesión</p>
                    </a>
                </li>
 -->
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>