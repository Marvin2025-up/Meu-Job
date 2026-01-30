<?php 
require_once __DIR__ . '/../core/conexao.php';
require_once __DIR__ . '/../core/session.php';
Session::start();

// Proteção de rota: apenas administradores
if (Session::get('tipo') !== 'administrador'){
    header('Location: ../view/login.php');
    exit;
}

$action = $_GET['action'] ?? 'index';

class FormandoController
{
    // Listar todos os formandos
    public static function index(){
        $con = Conexao::ligar();
        $sql = "SELECT * FROM formando ORDER BY id_formando ASC";
        $rs = $con->query($sql);
        $formandos = $rs->fetch_all(MYSQLI_ASSOC);

        // Ajuste para a sua view de listagem/dashboard
        include __DIR__. '/../view/Admin/dashboard_Admin.php';
    }

    // Salvar novo formando (Ação do formulário que você enviou)
    public static function store()
    {
        $con = Conexao::ligar();
        $data = $_POST['data_nascimento'];

        if ($data > date('Y-m-d')) {
            Session::set('erro', 'A data de nascimento não pode ser futura.');
            header('Location: ../view/Formando/criar_formando.php'); 
            exit;
        }

        // Criptografar a senha por segurança
        $hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        // SQL com os campos: nome, genero, data_nascimento, email, telefone, estado, turma, senha
        $sql = "INSERT INTO formando (nome, genero, data_nascimento, email, telefone, estado, turma, senha) VALUES (?,?,?,?,?,?,?,?)";
        
        $st = $con->prepare($sql);
        
        // 'ssssssss' = 8 strings
        $st->bind_param('ssssssss', 
            $_POST['nome'], 
            $_POST['genero'], 
            $_POST['data_nascimento'], 
            $_POST['email'], 
            $_POST['telefone'], 
            $_POST['estado'], 
            $_POST['turma'],
            $hash
        );

        if($st->execute()){
            Session::set('sucesso', 'Formando cadastrado com sucesso!');
        } else {
            Session::set('erro', 'Falha ao cadastrar no banco de dados.');
        }

        header('Location: FormandoController.php?action=index');
        exit;
    }

    // Mostrar formulário de edição
    public static function edit()
    {
        $con = Conexao::ligar();
        $id = (int)($_GET['id'] ?? 0);

        $st = $con->prepare("SELECT * FROM formando WHERE id_formando = ?");
        $st->bind_param('i', $id);
        $st->execute();
        $row = $st->get_result()->fetch_assoc();

        if (!$row) {
            die('Formando não encontrado');
        }
        include __DIR__ . '/../view/Formando/editar_formando.php';
    }

    // Atualizar dados
    public static function update()
    {
        $con = Conexao::ligar();
        $id = (int)$_POST['id_formando'];

        $sql = "UPDATE formando SET nome=?, genero=?, data_nascimento=?, email=?, telefone=?, estado=?, turma=? WHERE id_formando=?";
        $st = $con->prepare($sql);
        $st->bind_param('sssssssi', 
            $_POST['nome'], 
            $_POST['genero'], 
            $_POST['data_nascimento'], 
            $_POST['email'], 
            $_POST['telefone'], 
            $_POST['estado'], 
            $_POST['turma'], 
            $id
        );
        $st->execute();

        header('Location: FormandoController.php?action=index');
        exit;
    }

    // Excluir registro
    public static function destroy()
    {
        $con = Conexao::ligar();
        $id = (int)($_GET['id'] ?? 0);

        $st = $con->prepare("DELETE FROM formando WHERE id_formando = ?");
        $st->bind_param('i', $id);
        $st->execute();

        header('Location: FormandoController.php?action=index');
        exit;
    }
}

// Execução dinâmica da ação
if (method_exists('FormandoController', $action)) {
    FormandoController::$action();
} else {
    FormandoController::index();
}