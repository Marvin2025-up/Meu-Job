<?php
require_once __DIR__ . '/../core/Conexao.php';
require_once __DIR__ . '/../core/Session.php';

Session::start();

if (!Session::isAdmin()) {
    header('Location: ../view/login.php');
    exit;
}

$action = $_GET['action'] ?? 'index';

class FormadorController {

    public static function index() {
        $con = Conexao::ligar();
        $rs = $con->query("SELECT * FROM formador");
        $formadores = $rs->fetch_all(MYSQLI_ASSOC);
        include __DIR__ . '/../view/Admin/dashboard_Admin.php';
    }

    public static function create() {
        include __DIR__ . '/../view/Formador/criar_formador.php';
    }

    public static function store() {
        $con = Conexao::ligar();
        $hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO formador
                (nome, genero, data_nascimento, email, telefone, senha)
                VALUES (?,?,?,?,?,?)";

        $st = $con->prepare($sql);
        $st->bind_param(
            "ssssss",
            $_POST['nome'],
            $_POST['genero'],
            $_POST['data_nascimento'],
            $_POST['email'],
            $_POST['telefone'],
            $hash
        );
        $st->execute();

        header("Location: FormadorController.php?action=index");
        exit;
    }

    public static function destroy() {
        $con = Conexao::ligar();
        $id = (int)$_GET['id'];

        $st = $con->prepare("DELETE FROM formador WHERE id_formador=?");
        $st->bind_param("i", $id);
        $st->execute();

        header("Location: FormadorController.php?action=index");
        exit;
    }
}

switch ($action) {
    case 'create': FormadorController::create(); break;
    case 'store': FormadorController::store(); break;
    case 'destroy': FormadorController::destroy(); break;
    default: FormadorController::index();
}
