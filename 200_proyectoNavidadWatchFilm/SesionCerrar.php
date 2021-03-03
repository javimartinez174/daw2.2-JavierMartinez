<?php

require_once "_com/DAO.php";
if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) redireccionar("SesionInicioFormulario.php");
cerrarSesionRamYCookie();

redireccionar("SesionInicioFormulario.php?cerrarSesion");

