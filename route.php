<?php

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');
define('LOGIN', BASE_URL . 'login');

require_once "controllers/game_controller.php";
require_once "controllers/genre_controller.php";
require_once "controllers/home_controller.php";
require_once "controllers/login_controller.php";

require_once "models/genre_model.php";
require_once "models/game_model.php";

require_once "views/game_view.php";
require_once "views/genre_view.php";
require_once "views/home_view.php";
require_once "views/login_view.php";

$games = new game_controller();
$genres = new genre_controller();
$genre = new genre_controller();
$home = new home_view();
$game = new game_controller();
$bygenero = new game_controller();
$login = new login_controller();


if (!empty($_GET['action'])) {      // lee la acción del envio del formulario
    $action = $_GET['action'];
} else {
    $action = 'home';            // si no hay ninguna, setea home por defecto
}

$parametros = explode('/', $action);

switch ($parametros[0]) {
    case 'login':
        $login->show_login();
        break;

    case 'home':
        $home->mostrar_home();             //muestra el HOME    
        break;

    case 'generos':
        $genres->controller_genres();      //llama al controlador para mostrar todos los generos
        break;

    case 'juegos':
        $games->controller_games();      //muestra todos los juegos
        break;

    case 'juego':
        $id = $parametros[1];
        $game->controller_game($id);      //muestra un juego
        break;

    case 'bygenero':
        $id = $parametros[1];
        $bygenero->controller_game_bygenre($id);      //muestra un juego segun genero especifico
        break;

    case 'registro':
        $registro->mostrar_registro();      //mostrar la pagina para registrarse
        break;

    case 'modificar_game':
        $id = $parametros[1];
        $game->modificar_game($id);      //modifica un juego ya cargado
        break;

    case 'modificar':
        $id = $parametros[1];
        $genre->controller_update_genre($id);      //modifica un genero ya cargado
        break;

    case 'actualizar_game':
        $id = $parametros[1];
        $game->actualizar_game($id);      //actualizar un juego con datos del formulario
        break;

    case 'detalle':
                                                   //mostrar la pagina para registrarse
        break;
    
    default:
        echo "<h1>Error 404 - Page not found </h1>";    //MOSTRAR ALGO MAS PROLIJO
        break;

}
