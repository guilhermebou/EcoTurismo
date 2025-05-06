<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitiza os dados
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
    $data = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
    $rota = filter_input(INPUT_POST, 'rota', FILTER_SANITIZE_STRING);
    $participantes = filter_input(INPUT_POST, 'participantes', FILTER_SANITIZE_NUMBER_INT);
    $observacoes = filter_input(INPUT_POST, 'observacoes', FILTER_SANITIZE_STRING);


    if (empty($nome) || empty($email) || empty($data) || empty($rota) || empty($participantes)) {
        $_SESSION['agendamento_msg'] = ['type' => 'error', 'text' => 'Por favor, preencha todos os campos obrigatórios.'];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['agendamento_msg'] = ['type' => 'error', 'text' => 'Por favor, insira um e-mail válido.'];
    } elseif ($participantes < 1 || $participantes > 20) {
        $_SESSION['agendamento_msg'] = ['type' => 'error', 'text' => 'Número de participantes inválido (1-20).'];
    } else {

        $_SESSION['agendamento_msg'] = ['type' => 'success', 'text' => 'Agendamento realizado com sucesso! Entraremos em contato para confirmação.'];


        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
}

include '../../includes/header.php';
?>

<div class="container agendamento-page">
    <h1 class="text-center mb-4">Agendamento de Roteiros</h1>


    <?php if (isset($_SESSION['agendamento_msg'])): ?>
        <div class="alert alert-<?= $_SESSION['agendamento_msg']['type'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['agendamento_msg']['text'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['agendamento_msg']); ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-5">
            <div class="roteiros-info">
                <h3><i class="fas fa-map-marked-alt"></i> Roteiros</h3>



            </div>
        </div>

        <div class="col-md-7">
            <div class="agendamento-form">
                <h3><i class="far fa-calendar-alt"></i> Faça seu agendamento</h3>
                <form id="formAgendamento" method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nome">Nome completo *</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">E-mail *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="telefone">Telefone *</label>
                            <input type="tel" class="form-control" id="telefone" name="telefone" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="participantes">Nº de participantes *</label>
                            <input type="number" class="form-control" id="participantes" name="participantes" min="1" max="20" value="1" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="data">Data desejada *</label>
                            <input type="date" class="form-control" id="data" name="data" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="horario">Horário preferencial *</label>
                            <select class="form-control" id="horario" name="horario" required>
                                <option value="" disabled selected>Selecione</option>
                                <option value="manha">Manhã (08:00 - 11:00)</option>
                                <option value="tarde">Tarde (13:00 - 16:00)</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="rota">Roteiro *</label>
                        <select class="form-control" id="rota" name="rota" required>
                            <option value="" disabled selected>Selecione um roteiro</option>
                            <option value="trilha-ecologica">Trilha Ecológica</option>
                            <option value="observacao-aves">Observação de Aves</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="observacoes">Observações</label>
                        <textarea class="form-control" id="observacoes" name="observacoes" rows="3" placeholder="Informe necessidades especiais, restrições, etc."></textarea>
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="termos" required>
                        <label class="form-check-label" for="termos">Li e aceito os <a href="#" data-toggle="modal" data-target="#termosModal">termos de agendamento</a> *</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i class="fas fa-calendar-check"></i> Confirmar Agendamento
                    </button>
                </form>
            </div>

            <div class="dicas-agendamento mt-4">
                <div class="alert alert-info">
                    <h4><i class="fas fa-info-circle"></i> Dicas para seu agendamento:</h4>
                    <ul>
                        <li>Agende com pelo menos 48h de antecedência</li>
                        <li>Verifique a previsão do tempo para a data escolhida</li>
                        <li>Use roupas e calçados adequados para trilhas</li>
                        <li>Leve protetor solar e repelente</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="termosModal" tabindex="-1" role="dialog" aria-labelledby="termosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termosModalLabel">Termos de Agendamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5>Política de Cancelamento:</h5>
                <p>Cancelamentos com até 48h de antecedência recebem reembolso integral. Cancelamentos entre 48h e 24h antes do passeio recebem 50% de reembolso. Cancelamentos com menos de 24h de antecedência não são reembolsáveis.</p>

                <h5 class="mt-4">Recomendações:</h5>
                <p>O EcoTurismo não se responsabiliza por acidentes causados por descumprimento das orientações dos guias. Recomendamos o uso de calçados fechados e antiderrapantes, roupas confortáveis e proteção contra sol e chuva.</p>

                <h5 class="mt-4">Restrições:</h5>
                <p>Alguns roteiros possuem restrições de idade e condicionamento físico. Gestantes e pessoas com problemas cardíacos ou de locomoção devem consultar a viabilidade antes de agendar.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/pt.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#data", {
        minDate: "today",
        maxDate: new Date().fp_incr(60),
        locale: "pt",
        disable: [
            function(date) {

                return (date.getDay() === 0);
            }
        ]
    });


    $('#telefone').mask('(00) 00000-0000');


    $('#formAgendamento').on('submit', function(e) {
        if (!document.getElementById('termos').checked) {
            e.preventDefault();
            alert('Você deve aceitar os termos de agendamento para continuar.');
            return false;
        }
        return true;
    });
});
</script>
