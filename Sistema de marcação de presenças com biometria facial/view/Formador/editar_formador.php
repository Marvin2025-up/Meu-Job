<?php
require_once __DIR__ . '/../../core/Session.php';
Session::start();
if (!Session::isAdmin()) { header('Location: ../login.php'); exit; }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Formador</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --cor-primaria: #144750;   
            --cor-secundaria: #0F353C; 
            --cor-terciaria: #0A2428;  
            --cor-destaque: #4dbce9;   
            --cor-sucesso: #8dc63f;    
            --cor-alerta: #e95d35;     
            --cor-texto: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Poppins", sans-serif; }

        body { 
            min-height: 100vh; 
            background: linear-gradient(135deg, var(--cor-primaria) 0%, var(--cor-terciaria) 100%); 
            color: var(--cor-texto);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            color: #333;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 800px;
            margin-top: 30px;
            position: relative;
        }

        /* Estilo do botão Sair no topo */
        .exit-top {
            position: absolute;
            top: 20px;
            right: 25px;
            color: var(--cor-alerta);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: 0.3s;
        }
        .exit-top:hover { opacity: 0.7; }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--cor-primaria);
        }

        .form-group input, .form-group select {
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 10px;
            outline: none;
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: var(--cor-destaque);
            box-shadow: 0 0 5px rgba(77, 188, 233, 0.4);
        }

        /* Container de botões no rodapé */
        .form-actions {
            grid-column: span 2;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-save {
            background: var(--cor-sucesso);
            color: white;
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-cancel {
            background: #ccc;
            color: #333;
            padding: 15px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-save:hover { background: #7ab337; transform: translateY(-2px); }
        .btn-cancel:hover { background: #bbb; transform: translateY(-2px); }

        @media (max-width: 600px) {
            .form-grid, .form-actions { grid-template-columns: 1fr; }
            .form-actions { grid-column: span 1; }
        }
    </style>
</head>
<body>

<div id="cadastro_aluno" class="content-section">
    <div class="form-container">
        
        <a href="" class="exit-top">
            <i class="fas fa-sign-out-alt"></i> Sair
        </a>

        <h2 style="margin-bottom: 25px; color: var(--cor-primaria);">
            <i class="fas fa-user-plus"></i> Cadastro de Formador
        </h2>

        <form action="../../controller/formadorController.php?action=update" method="POST">

            <div class="form-grid">
                <div class="form-group">
                    <label>Nome Completo</label>
                    <input type="text" name="nome" value="<?= $row['nome']?>" required>
                </div>

                <div class="form-group">
                    <label>Género</label>
                    <select name="genero" required>
                    <option <?= $row['genero'] == "Masculino" ? "selected" : "" ?>>Masculino</option>
                    <option <?= $row['genero'] == "Feminino" ? "selected" : "" ?>>Feminino</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Data De Nascimento</label>
                    <input type="date" name="data_nascimento" value="<?= $row['data_nascimento']?>"required>
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= $row['email'] ?>" required>
                </div>

                <div class="form-group">
                    <label>Telefone</label>
                    <input type="text" name="telefone" value="<?=$row['telefone'] ?>" require>
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label>Senha (deixe vazio para manter a actual)</label>
                    <input type="password" name="senha" >
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn-save">Finalizar Cadastro</button>
                    <a href="dashboard.php" class="btn-cancel">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
</html>