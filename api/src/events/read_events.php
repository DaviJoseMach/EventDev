<?php
require '../../credentials/connect_db.php';

// Função para formatar datas no padrão brasileiro
function formatDate($date) {
    $datetime = new DateTime($date);
    return $datetime->format('d/m/Y');
}

// Obter dados para filtros
$estados = [];
$meses = [];

$sql = "SELECT DISTINCT estado FROM tech_events";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $estados[] = $row['estado'];
}

$sql = "SELECT DISTINCT MONTH(data_inicio) AS mes FROM tech_events";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $meses[] = $row['mes'];
}

$sql = "SELECT id, nome_evento, localizacao, categoria, valor_entrada, data_inicio, data_fim, organizador, cidade, estado, url_site, url_imagem FROM tech_events WHERE 1=1";

// Aplicar filtros se definidos
if (isset($_GET['valor_entrada'])) {
    $valor_entrada = $_GET['valor_entrada'];
    if ($valor_entrada === 'gratuito') {
        $sql .= " AND valor_entrada = '0'";
    } else if ($valor_entrada === 'pago') {
        $sql .= " AND valor_entrada > '0'";
    }
}

if (isset($_GET['estado']) && $_GET['estado'] !== '') {
    $estado = $_GET['estado'];
    $sql .= " AND estado = '$estado'";
}

$meses = [
    '01' => 'Janeiro',
    '02' => 'Fevereiro',
    '03' => 'Março',
    '04' => 'Abril',
    '05' => 'Maio',
    '06' => 'Junho',
    '07' => 'Julho',
    '08' => 'Agosto',
    '09' => 'Setembro',
    '10' => 'Outubro',
    '11' => 'Novembro',
    '12' => 'Dezembro',
];


if (isset($_GET['mes']) && $_GET['mes'] !== '') {
    $mes = $_GET['mes'];
    $sql .= " AND MONTH(data_inicio) = '$mes'";
}


if (isset($_GET['status']) && $_GET['status'] !== '') {
    $status = $_GET['status'];
    if ($status === 'ativo') {
        $sql .= " AND data_fim >= CURDATE()";
    } else if ($status === 'encerrado') {
        $sql .= " AND data_fim < CURDATE()";
    }
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../resources/api_sources/read.css">
    <title>EventDev - Eventos</title>
</head>
<body>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand ms-5" href="#">Event <b class="evd"><</b><b class="evd">Dev</b><b class="evd">></b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="../../../eventdev/resources/views/welcome.blade.php"><i class="fa-solid fa-house"></i> Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../eventdev/resources/views/faq.php">FAQ</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../eventdev/resources/views/login.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-3">
<form method="GET" action="" class="row g-3 justify-content-center">
        <div class="col-12 col-md-6 col-lg-2">
            <select name="valor_entrada" class="form-select">
                <option value="">Todos os valores</option>
                <option value="gratuito">Gratuito</option>
                <option value="pago">Pago</option>
            </select>
        </div>
        <div class="col-12 col-md-6 col-lg-2">
            <select name="estado" class="form-select">
                <option value="">Todos os estados</option>
                <?php foreach ($estados as $estado): ?>
                    <option value="<?php echo htmlspecialchars($estado); ?>"><?php echo htmlspecialchars($estado); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-12 col-md-6 col-lg-2">
            <select name="mes" class="form-select">
                <option value="">Todos os meses</option>
                <?php foreach ($meses as $numero => $nome): ?>
                    <option value="<?php echo htmlspecialchars($numero); ?>" <?php if (isset($_GET['mes']) && $_GET['mes'] == $numero) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($nome); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-12 col-md-6 col-lg-2">
            <select name="status" class="form-select">
                <option value="">Todos os status</option>
                <option value="ativo">Ativo</option>
                <option value="encerrado">Encerrado</option>
            </select>
        </div>
        <div class="col-12 col-md-6 col-lg-2">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>

    <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): 
            $current_date = date('Y-m-d');
            $status = '';
            $badge_color = '';

            if ($row['data_fim'] < $current_date) {
                $status = 'Encerrado';
                $badge_color = 'badge-encerrado'; 
            } else {
                $status = 'Ativo';
                $badge_color = 'badge-ativo'; 
            }
        ?>
            <div class="cardss" data-bs-toggle="modal" data-bs-target="#eventModal" onclick="showEventDetails(<?php echo htmlspecialchars(json_encode($row)); ?>)">
                <div class="card-headers">
                    <div class="card-titles">
                        <i class="fas fa-calendar-alt"></i>
                        <a class="link-success link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover link">
                            <?php echo htmlspecialchars($row['nome_evento']); ?>
                        </a>
                        <span class="badge <?php echo htmlspecialchars($badge_color); ?>"><?php echo htmlspecialchars($status);?></span> <span class="alt-span">⚠ clique no card para expandir o evento</span>
                    </div>
                </div>
                <hr>
                <div class="card-info">
                    <div><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($row['localizacao']); ?></div>
                    <div class="badge-categ"><i class="fa-solid fa-layer-group"></i> <?php echo htmlspecialchars($row['categoria']); ?></div>
                    <div class="cash"><i class="fa-solid fa-sack-dollar"></i> <?php echo htmlspecialchars($row['valor_entrada']); ?></div>
                    <div><i class="fa-regular fa-clock"></i> <?php echo formatDate($row['data_inicio']); ?> - <?php echo formatDate($row['data_fim']); ?></div>
                    <div><i class="fa-solid fa-crown"></i> <?php echo htmlspecialchars($row['organizador']); ?></div>
                    <div><i class="fa-solid fa-tree-city"></i> <?php echo htmlspecialchars($row['cidade']); ?> / <?php echo htmlspecialchars($row['estado']); ?></div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?> <br> <br>
        <div class="alert alert-warning" role="alert">
            Não há eventos disponíveis.
        </div>
    <?php endif; ?>
