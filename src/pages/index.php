<?php include '../../includes/header.php'; ?>

<!-- Hero Section -->
<div class="hero" style="text-align: center;">
    <img src="../images/matinha.jpg" alt="Foto do Parque Matinha">
    <div class="conteudo-hero">
        <h3>Conheça a natureza do cerrado de Minas Gerais.</h3>
        <a href="sobre.php" class="btn btn-explore">Ver Mais</a>
    </div>
</div>

<!-- Sobre o Parque -->
<section id="sobre" class="section-padding bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title">Sobre o Parque</h2>
                <p>O Parque Municipal da Matinha é um santuário ecológico localizado em Monte Carmelo, Minas Gerais, com aproximadamente 30 hectares de área preservada. O parque abriga:</p>
                <ul class="feature-list">
                    <li><i class="fas fa-tree"></i> Diversas espécies nativas do cerrado mineiro</li>
                    <li><i class="fas fa-water"></i> Nascentes que abastecem a região</li>
                    <li><i class="fas fa-hiking"></i> Trilhas ecológicas bem conservadas</li>
                    <li><i class="fas fa-binoculars"></i> Ponto de observação de fauna e flora</li>
                </ul>
                <a href="sobre.php" class="btn btn-primary">Conheça mais</a>
            </div>
            <div class="col-lg-6">
                <img src="../images/matinha2.jpg" alt="Vista do Parque da Matinha" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- Trilhas -->
<section id="trilhas" class="section-padding">
    <div class="container">
        <h2 class="section-title text-center">Nossas Trilhas</h2>
        <p class="section-subtitle text-center">Explore os caminhos da Matinha</p>
        
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="card trail-card h-100">
                    <img src="images/trilha-nascentes.jpg" class="card-img-top" alt="Trilha das Nascentes">
                    <div class="card-body">
                        <h3>Trilha das Nascentes</h3>
                        <p>Percurso de 1,5km que leva às principais nascentes do parque, com paradas para observação.</p>
                        <div class="trail-info">
                            <span><i class="fas fa-clock"></i> 1h30min</span>
                            <span><i class="fas fa-mountain"></i> Dificuldade: Moderada</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="trilhas.php#nascentes" class="btn btn-trail">Detalhes</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card trail-card h-100">
                    <img src="images/trilha-mirante.jpg" class="card-img-top" alt="Trilha do Mirante">
                    <div class="card-body">
                        <h3>Trilha do Mirante</h3>
                        <p>Rota de 2km que culmina em um belo mirante com vista panorâmica da cidade e do parque.</p>
                        <div class="trail-info">
                            <span><i class="fas fa-clock"></i> 2h</span>
                            <span><i class="fas fa-mountain"></i> Dificuldade: Alta</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="trilhas.php#mirante" class="btn btn-trail">Detalhes</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card trail-card h-100">
                    <img src="images/trilha-ecologica.jpg" class="card-img-top" alt="Trilha Ecológica">
                    <div class="card-body">
                        <h3>Trilha Ecológica</h3>
                        <p>Percurso circular de 1km, ideal para iniciantes e observação de pássaros.</p>
                        <div class="trail-info">
                            <span><i class="fas fa-clock"></i> 45min</span>
                            <span><i class="fas fa-mountain"></i> Dificuldade: Fácil</span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="trilhas.php#ecologica" class="btn btn-trail">Detalhes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fauna e Flora -->
<section id="fauna-flora" class="section-padding bg-light">
    <div class="container">
        <h2 class="section-title text-center">Biodiversidade</h2>
        <p class="section-subtitle text-center">Conheça a riqueza natural da Matinha</p>
        
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="bio-card">
                    <div class="bio-header">
                        <i class="fas fa-feather-alt"></i>
                        <h3>Fauna</h3>
                    </div>
                    <div class="bio-body">
                        <p>O parque abriga diversas espécies de animais, incluindo:</p>
                        <ul>
                            <li>Sabiá-laranjeira</li>
                            <li>Teiú</li>
                            <li>Tucano-toco</li>
                            <li>Tamanduá-mirim</li>
                            <li>Diversas espécies de borboletas</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="bio-card">
                    <div class="bio-header">
                        <i class="fas fa-leaf"></i>
                        <h3>Flora</h3>
                    </div>
                    <div class="bio-body">
                        <p>Vegetação típica do cerrado mineiro com destaque para:</p>
                        <ul>
                            <li>Pequizeiro</li>
                            <li>Ipê-amarelo</li>
                            <li>Jatobá</li>
                            <li>Angico</li>
                            <li>Diversas espécies de orquídeas</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pesquisas Científicas -->
<section id="pesquisas" class="section-padding">
    <div class="container">
        <h2 class="section-title text-center">Pesquisas Científicas</h2>
        <p class="section-subtitle text-center">Conheça os estudos realizados no parque</p>
        
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="research-card">
                    <div class="research-icon">
                        <i class="fas fa-water"></i>
                    </div>
                    <h3>Monitoramento de Nascentes</h3>
                    <p>Estudo sobre a qualidade e vazão das nascentes do parque realizado pela UFU.</p>
                    <a href="acervo.php#nascentes" class="research-link">Ver pesquisa →</a>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="research-card">
                    <div class="research-icon">
                        <i class="fas fa-dove"></i>
                    </div>
                    <h3>Avifauna Local</h3>
                    <p>Levantamento das espécies de aves residentes e migratórias no parque.</p>
                    <a href="acervo.php#avifauna" class="research-link">Ver pesquisa →</a>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="research-card">
                    <div class="research-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>Recuperação Vegetal</h3>
                    <p>Projeto de recuperação de áreas degradadas com espécies nativas.</p>
                    <a href="acervo.php#vegetacao" class="research-link">Ver pesquisa →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Agendamento -->
