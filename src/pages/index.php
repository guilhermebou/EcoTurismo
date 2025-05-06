<?php
session_start();
include '../../includes/header.php';
?>

<main class="main-content">
    <section class="hero-section">
        <div id="destaqueCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#destaqueCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#destaqueCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#destaqueCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/trilha-destaque.jpg" class="d-block w-100" alt="Trilha Ecológica">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Trilhas Incríveis</h2>
                        <p>Conheça nossas rotas ecológicas pela mata atlântica</p>
                        <a href="rotas.php" class="btn btn-success btn-lg">Explorar Rotas</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/observacao-aves-destaque.jpg" class="d-block w-100" alt="Observação de Aves">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Observação de Aves</h2>
                        <p>Tour matinal para observação de espécies raras</p>
                        <a href="agendamento.php" class="btn btn-success btn-lg">Agendar Tour</a>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="images/cachoeira-destaque.jpg" class="d-block w-100" alt="Conheça a Fauna local">
                    <div class="carousel-caption d-none d-md-block">
                        <h2>Animais Silvestres</h2>
                        <p>Aventure-se até as mais belas quedas d'água da região</p>
                        <a href="rotas.php" class="btn btn-success btn-lg">Conhecer Rota</a>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#destaqueCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#destaqueCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <!-- Sobre Nós -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="display-5 mb-4 text-success">Conheça o Parque da Matinha</h2>
                    <p class="lead">Conectando pessoas à natureza de forma sustentável</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores facere voluptates iste molestias exercitationem placeat praesentium architecto nesciunt aliquam, adipisci nemo quaerat optio eligendi quia numquam ab inventore accusantium ex.</p>
                    <a href="sobre.php" class="btn btn-outline-success">Saiba mais sobre nós</a>
                </div>
                <div class="col-lg-6">
                    <img src="images/equipe.jpg" alt="Equipe EcoTurismo" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Destaques -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5 text-success">Nossos Destaques</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-success">
                        <img src="images/trilha-card.jpg" class="card-img-top" alt="Trilha Ecológica">
                        <div class="card-body">
                            <h5 class="card-title">Trilha Ecológica</h5>
                            <p class="card-text">Percurso de 3km pela mata atlântica com guia especializado. Duração média de 2h30.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">Moderada</span>
                                <a href="agendamento.php" class="btn btn-sm btn-success">Agendar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-success">
                        <img src="images/aves-card.jpg" class="card-img-top" alt="Observação de Aves">
                        <div class="card-body">
                            <h5 class="card-title">Observação de Aves</h5>
                            <p class="card-text">Tour matinal para observação de espécies raras da região. Duração média de 4h.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">Leve</span>
                                <a href="agendamento.php" class="btn btn-sm btn-success">Agendar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-success">
                        <img src="images/cachoeira-card.jpg" class="card-img-top" alt="Cachoeira">
                        <div class="card-body">
                            <h5 class="card-title">Cachoeira do Vale</h5>
                            <p class="card-text">Aventura até a cachoeira mais bonita da região com banho incluso. Duração 6h.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-success">Difícil</span>
                                <a href="agendamento.php" class="btn btn-sm btn-success">Agendar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="rotas.php" class="btn btn-success">Ver todas as rotas</a>
            </div>
        </div>
    </section>

    <!-- Depoimentos -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 text-success">O que dizem sobre nós</h2>
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <img src="images/cliente1.jpg" class="rounded-circle mb-3" width="100" alt="Cliente">
                            <h5 class="card-title">Mariana Silva</h5>
                            <p class="card-text">"A trilha foi incrível! O guia era muito conhecedor da flora local e nos mostrou detalhes que jamais teríamos notado sozinhos."</p>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <img src="images/cliente2.jpg" class="rounded-circle mb-3" width="100" alt="Cliente">
                            <h5 class="card-title">Carlos Oliveira</h5>
                            <p class="card-text">"A observação de aves superou todas as expectativas. Vimos espécies raras e o equipamento fornecido era de alta qualidade."</p>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <img src="images/cliente3.jpg" class="rounded-circle mb-3" width="100" alt="Cliente">
                            <h5 class="card-title">Ana Beatriz</h5>
                            <p class="card-text">"A experiência na cachoeira foi mágica! A equipe é muito atenciosa e preocupada com a segurança de todos os participantes."</p>
                            <div class="text-warning">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Chamada para Ação -->
    <section class="py-5 bg-success text-white">
        <div class="container text-center">
            <h2 class="display-5 mb-4">Pronto para sua próxima aventura?</h2>
            <p class="lead mb-4">Junte-se a nós e descubra as belezas naturais que temos para oferecer</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="register.php" class="btn btn-light btn-lg">Cadastre-se</a>
                <a href="agendamento.php" class="btn btn-outline-light btn-lg">Agendar Tour</a>
            </div>
        </div>
    </section>
</main>

<?php include '../../includes/footer.php'; ?>