<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login Carpintería</title>
    <style>
        
        body {
            margin: 0;
            font-family: "Segoe UI", Arial, sans-serif;
            background: linear-gradient(135deg, #d2b48c, #8b5a2b); /* tonos madera */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

       
        .login-box {
            background: #fffaf0; /* color crema */
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            width: 350px;
            text-align: center;
            border: 3px solid #8b5a2b;
        }

        
        h2 {
            color: #5c4033;
            margin-bottom: 20px;
            font-size: 24px;
        }

        /* ====== Campos ====== */
        label {
            display: block;
            color: #4b3832;
            text-align: left;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbb994;
            border-radius: 5px;
            background-color: #fff;
            box-sizing: border-box;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #8b5a2b;
            box-shadow: 0 0 5px #8b5a2b;
        }

       
        button {
            margin-top: 20px;
            background-color: #8b5a2b;
            color: #fff;
            border: none;
            padding: 10px 15px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background-color: #a0522d;
            transform: scale(1.03);
        }

        
        .error {
            color: red;
            background: #ffe6e6;
            border: 1px solid red;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        
        hr {
            margin-top: 25px;
            border: none;
            border-top: 1px solid #d2b48c;
        }

        
        .footer {
            margin-top: 15px;
            font-size: 13px;
            color: #4b3832;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Iniciar sesión</h2>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login.ingresar') }}" method="POST">
            @csrf
            <label>Usuario:</label>
            <input type="text" name="usuario" placeholder="admin o cliente" required>

            <label>Contraseña:</label>
            <input type="password" name="clave" placeholder="••••••" required>

            <button type="submit">Ingresar</button>
        </form>

        <hr>
        <div class="footer">© {{ date('Y') }} Carpintería — Hecho con madera y dedicación 🪵</div>
    </div>
</body>
</html>
