<?php
session_start();
require 'db.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}

echo "<h1>Hola admin</h1>";
?>

<?php
function sendCommand($cmd) {
    $url = "http://100.121.129.41:7125/printer/gcode/script";
    $data = json_encode(["script" => $cmd]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

function getGcodeFiles() {
    $url = "http://100.121.129.41:7125/server/files/list?root=gcodes";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);
    return $data['result'] ?? [];
}

$output = "";
$gcodeFiles = getGcodeFiles();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["command"])) {
    if ($_POST["command"] == "set_custom_temp_extruder" && isset($_POST["custom_temp_extruder"])) {
        $temp = intval($_POST["custom_temp_extruder"]);
        $cmd = "SET_HEATER_TEMPERATURE HEATER=extruder TARGET=$temp";
        $output = sendCommand($cmd);
    } elseif ($_POST["command"] == "set_custom_temp_bed" && isset($_POST["custom_temp_bed"])) {
        $temp = intval($_POST["custom_temp_bed"]);
        $cmd = "SET_HEATER_TEMPERATURE HEATER=heater_bed TARGET=$temp";
        $output = sendCommand($cmd);
    } elseif ($_POST["command"] == "print_gcode" && isset($_POST['file'])) {
        $filename = $_POST['file'];
        $url = "http://100.121.129.41:7125/printer/print/start";
        $data = json_encode(["filename" => "gcodes/" . $filename]);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        curl_close($ch);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Klipper Control Panel</title>
  <script src="/viewer/lib/bundle.js"></script>
  <style>
    body { font-family: sans-serif; padding: 20px; background: #f4f4f4; }
    button, input[type=number], select { padding: 10px 15px; margin: 5px; font-size: 16px; }
    .output, .gcodes, .viewer-container { background: #fff; padding: 10px; margin-top: 20px; border: 1px solid #ccc; }
    #viewerFrame {
      display: none;
      position: fixed;
      top: 50px;
      left: 50%;
      transform: translateX(-50%);
      width: 90%;
      height: 80vh;
      border: 2px solid #444;
      z-index: 1000;
      background: white;
    }
    #closeViewer {
      position: absolute;
      top: 10px;
      right: 20px;
      z-index: 1001;
      background: red;
      color: white;
      border: none;
      padding: 5px 10px;
      cursor: pointer;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <h1>Servijam Administradores</h1>


  <form method="post">
    <button name="command" value="STATUS">STATUS</button>
    <button name="command" value="PAUSE">PAUSE</button>
    <button name="command" value="RESUME">RESUME</button>
    <button name="command" value="CANCEL_PRINT">CANCEL</button>
    <button name="command" value="RESTART">RESTART</button>
    <button name="command" value="TURN_OFF_HEATERS">Apagar todo</button>

    <br><br>
    <label>Extrusor (°C):</label>
    <input type="number" name="custom_temp_extruder" placeholder="Ej: 210" min="0" max="300">
    <button name="command" value="set_custom_temp_extruder">Set Extrusor</button>

    <label>Cama (°C):</label>
    <input type="number" name="custom_temp_bed" placeholder="Ej: 60" min="0" max="120">
    <button name="command" value="set_custom_temp_bed">Set Cama</button>
  </form>

  <?php if ($output): ?>
    <div class="output">
      <h3>Respuesta:</h3>
      <pre><?= htmlspecialchars($output) ?></pre>
    </div>
  <?php endif; ?>

  <div class="gcodes">
    <h3>Archivos G-code disponibles:</h3>
    <form method="post">
      <select name="file">
        <option disabled selected>Seleccionar archivo...</option>
        <?php foreach ($gcodeFiles as $file): ?>
          <option value="<?= htmlspecialchars($file['path']) ?>">
            <?= htmlspecialchars($file['path']) ?> (<?= number_format($file['size'] / 1024, 1) ?> KB)
          </option>
        <?php endforeach; ?>
      </select>
      <button name="command" value="print_gcode">Imprimir seleccionado</button>
    </form>
  </div>

  <div class="gcodes">
    <h3>Subir archivo G-code para impresión:</h3>
    <form id="uploadForm">
      <input type="file" name="file" required>
      <button type="submit">Subir archivo</button>
    </form>
    <p id="uploadStatus"></p>
  </div>

  <div class="viewer-container">
    <h3>Visualizador de G-code:</h3>
    <button onclick="toggleViewer()">Abrir visor G-code</button>
  </div>

  <div id="viewerFrame">
    <button id="closeViewer" onclick="toggleViewer()">X</button>
    <iframe src="/viewer/" width="100%" height="100%"></iframe>
  </div>

  <script>
    function toggleViewer() {
      const frame = document.getElementById("viewerFrame");
      frame.style.display = frame.style.display === "none" ? "block" : "none";
    }

    document.getElementById('uploadForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const form = e.target;
      const fileInput = form.querySelector('input[type="file"]');
      const status = document.getElementById('uploadStatus');

      const data = new FormData();
      data.append('file', fileInput.files[0]);

      fetch('http://100.121.129.41:7125/server/files/upload', {
        method: 'POST',
        body: data
      })
      .then(response => response.ok ? "Archivo subido correctamente." : "Error al subir el archivo.")
      .then(msg => status.textContent = msg)
      .catch(err => status.textContent = "Error: " + err);
    });
  </script>
</body>
</html>