</div>

<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="color: black" class="modal-title" id="eventModalLabel">Detalhes do Evento</h5> <span class="badge <?php echo htmlspecialchars($badge_color); ?>"><?php echo htmlspecialchars($status);?></span> 
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img id="eventImage" src="" alt="Imagem do Evento" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <div id="eventDetails" class="row">
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="eventLink" href="#" target="_blank" class="btn btn-primary">Ir para o evento</a>
                
            </div>
        </div>
    </div>
</div>

<script src="https://kit.fontawesome.com/f0c76a2bf3.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script>
function formatDate(dateString) {
    const [year, month, day] = dateString.split('-');
    return `${day}/${month}/${year}`;
}

function showEventDetails(event) {
    document.getElementById('eventModalLabel').innerText = event.nome_evento;
    document.getElementById('eventDetails').innerHTML = `
        <div class="col-6" style="color: black;"><strong><i class="fa-solid fa-location-dot"></i> Localização:</strong> ${event.localizacao}</div>
        <div class="col-6" style="color: #4B0082;"><strong><i class="fa-solid fa-layer-group"></i> Categoria:</strong> ${event.categoria}</div>
        <div class="col-6" style="color:#4682B4;"><strong><i class="fa-regular fa-clock"></i> Data de Início:</strong> ${formatDate(event.data_inicio)}</div>
        <div class="col-6" style="color:#A52A2A;"><strong><i class="fa-regular fa-clock"></i> Data de Fim:</strong> ${formatDate(event.data_fim)}</div>
        <div class="col-6" style="color: #2E8B57;"><strong><i class="fa-solid fa-sack-dollar"></i> Valor da Entrada:</strong> ${event.valor_entrada}</div>
        <div class="col-6" style="color:#FFA500;"><strong><i class="fa-solid fa-crown"></i> Organizador:</strong> ${event.organizador}</div>
        <div class="col-6" style="color: black;"><strong><i class="fa-solid fa-tree-city"></i> Cidade/Estado:</strong> ${event.cidade} / ${event.estado}</div>
    `;
    document.getElementById('eventImage').src = event.url_imagem;
    document.getElementById('eventImage').classList.add('rounded-border-led');
    document.getElementById('eventLink').href = event.url_site;
}
</script>

</body>
</html>

<?php
$conn->close();
?>
