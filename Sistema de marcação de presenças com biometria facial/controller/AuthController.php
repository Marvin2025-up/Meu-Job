<?php
require_once __DIR__ . '/../core/conexao.php';
require_once __DIR__ . '/../core/Session.php';

Session::start();

$action = $_GET['action'] ?? 'login';

class AuthController
{
    public static function login()
    {
        include __DIR__ . '/../view/login.php';
    }

    public static function autenticar()
    {
        $con = Conexao::ligar();

        $email = trim($_POST['email'] ?? '');
        $senha = $_POST['senha'] ?? '';
        $lembrar = !empty($_POST['lembrar']);

        if ($email === '' || $senha === '') {
            Session::set('erro', 'Preencha username e senha.');
            header('Location: ../view/login.php');
            exit;
        }

        $st = $con->prepare("SELECT id_admin AS codigo, email, senha FROM administrador WHERE email=? LIMIT 1");
        $st->bind_param('s', $email);
        $st->execute();
        $administrador = $st->get_result()->fetch_assoc();

        if ($administrador && password_verify($senha, $administrador['senha'])) {

            Session::set('tipo', 'administrador');
            Session::set('codigo', $administrador['codigo']);
            Session::set('email', $administrador['email']);

            if ($lembrar) {
                setcookie('email_login', $email, time() + (30 * 24 * 60 * 60), "/");
            } else {
                setcookie('email_login', '', time() - 3600, "/");
            }

            setcookie('ultimo_acesso', date('Y-m-d H:i:s'), time() + (365 * 24 * 60 * 60), "/");

            header('Location: ../view/Admin/dashboard_Admin.php');
            exit;
        }

        Session::set('erro', 'Credenciais inválidas.');
        header('Location: ../view/login.php');
        exit;
    }

    public static function logout()
    {
        Session::destroy();
        header('Location: ../view/login.php');
        exit;
    }
}

AuthController::$action();
