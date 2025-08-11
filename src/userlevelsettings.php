<?php

namespace PHPMaker2025\project1;

/**
 * User levels
 *
 * @var array<int, string, string>
 * [0] int User level ID
 * [1] string User level name
 * [2] string User level hierarchy
 */
$USER_LEVELS = [["-2","Anonymous",""]];

/**
 * User roles
 *
 * @var array<int, string>
 * [0] int User level ID
 * [1] string User role name
 */
$USER_ROLES = [["-1","ROLE_ADMIN"],
    ["","ROLE_UNDEFINED"]];

/**
 * User level permissions
 *
 * @var array<string, int, int>
 * [0] string Project ID + Table name
 * [1] int User level ID
 * [2] int Permissions
 */
$USER_LEVEL_PRIVS = [["{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}aportes_legales","-2","0"],
    ["{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}compras","-2","0"],
    ["{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}cooperativas","-2","0"],
    ["{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}horas_trabajadas","-2","0"],
    ["{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}ingresos","-2","0"],
    ["{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}movimientos_stock","-2","0"],
    ["{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}pagos_socios","-2","0"],
    ["{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}proveedores","-2","0"],
    ["{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}socios","-2","0"],
    ["{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}stock","-2","0"],
    ["{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}actividad_log","-2","0"],
    ["{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}usuarios","-2","0"]];

/**
 * Tables
 *
 * @var array<string, string, string, bool, string>
 * [0] string Table name
 * [1] string Table variable name
 * [2] string Table caption
 * [3] bool Allowed for update (for userpriv.php)
 * [4] string Project ID
 * [5] string URL (for OthersController::index)
 */
$USER_LEVEL_TABLES = [["aportes_legales","aportes_legales","aportes legales",true,"{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}","AportesLegalesList"],
    ["compras","compras","compras",true,"{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}","ComprasList"],
    ["cooperativas","cooperativas","cooperativas",true,"{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}","CooperativasList"],
    ["horas_trabajadas","horas_trabajadas","horas trabajadas",true,"{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}","HorasTrabajadasList"],
    ["ingresos","ingresos","ingresos",true,"{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}","IngresosList"],
    ["movimientos_stock","movimientos_stock","movimientos stock",true,"{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}","MovimientosStockList"],
    ["pagos_socios","pagos_socios","pagos socios",true,"{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}","PagosSociosList"],
    ["proveedores","proveedores","proveedores",true,"{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}","ProveedoresList"],
    ["socios","socios","socios",true,"{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}","SociosList"],
    ["stock","stock","stock",true,"{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}","StockList"],
    ["actividad_log","actividad_log","actividad log",true,"{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}","ActividadLogList"],
    ["usuarios","usuarios","usuarios",true,"{DE8D5E86-44E5-4B2C-9D69-3206442E37A6}","UsuariosList"]];
