
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
        }

        /* Top Bar / Header */
        .top-bar {
            width: 100%;
            padding: 20px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(15, 53, 60, 0.5);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo { font-size: 20px; font-weight: 600; color: var(--cor-destaque); letter-spacing: 1px; }

        .btn-sair {
            text-decoration: none;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            background: rgba(233, 93, 53, 0.2);
            border: 1px solid var(--cor-alerta);
            transition: 0.3s;
        }
        .btn-sair:hover { background: var(--cor-alerta); }

        /* Conteúdo Principal */
        .main-content { 
            width: 100%;
            max-width: 1200px;
            padding: 60px 20px; 
            text-align: center;
        }

        .user-span {
            color: var(--cor-destaque);
            font-weight: 600;
            position: relative;
        }
        .user-span::after {
            content: ''; position: absolute; left: 0; bottom: -5px;
            width: 100%; height: 3px; background: var(--cor-destaque);
            box-shadow: 0 0 8px var(--cor-destaque);
        }

        /* Cards de Estatísticas */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            padding: 40px 20px;
            border-radius: 25px;
            border: 1px solid rgba(255,255,255,0.1);
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .card:hover { 
            transform: translateY(-12px); 
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--cor-destaque);
        }

        .card i { font-size: 50px; margin-bottom: 20px; color: var(--cor-destaque); }
        .card h3 { font-size: 36px; margin-bottom: 10px; }
        .card p { opacity: 0.7; font-size: 18px; }

    </style>
</head>
<body>

    <header class="top-bar">
        <div class="logo">ESCOLA +</div>
        <a href="logout.php" class="btn-sair"><i class="fas fa-sign-out-alt"></i> Sair</a>
    </header>

    <div class="main-content">
        
        <div id="resumo" class="content-section active">
            <h1 style="font-size: 3rem; margin-bottom: 15px;">
                Bem-vindo ,</span>
            </h1>

            <p style="opacity: 0.8; font-size: 1.1rem;">Visão geral do sistema de gestão escolar.</p>
            
            <div class="stats-grid">
                <div class="card">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h3>Meus Dados</h3>
                    <p>Aqui será feito o  das turmas.</p>
                </div>
                
                <div class="card" style="border-top: 4px solid var(--cor-destaque);">
                    <i class="fa-solid fa-check"></i>
                    <h3>Marcar Presença</h3>
                    <p>Aqui será feito a marcação da presença.</p>
                </div>
                
            </div>
        </div>
    </div>

</body>
</html>