<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Producto - Carpintería</title>
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #d2b48c, #8b5a2b);
            margin: 0;
            padding: 0;
        }

        main {
            width: 90%;
            max-width: 650px;
            margin: 50px auto;
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

        label {
            font-weight: bold;
            color: #5c4033;
            display: block;
            margin-bottom: 5px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #a0522d;
            border-radius: 8px;
            background-color: #fff8dc;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
        }

        button {
            width: 100%;
            background-color: #2e8b57;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #3cb371;
            transform: scale(1.03);
        }

        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #5c4033;
            font-weight: bold;
            transition: 0.3s;
        }

        a:hover {
            color: #8b4513;
        }

        .error {
            color: #b22222;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .back {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <main>
        <h2>Agregar Nuevo Producto </h2>

        {{-- Mostrar errores de validación --}}
        @if ($errors->any())
            <div class="error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('productos.store') }}" method="POST">
            @csrf

            <label>Nombre del producto:</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required>

            <label>Material:</label>
            <input type="text" name="material" value="{{ old('material') }}" required>

            <label>Precio (COP):</label>
            <input type="number" name="precio" min="0" value="{{ old('precio') }}" required>

            <label>Stock disponible:</label>
            <input type="number" name="stock" min="0" value="{{ old('stock') }}" required>

            <label>Tipo de producto:</label>
            <select name="id_tipo" required>
                <option value="">-- Seleccionar tipo --</option>
                @foreach($tipos as $tipo)
                    <option value="{{ $tipo->id_tipo }}" {{ old('id_tipo') == $tipo->id_tipo ? 'selected' : '' }}>
                        {{ $tipo->nombre_tipo }}
                    </option>
                @endforeach
            </select>

            <label>Descripción:</label>
            <textarea name="descripcion" rows="3">{{ old('descripcion') }}</textarea>

            <button type="submit"> Guardar Producto</button>
        </form>

        <div class="back">
            <a href="{{ route('productos.index') }}"> Volver al panel</a>
        </div>
    </main>
</body>
</html>

