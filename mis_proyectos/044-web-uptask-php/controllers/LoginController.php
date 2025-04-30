<?php
    
namespace Controllers;
use MVC\Router;

class LoginController {

    public static function login(Router $router) {


        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Instanciar el objeto
            
        }

        // Render a la vista
        $router->render('auth/login', [
            'titulo' => 'Iniciar Sesión'
            
        ]);

    }

    public static function logout() {
        echo "Desde LogoutController";
    }

    public static function crear(Router $router) {

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Instanciar el objeto
            
        }

        // Render a la vista
        $router->render('auth/crear', [
            'titulo' => 'Crear Cuenta'
            
        ]);

    }

    public static function olvide() {
        echo "Desde OlvideController";

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Instanciar el objeto
            
        }
    }

    public static function reestablecer() {
        echo "Desde ReestablecerController";

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Instanciar el objeto
            
        }
    }

    public static function confirmar() {
        echo "Desde ConfirmarController";
    }

    public static function mensaje() {
        echo "Desde MensajeController";
    }




    
}








