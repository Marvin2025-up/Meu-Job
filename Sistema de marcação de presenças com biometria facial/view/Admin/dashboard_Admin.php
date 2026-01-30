<?php
require_once __DIR__ . '/../../core/Session.php';
Session::start();
if (!Session::isAdmin()) { header('Location: ../login.php'); exit; }
$email = Session::get('email', 'Admin');
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - ESCOLA +</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        :root {
            --cor-primaria: #144750;   /* Azul Petróleo Escuro  */
            --cor-secundaria: #0F353C; /* Tom Médio  */
            --cor-terciaria: #0A2428;  /* Tom Profundo  */
            --cor-destaque: #4dbce9;   /* Azul claro para contraste */
            --cor-sucesso: #8dc63f;    /* Verde */
            --cor-alerta: #e95d35;     /* Laranja/Vermelho */
            --cor-texto: #ffffff;
            }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Poppins", sans-serif; }

        body { 
            display: flex; 
            min-height: 100vh; 
            background: linear-gradient(135deg, var(--cor-primaria) 0%, var(--cor-terciaria) 100%); 
            color: var(--cor-texto);
            overflow-x: hidden;
        }

        /* Sidebar */
        .sidebar { 
            width: 280px; 
            background: rgba(15, 53, 60, 0.95); 
            backdrop-filter: blur(15px); 
            padding: 30px 20px; 
            border-right: 1px solid rgba(255,255,255,0.1);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
        }

        .sidebar h2 {
            font-size: 24px;
            letter-spacing: 2px;
            margin-bottom: 40px;
            text-align: center;
            color: var(--cor-destaque);
        }

        .nav-link { 
            text-decoration: none; 
            color: rgba(255,255,255,0.7); 
            padding: 15px; 
            border-radius: 12px; 
            margin-bottom: 10px; 
            display: flex; 
            align-items: center; 
            gap: 12px; 
            cursor: pointer; 
            transition: 0.3s;
        }

        .nav-link:hover, .nav-link.active { 
            background: var(--cor-primaria); 
            color: white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
        }

        /* Conteúdo Principal */
        .main-content { 
            flex: 1; 
            margin-left: 280px; 
            padding: 40px; 
        }

        .content-section { display: none; animation: slideUp 0.5s ease-out; }
        .content-section.active { display: block; }

        @keyframes slideUp { 
            from { opacity: 0; transform: translateY(30px); } 
            to { opacity: 1; transform: translateY(0); } 
        }

        /* Cards de Estatísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            padding: 30px;
            border-radius: 20px;
            text-align: center;
            border: 1px solid rgba(255,255,255,0.1);
            transition: 0.3s;
        }
        .card:hover { transform: translateY(-10px); background: rgba(255, 255, 255, 0.1); }
        .card i { font-size: 45px; margin-bottom: 15px; color: var(--cor-destaque); }
        .card h3 { font-size: 32px; margin-bottom: 5px; }

        /* Estilização das Tabelas */
        .table-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 20px;
            color: #333;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th {
            text-align: left;
            padding: 15px;
            background: #f4f7f8;
            color: var(--cor-primaria);
            font-weight: 600;
            border-bottom: 2px solid #eee;
        }

        table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        table tr:hover { background: #f9f9f9; }

        .btn-action {
            padding: 8px 12px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            margin-right: 5px;
        }

        .user-span {
            color: var(--cor-destaque);
            font-weight: 600;
            border-bottom: 3px solid var(--cor-destaque);
        }

        .badge {
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 11px;
            font-weight: 600;
            background: #d4edda;
            color: #155724;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>ESCOLA +</h2>
        <div onclick="showSection('resumo')" class="nav-link active" id="btn-resumo">
            <i class="fas fa-chart-line"></i> Dashboard
        </div>
        <div onclick="showSection('alunos')" class="nav-link" id="btn-alunos">
            <i class="fas fa-user-graduate"></i> Formandos
        </div>
        <div onclick="showSection('formadores')" class="nav-link" id="btn-formadores">
            <i class="fas fa-chalkboard-teacher"></i> Formadores
        </div>
        <div onclick="showSection('turmas')" class="nav-link" id="btn-turmas">
            <i class="fas fa-users"></i> Turmas
        </div>
        
        <a href="../../controller/AuthController.php?action=logout" class="nav-link" style="margin-top: auto; color: var(--cor-alerta);">
            <i class="fas fa-sign-out-alt"></i> Sair
        </a>
    </div>

    <div class="main-content">
        
        <div id="resumo" class="content-section active">
            <h1>Bem-vindo, <span class="user-span"><?= htmlspecialchars($email) ?></span></h1>
            <p style="opacity: 0.8; margin-top: 10px;">Visão geral do sistema escolar.</p>
            
            <div class="stats-grid">
                <div class="card">
                    <i class="fas fa-user-graduate"></i>
                    <h3>---</h3>
                    <p>Alunos Ativos</p>
                </div>
                <div class="card" style="border-bottom: 4px solid var(--cor-destaque);">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h3>---</h3>
                    <p>Formadores</p>
                </div>
                <div class="card" style="border-bottom: 4px solid var(--cor-sucesso);">
                    <i class="fas fa-users"></i>
                    <h3>---</h3>
                    <p>Turmas</p>
                </div>
            </div>
        </div>

        <div id="alunos" class="content-section">
            <div class="table-container">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 style="color: var(--cor-primaria);"><i class="fas fa-user-graduate"></i> Lista de Formandos</h2>

                    <a href="../../view/Formando/criar_formando.php"><button style="background: var(--cor-sucesso); color: white; border:none; padding: 10px 20px; border-radius: 25px; cursor: pointer;">+ Novo Formando</button></a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Genero</th>
                            <th>Telefone</th>
                            <th>Email</th>
                            <th>Idade</th>
                            <th>Turma</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>      
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


       <div id="formadores" class="content-section">
    <div class="table-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="color: var(--cor-primaria);"><i class="fas fa-chalkboard-teacher"></i> Lista De Formadores</h2>
            <a href="../../view/Formador/criar_formador.php">
                <button style="background: var(--cor-primaria); color: white; border:none; padding: 10px 20px; border-radius: 25px; cursor: pointer;">+ Novo Formador</button>
            </a> </div>
                   
        <table>
            <thead>
                <tr>
                    <th>ID do Formador</th>
                    <th>Nome</th>
                    <th>Genero</th>
                    <th>Email</th>
                    <th>Telefone</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($formadores)): ?>
                    <?php foreach($formadores as $p): ?>
                        <tr>
                            <td><?= (int)$p['id_formador'] ?></td>
                            <td><?= htmlspecialchars($p['nome'])?></td>
                            <td><?= htmlspecialchars($p['genero'])?></td>
                            <td><?= htmlspecialchars($p['email'])?></td>
                            <td><?= htmlspecialchars($p['telefone'])?></td>
                            <td class="acoes">
                                <a href="formadorController.php?action=edit&id=<?= $p['id_formador'] ?>" class="iditar">
                                    <i class="fas fan-pen"></i>editar
                                </a>
                                
                                <a href="formadorController.php?action=destroy&id=<?= $p['id_formador'] ?>"
                                    onclick="return confirm('Apagar cliente?')" class="apagar"><i class="fas fa-trash"></i>
                                    Apagar 
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Nenhum formador encontrado.</td>
                    </tr>
                <?php endif; ?> </tbody>
        </table>
    </div>
</div>


        <div id="turmas" class="content-section">
            <div class="table-container">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 style="color: var(--cor-primaria);"><i class="fas fa-users"></i> Gestão de Turmas</h2>
                    <button style="background: var(--cor-terciaria); color: white; border:none; padding: 10px 20px; border-radius: 25px; cursor: pointer;">+ Criar Turma</button>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nº Turma</th>
                            <th>Formador Responsável</th>
                            <th>Numero de Alunos</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function showSection(id) {
            document.querySelectorAll('.content-section').forEach(section => {
                section.classList.remove('active');
            });

            document.querySelectorAll('.nav-link').forEach(link => {
                link.classList.remove('active');
            });

            document.getElementById(id).classList.add('active');
            document.getElementById('btn-' + id).classList.add('active');
        }
    </script>
</body>
</html>