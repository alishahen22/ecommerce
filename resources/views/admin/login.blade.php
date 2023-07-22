<!DOCTYPE html>
<html>
<head>
    <title>صفحة تسجيل الدخول للمشرف</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center" >تسجيل الدخول للمشرف</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.checkLogin') }}">
                            @csrf
                            @if (Session::get('error'))
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>

                            @endif
                            <div class="form-group">
                                <label for="code">الكود:</label>
                                <input type="code" id="code" name="code" class="form-control" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="password">كلمة المرور:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">تسجيل الدخول</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
