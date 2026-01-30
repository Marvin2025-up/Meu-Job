<?php
require_once __DIR__ . '/../core/Conexao.php';
require_once __DIR__ . '/../core/Session.php';

Session::start();

if (!Session::isAdmin()) {
    header('Location: ../view/login.php');
    exit;
}

$action = $_GET['action'] ?? 'index';

class FormandoController
{
    // LISTAR
    public static function index()
    {
        $con = Conexao::ligar();
        $sql = "SELECT f.*, t.numero_turma 
                FROM formando f
                JOIN turma t ON f.id_turma = t.id_turma
                ORDER BY f.id_formando DESC";
        $rs = $con->query($sql);
        $formandos = $rs->fetch_all(MYSQLI_ASSOC);

        include __DIR__ . '/../view/Admin/dashboard_Admin.php';
    }

    // 👉 MOSTRAR FORMULÁRIO (ISTO FALTAVA)
    public static function create()
    {
        $con = Conexao::ligar();

        $turmas = $con->query("SELECT * FROM turma")->fetch_all(MYSQLI_ASSOC);
        $formadores = $con->query("SELECT * FROM formador")->fetch_all(MYSQLI_ASSOC);

        include __DIR__ . '/../view/Formando/criar_formando.php';
    }

    // SALVAR
    public static function store()
    {
        $con = Conexao::ligar();

        $sql = "INSERT INTO formando 
                (nome, numero, email, id_formador, id_turma)
                VALUES (?,?,?,?,?)";

        $st = $con->prepare($sql);
        $st->bind_param(
            "sisis",
            $_POST['nome'],
            $_POST['numero'],
            $_POST['email'],
            $_POST['id_formador'],
            $_POST['id_turma']
        );
        $st->execute();

        header('Location: FormandoController.php?action=index');
        exit;
    }

    // APAGAR
    public static function destroy()
    {
        $con = Conexao::ligar();
        $id = (int)$_GET['id'];

        $st = $con->prepare("DELETE FROM formando WHERE id_formando=?");
        $st->bind_param("i", $id);
        $st->execute();

        header('Location: FormandoController.php?action=index');
        exit;
    }
}

if (method_exists('FormandoController', $action)) {
    FormandoController::$action();
} else {
    FormandoController::index();
}
