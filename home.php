<?php
include_once("./includes/includes.php");
Funcoes::verificaLogin();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php Componentes::head('Home'); ?>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><span class="fs-2 text-success fw-bold">DoIt <i class="fa-solid fa-list-check"></i></span></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="navbar-toggler-icon fa-solid fa-bars h-100 fs-2 text-success"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                        <li class="nav-item">
                            <a class="nav-link text-success fs-6 fw-bolder" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-success fs-6 fw-bolder" href="#">Link</a>
                        </li>
                    </ul>
                    <div class="d-flex" role="search">
                        <span class="text-success fw-bold" style="font-size: 110%;">Sair&nbsp;<i class="fa-solid fa-right-from-bracket"></i></span>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="mt-3 mt-lg-4 container">
        <div class="px-4 py-3 rounded bg-light">
            <div class="row mt-2 mb-4">
                <div class="col">
                    <span class="fw-bolder fs-3 text-success"><i class="fa-solid fa-list-check"></i>&nbsp;Tarefas</span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6 text-start">
                    <button class="btn btn-success rounded" id="inserir_btn">Inserir tarefa</button>
                </div>
                <div class="col-6 text-end align-self-center">
                    <i class="pointer fa-solid fa-file-excel text-success fs-4 me-3 me-lg-4"></i>
                    <i class="pointer fa-solid fa-file-pdf text-success fs-4"></i>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="text-success" scope="col">Nome</th>
                            <th class="text-success" scope="col">Descrição</th>
                            <th class="text-success" scope="col">Criação</th>
                            <th class="text-success" scope="col">Conclusão</th>
                            <th class="text-success" scope="col">Status</th>
                            <th class="text-success text-center" scope="col">Editar</th>
                            <th class="text-success text-center" scope="col">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td class="text-success text-center"><i class="pointer fa-solid fa-pen-to-square"></i></td>
                            <td class="text-success text-center"><i class="pointer fa-solid fa-trash"></i></td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td class="text-success text-center pointer"><i class="fa-solid fa-pen-to-square"></i></td>
                            <td class="text-success text-center pointer"><i class="fa-solid fa-trash"></i></td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td>Cell</td>
                            <td class="text-success text-center"><i class="pointer fa-solid fa-pen-to-square"></i></td>
                            <td class="text-success text-center"><i class="pointer fa-solid fa-trash"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>

</html>