<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Producto - Carpintería</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #d2b48c, #8b5a2b);
            margin: 0;
            padding: 0;
        }

        main {
            width: 90%;
            max-width: 700px;
            margin: 60px auto;
            background: #fffaf0;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        }

        h2 {
            color: #5c4033;
            text-align: center;
            margin-bottom: 25px;
        }

        .detalle {
            background-color: #f9f4ee;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #a0522d;
        }

        .detalle p {
            margin: 8px 0;
            font-size: 16px;
            color: #5c4033;
        }

        .detalle span {
            font-weight: bold;
            color: #8b4513;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 25px;
            text-decoration: none;
            color: #5c4033;
            font-weight: bold;
            transition: 0.3s;
        }

        a:hover {
            color: #8b4513;
        }
    </style>
</head>
<body>
    <main>
        <h2>Detalle del Producto </h2>

        <div class="detalle">
            <p><span>ID:</span> {{ $producto->id_producto }}</p>
            <p><span>Nombre:</span> {{ $producto->nombre }}</p>
            <p><span>Tipo:</span> {{ $producto->nombre_tipo ?? 'Sin tipo' }}</p>
            <p><span>Material:</span> {{ $producto->material }}</p>
            <p><span>Precio:</span> ${{ number_format($producto->precio, 0, ',', '.') }}</p>
            <p><span>Stock:</span> {{ $producto->stock }}</p>
            <p><span>Descripción:</span><br>{{ $producto->descripcion ?? 'Sin descripción' }}</p>
        </div>

        <a href="{{ route('productos.index') }}"> Volver al panel</a>
    </main>
</body>
</html>
