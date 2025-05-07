<?php include '../../includes/header.php'; ?>

<section class="about-hero">
    <div class="hero-overlay">
        <div class="container">
            <h1>Conheça o Parque da Matinha</h1>
            <p class="lead">Um santuário ecológico no coração de Monte Carmelo</p>
        </div>
    </div>
</section>

<!-- História do Parque -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title">Nossa História</h2>
                <p>O Parque Municipal da Matinha Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit amet consectetur quasi? Aspernatur asperiores recusandae, mollitia quidem voluptate, explicabo at, distinctio molestiae porro facere fuga aperiam voluptates voluptatum. Adipisci, veniam?</p>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laborum, odit facere? Mollitia, aperiam molestias. Dolor assumenda officia ratione reprehenderit vitae dicta, aperiam fugit dolorum cum veniam aliquid adipisci rem eos?</p>
                <div class="feature-box">
                    <i class="fas fa-calendar-alt"></i>
                    <div>
                        <h4>Mais de 20 anos</h4>
                        <p>Preservando a natureza de Monte Carmelo</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <img src="../images/matinha4.jpg" alt="História do Parque da Matinha" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>

<!-- Missão, Visão e Valores -->
<section class="section-padding bg-light">
    <div class="container">
        <h2 class="section-title text-center">Nossa Essência</h2>
        <div class="row mt-5">
            <div class="col-md-4 mb-4">
                <div class="essence-card">
                    <div class="essence-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Missão</h3>
                    <p>Preservar o ecossistema local e promover o turismo sustentável, oferecendo experiências educativas e de conexão com a natureza.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="essence-card">
                    <div class="essence-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Visão</h3>
                    <p>Tornar-nos referência em conservação ambiental e ecoturismo no Triângulo Mineiro até 2025.</p>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="essence-card">
                    <div class="essence-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Valores</h3>
                    <ul>
                        <li>Sustentabilidade</li>
                        <li>Educação ambiental</li>
                        <li>Respeito à biodiversidade</li>
                        <li>Compromisso com a comunidade</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Parceiros -->
<section class="section-padding bg-light">
    <div class="container">
        <h2 class="section-title text-center">Nossos Parceiros</h2>
        <div class="row align-items-center mt-5">
            <div class="col-md-4 col-6 mb-4">
                <img src="../images/logo-mc.png" alt="Prefeitura de Monte Carmelo" class="img-fluid partner-logo">
            </div>
            <div class="col-md-4 col-6 mb-4">
                <img src="../images/images.png" alt="Universidade Federal de Uberlândia" class="img-fluid partner-logo">
            </div>
            <div class="col-md-4 col-6 mb-4">
                <img src="../images/Cursos-Gratuitos-Ministerio-de-Turismo.jpg" alt="MTUR" class="img-fluid partner-logo">
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container text-center">
        <h2>Venha nos visitar!</h2>
        <p>Agende sua visita e viva uma experiência única na natureza</p>
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
    margin: 15px 0;
}

.about-hero h1 {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.about-hero .lead {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
}



/* Essência Cards */
.essence-card {
    background: var(--white);
    border-radius: 10px;
    padding: 2rem;
    height: 100%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: all 0.3s;
}

.essence-card:hover {
    transform: translateY(-10px);
}

.essence-icon {
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

.essence-card h3 {
    color: var(--primary);
    margin-bottom: 1rem;
}

.essence-card ul {
    text-align: left;
    padding-left: 1rem;
    list-style-type: none;
}

.essence-card ul li:before {
    content: '•';
    color: var(--primary);
    display: inline-block;
    width: 1em;
    margin-left: -1em;
}

/* Parceiros */
.partner-logo {
    max-height: 80px;
    width: auto;
    filter: grayscale(100%);
    opacity: 0.7;
    transition: all 0.3s;
}

.partner-logo:hover {
    filter: grayscale(0);
    opacity: 1;
}

</style>