<?php



session_start();


if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    header("Location: login.php");
    exit();
}


$usuario_logado = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento - Dashboard</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <style>
    
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            color: white;
            padding-top: 20px;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.75);
        }
        .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
            <div class="position-sticky pt-3">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
                    <span>Menu Principal</span>
                </h6>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">
                            <i class="fas fa-home me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cadastro_usuario.php"> <i class="fas fa-user-plus me-2"></i>
                            Cadastrar Usuário
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users me-2"></i>
                            Listar Usuários
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users me-2"></i>
                            Listar Funcionario
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-users me-2"></i>
                            Cadastrar Funcionario
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-chart-line me-2"></i>
                            Relatórios Semanais
                        </a>
                    </li>
                </ul>
                
                <hr class="my-3 text-white-50">
                
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Sair (Logout)
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Painel de Gerenciamento</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="me-2 text-muted">
                        Bem-vindo(a), <strong class="text-primary"><?php echo $usuario_logado; ?></strong>!
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success" role="alert">
                        Você está logado e protegido. Este é o conteúdo confidencial.
                    </div>
                </div>
                
                <div class="col-md-4 mb-3">
                    <div class="card text-white bg-info">
                        <div class="card-body">
                            <h5 class="card-title">Clientes Ativos</h5>
                            <p class="card-text fs-3">1,250</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-12 mt-4">
                    <h3>Últimos Registros</h3>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Status</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1001</td>
                                <td>Marcos</td>
                                <td><span class="badge bg-success">Ativo</span></td>
                                <td>2025-10-02</td>
                            </tr>
                            <tr>
                                <td>1002</td>
                                <td>Aleksander</td>
                                <td><span class="badge bg-warning">Pendente</span></td>
                                <td>2025-10-01</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>