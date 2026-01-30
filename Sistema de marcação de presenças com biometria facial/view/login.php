<?php 
require_once __DIR__ . '/../core/Session.php';
Session::start();

$erro = Session::get('erro');
if (isset($_SESSION['erro'])) unset($_SESSION['erro']);
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ESCOLA +</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
        :root {
            /* Paleta extraída do documento */
            --cor-primaria: #144750;   /* Azul Petróleo Escuro */
            --cor-secundaria: #0F353C; /* Tom Médio */
            --cor-terciaria: #0A2428;  /* Tom Profundo */
            --cor-destaque: #4dbce9;   /* Azul claro para contraste */
            --cor-alerta: #e95d35;     /* Laranja para erros */
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: "Poppins", sans-serif; }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* Fundo com o gradiente escuro profissional */
            background: linear-gradient(135deg, var(--cor-primaria) 0%, var(--cor-terciaria) 100%);
        }

        .login-box {
            display: flex;
            flex-direction: column;
            width: 420px;
            padding: 40px;
            /* Glassmorphism sutil para destaque no fundo escuro */
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            border-radius: 25px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            text-align: center;
            /* Borda superior com a cor de destaque */
            border-top: 10px solid var(--cor-destaque);
        }

        .login-header i {
            font-size: 50px;
            color: var(--cor-primaria);
            margin-bottom: 10px;
        }

        .login-header header {
            color: var(--cor-terciaria);
            font-size: 26px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .input-box {
            position: relative;
            margin-bottom: 20px;
        }

        .input-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .input-field {
            width: 100%;
            height: 50px;
            font-size: 16px;
            padding: 0 15px 0 45px;
            border-radius: 12px;
            border: 2px solid #ddd;
            background: #fff;
            outline: none;
            transition: 0.3s;
        }

        .input-field:focus {
            border-color: var(--cor-destaque); 
            box-shadow: 0 0 10px rgba(77, 188, 233, 0.2);
        }

        .forget {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
            font-size: 13px;
            font-weight: 500;
            color: #555;
        }

        #check {
            margin-right: 8px;
            accent-color: var(--cor-primaria);
        }

        .submit-btn {
            width: 100%;
            height: 55px;
            /* Botão com a cor primária do sistema */
            background: var(--cor-primaria);
            color: #fff;
            border: none;
            border-radius: 30px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
            box-shadow: 0 5px 15px rgba(20, 71, 80, 0.3);
        }

        .submit-btn:hover {
            background: var(--cor-secundaria);
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .erro-msg {
            color: var(--cor-alerta);
            margin-bottom: 15px;
            font-weight: 600;
            font-size: 14px;
        }

    </style>
</head>

<body>
    <div class="login-box">
        <div class="login-header">
            <i class="fas fa-user"></i>
            <header>Iniciar Sessão</header>
        </div>

        <?php if ($erro): ?>
            <div class="erro-msg">
                <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>
        
        <form action="../controller/AuthController.php?action=autenticar" method="POST">
            <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" name="email" class="input-field" placeholder="Email" required>
            </div>
            
            <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="senha" class="input-field" placeholder="Palavra-passe" required>
            </div>
            
            <div class="forget">
                <label style="display: flex; align-items: center; cursor: pointer;">
                    <input type="checkbox" name="lembrar" id="check"> Lembrar-me
                </label>
            </div>
            
            <div class="input-submit">
                <button type="submit" class="submit-btn">Entrar no Painel</button>
            </div>
        </form>
    </div>
</body>
</html>