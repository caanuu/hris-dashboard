<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in to HRIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f6f8fa;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            flex-direction: column;
        }

        .login-card {
            background: white;
            border: 1px solid #d0d7de;
            border-radius: 6px;
            padding: 20px;
            width: 100%;
            max-width: 340px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .logo-area {
            margin-bottom: 24px;
            text-align: center;
        }

        .form-label {
            font-size: 14px;
            font-weight: 500;
        }

        .form-control {
            background-color: #f6f8fa;
            border: 1px solid #d0d7de;
            box-shadow: inset 0 1px 0 rgba(208, 215, 222, 0.2);
        }

        .btn-green {
            background-color: #2da44e;
            color: white;
            font-weight: 600;
            width: 100%;
            border: 1px solid rgba(27, 31, 36, 0.15);
        }

        .btn-green:hover {
            background-color: #2c974b;
            color: white;
        }
    </style>
</head>

<body>
    <div class="logo-area">
        <i class="bi bi-github fs-1 text-dark" style="font-size: 48px;"></i>
        <h4 class="fw-light mt-3">Sign in to HRIS</h4>
    </div>

    <div class="login-card">
        @if ($errors->any())
            <div class="alert alert-danger p-2 small mb-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label d-flex justify-content-between">
                    Password
                </label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-green py-2">Sign in</button>
        </form>
    </div>

    <div class="mt-4 text-center small text-muted">
        PT Toba Pulp Lestari &copy; 2026
    </div>
</body>

</html>
