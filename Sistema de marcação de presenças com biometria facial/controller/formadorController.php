
<?php 
require_once __DIR__ . '/../core/conexao.php';
require_once __DIR__ . '/../core/session.php';
Session::start();
// Proteção de rota: apenas administradores
if (Session::get('tipo') !== 'administrador'){
    header('Location: ../view/login.php');
    exit;
}
// Captura a ação da URL
$action = $_GET['action'] ?? 'index';

class FormadorController
{
    
    public static function index(){
        $con = Conexao::ligar();
        $sql = "SELECT id_formador, nome, genero, email, telefone FROM formador ORDER BY id_formador ASC";
        $rs = $con->query($sql);
        $formadores = $rs->fetch_all(MYSQLI_ASSOC);
        include __DIR__. '/../view/Admin/dashboard_Admin.php';
    }

   public static function create()
    {
        $row = [
            'id_formador' => null,
            'nome' => '',
            'genero' => '',
            'data_nascimento' => '',
            'email' => '',
            'telefone' => '',
            'senha' => ''
        ];
        include __DIR__ . '/../view/Formador/criar_formador.php';
    }

    // 3. SALVAR NOVO (Create)
 public static function store() {
   $data = $_POST['data_nascimento'];
        if ($data > date('Y-m-d')) {
            Session::set('erro', 'A data de nascimento não pode ser posterior à data actual.');
            header('Location: formadorController.php?action=create');
            exit;
        }    
    $con = Conexao::ligar();
    $hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO formador 
            (nome, genero, data_nascimento, email, telefone, senha)
            VALUES (?,?,?,?,?,?)";
    $st = $con->prepare($sql);
    if(!$st){
        die("Prepare erro: ".$con->error);
    }
    $st->bind_param(
        "ssssss",
        $_POST['nome'],
        $_POST['genero'],
        $_POST['data_nascimento'],
        $_POST['email'],
        $_POST['telefone'],
        $hash
    );
    if(!$st->execute()){
        die("Execute erro: ".$st->error);
    }
    header("Location: formadorController.php?action=index");
    exit;
}


    // 4. MOSTRAR FORMULÁRIO DE EDIÇÃO
    public static function edit() {
        $con = Conexao::ligar();
        $id = (int)($_GET['id'] ?? 0);

        $st = $con->prepare("SELECT * FROM formador WHERE id_formador = ?");
        $st->bind_param('i', $id);
        $st->execute();
        $row = $st->get_result()->fetch_assoc();

        if (!$row) {
            die('Formador não encontrado');
        }
        include __DIR__ . '/../view/Formador/editar_formador.php';
    }

    // 5. SALVAR ALTERAÇÕES (Update)
    public static function update() {
        $con = Conexao::ligar();
        $id = (int)$_POST['id_formador'];
        
        // Se o campo senha for preenchido, atualiza a senha. Se não, mantém a atual.
        if (!empty($_POST['senha'])) {
            $hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $sql = "UPDATE formador SET nome=?, genero=?, data_nascimento=?, email=?, telefone=?, senha=? WHERE id_formador=?";
            $st = $con->prepare($sql);
            $st->bind_param('ssssssi', $_POST['nome'], $_POST['genero'], $_POST['data_nascimento'], $_POST['email'], $_POST['telefone'], $hash, $id);
        } else {
            $sql = "UPDATE formador SET nome=?, genero=?, data_nascimento=?, email=?, telefone=? WHERE id_formador=?";
            $st = $con->prepare($sql);
            $st->bind_param('sssssi', $_POST['nome'], $_POST['genero'], $_POST['data_nascimento'], $_POST['email'], $_POST['telefone'], $id);
        }
        $st->execute();
        header('Location: formadorController.php?action=index');
        exit;
    }

    // 6. ELIMINAR (Delete)

    public static function destroy(){
        
        $con = Conexao::ligar();
        $id = (int)($_GET['id'] ?? 0);

        $st = $con->prepare("DELETE FROM formador WHERE id_formador = ?");
        $st->bind_param('i', $id);
        $st->execute();

        header('Location: formadorController.php?action=index');
        exit;



    }



}

switch ($action) {
    case 'store':
        FormadorController::store();
        break;
    case 'create':
        FormadorController::create();
        break;
    case 'edit':
        FormadorController::edit();
        break;
    case 'update':
        FormadorController::update();
        break;
    case 'index':
    default:
        FormadorController::index();
        break;}