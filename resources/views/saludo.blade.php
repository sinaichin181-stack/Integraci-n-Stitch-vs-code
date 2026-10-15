<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saludo Laravel</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background: #1e293b;
            padding: 2.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            text-align: center;
            border: 1px solid #334155;
        }
        h1 { color: #f43f5e; margin-bottom: 0.5rem; }
        p { color: #94a3b8; font-size: 1.2rem; }
    </style>
</head>
<body>
    <div class="card">
        <h1>🤖 Agente Laravel</h1>
        <p>{{ $mensaje }}</p>
    </div>
</body>
</html>