<section id="agendamento" class="cta-section">
    <div class="container text-center">
        <h2>Pronto para explorar a Matinha?</h2>
        <p>Agende sua visita guiada e viva uma experiência única na natureza</p>
        <a href="agendamento.php" class="btn btn-cta">Agendar Visita</a>
    </div>
</section>

<?php include '../../includes/footer.php'; ?>

<style>
/* Estilos Globais */
:root {
    --primary: #28a745;
    --primary-dark: #218838;
    --secondary: #6c757d;
    --light: #f8f9fa;
    --dark: #343a40;
    --white: #ffffff;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #495057;
}

.section-padding {
    padding: 5rem 0;
}

.section-title {
    font-weight: 700;
    color: var(--primary);
    margin-bottom: 1rem;
    position: relative;
}

.section-title:after {
    content: '';
    display: block;
    width: 50px;
    height: 3px;
    background: var(--primary);
    margin: 15px auto 0;
}

.section-subtitle {
    color: var(--secondary);
    font-size: 1.1rem;
    max-width: 700px;
    margin: 0 auto 2rem;
}

/* Hero Section */
.hero-section {
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('images/hero-matinha.jpg');
    background-size: cover;
    background-position: center;
    height: 80vh;
    min-height: 500px;
    display: flex;
    align-items: center;
    color: var(--white);
    position: relative;
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
}

.hero-content h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.hero-content .lead {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}

.btn-explore {
    background-color: var(--primary);
    color: var(--white);
    padding: 0.75rem 2rem;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    transition: all 0.3s;
    border: none;
}

.btn-explore:hover {
    background-color: var(--primary-dark);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

/* Cards de Trilha */
.trail-card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s;
}

.trail-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.trail-card .card-body {
    padding: 1.5rem;
}

.trail-card h3 {
    color: var(--primary);
    margin-bottom: 1rem;
}

.trail-info {
    display: flex;
    justify-content: space-between;
    margin-top: 1.5rem;
    color: var(--secondary);
    font-size: 0.9rem;
}

.btn-trail {
    background-color: var(--primary);
    color: var(--white);
    border: none;
    width: 100%;
    padding: 0.5rem;
    border-radius: 5px;
    transition: all 0.3s;
}

.btn-trail:hover {
    background-color: var(--primary-dark);
}

/* Cards de Biodiversidade */
.bio-card {
    background: var(--white);
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.bio-header {
    background: var(--primary);
    color: var(--white);
    padding: 1.5rem;
    text-align: center;
    border-radius: 10px 10px 0 0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.bio-header i {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.bio-header h3 {
    margin: 0;
    font-size: 1.5rem;
}

.bio-body {
    padding: 1.5rem;
    flex-grow: 1;
}

.bio-body ul {
    padding-left: 1.5rem;
    margin: 1rem 0;
}

/* Cards de Pesquisa */
.research-card {
    background: var(--white);
    border-radius: 10px;
    padding: 2rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    height: 100%;
    text-align: center;
    transition: all 0.3s;
}

.research-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.research-icon {
    width: 80px;
    height: 80px;
    background: var(--primary);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
}

.research-card h3 {
    color: var(--primary);
    margin-bottom: 1rem;
}

.research-link {
    color: var(--primary);
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    margin-top: 1rem;
    transition: all 0.3s;
}

.research-link:hover {
    color: var(--primary-dark);
    transform: translateX(5px);
}

/* CTA Section */
.cta-section {
    background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('images/cta-bg.jpg');
    background-size: cover;
    background-position: center;
    padding: 5rem 0;
    color: var(--white);
    text-align: center;
}

.cta-section h2 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.cta-section p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

.btn-cta {
    background-color: var(--primary);
    color: var(--white);
    padding: 0.75rem 2.5rem;
    font-size: 1.1rem;
    font-weight: 600;
    border-radius: 50px;
    border: none;
    transition: all 0.3s;
}

.btn-cta:hover {
    background-color: var(--primary-dark);
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

/* Responsividade */
@media (max-width: 992px) {
    .hero-content h1 {
        font-size: 2.5rem;
    }
    
    .section-padding {
        padding: 3rem 0;
    }
}

@media (max-width: 768px) {
    .hero-section {
        height: 70vh;
    }
    
    .hero-content h1 {
        font-size: 2rem;
    }
    
    .hero-content .lead {
        font-size: 1.2rem;
    }
    
    .cta-section h2 {
        font-size: 2rem;
    }
}

@media (max-width: 576px) {
    .hero-section {
        height: 60vh;
    }
    
    .hero-content h1 {
        font-size: 1.8rem;
    }
    
    .section-title {
        font-size: 1.5rem;
    }
}
</style>