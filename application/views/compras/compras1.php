<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ingresar Compras</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f9f9f9;
    }

    .container {
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 8px;
      padding: 15px;
      max-width: 1200px;
      margin: auto;
    }

    .tabs {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
    }

    .tabs a {
      text-decoration: none;
      color: #007bff;
      font-weight: bold;
    }

    .form-section,
    .table-section {
      display: flex;
      flex-direction: column;
      gap: 10px;
      flex: 1;
    }

    .form-table-wrapper {
      display: flex;
      flex-direction: column;
    }

    .input-group {
      display: flex;
      flex-direction: column;
    }

    input[type="text"],
    input[type="date"],
    select {
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .summary-boxes {
      display: flex;
      flex-direction: column;
      gap: 5px;
    }

    .summary-boxes div {
      background-color: #e9ecef;
      padding: 10px;
      border-radius: 4px;
    }

    .btn {
      margin-top: 10px;
      background-color: #3498db;
      color: white;
      padding: 10px;
      text-align: center;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      font-weight: bold;
    }

    .btn:hover {
      background-color: #2980b9;
    }

    .table-section table {
      width: 100%;
      border-collapse: collapse;
    }

    .table-section th,
    .table-section td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: center;
    }

    .table-section th {
      background: linear-gradient(to right, #1e90ff, #00bfff);
      color: white;
    }

    @media (min-width: 768px) {
      .form-table-wrapper {
        flex-direction: row;
        gap: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="tabs">
      <a href="#">Ingresar compras!!</a>
      <a href="#">Compras procesadas</a>
    </div>

    <div class="form-table-wrapper">
      <!-- Form Section -->
      <div class="form-section">
        <div class="input-group">
          <label for="fecha">Fecha</label>
          <input type="date" id="fecha">
        </div>

        <div class="input-group">
          <label for="tipo">Tipo comprobante</label>
          <select id="tipo">
            <option>Select tipo comprobante</option>
          </select>
        </div>

        <div class="input-group">
          <label for="numero">Número</label>
          <input type="text" id="numero" value="845755">
        </div>

        <div class="input-group">
          <label for="proveedor">Proveedor</label>
          <select id="proveedor">
            <option>Select proveedor</option>
          </select>
        </div>

        <div class="summary-boxes">
          <div>Gravadas $100.00</div>
          <div>No Sujetas $100.00</div>
          <div>Exentas $100.00</div>
          <div>Iva $10.13</div>
          <div>Total $110.13</div>
        </div>

        <button class="btn">
          💾 Guardar compra
          <span style="font-size: 20px;">➕</span>
        </button>
      </div>

      <!-- Table Section -->
      <div class="table-section">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Cantidad</th>
              <th>Descripción</th>
              <th>P. unit</th>
              <th>Iva</th>
              <th>Total</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <!-- Aquí irán los productos agregados -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>