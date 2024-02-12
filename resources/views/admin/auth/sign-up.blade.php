<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('vali-admin/docs/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
    </div>
    <div class="login-box">
        <form class="login-form" action="{{route('admin.sign-up.post')}}" method="post">
            @csrf
            <h3 class="login-head"><i class="bi bi-person me-2"></i>SIGN UP</h3>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input class="form-control" type="text" name="email" placeholder="Email" autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">PASSWORD</label>
                <input class="form-control" type="password" name="password" placeholder="Password">
            </div>
            <div class="mb-3">
                <div class="utility">
                </div>
            </div>
            <div class="mb-3 btn-container d-grid">
                <button class="btn btn-primary btn-block"><i class="bi bi-box-arrow-in-right me-2 fs-5"></i>SIGN UP</button>
            </div>
        </form>
    </div>
</section>
<!-- Essential javascripts for application to work-->
<script src="{{asset('vali-admin/docs/js/jquery-3.7.0.min.js') }}"></script>
<script src="{{asset('vali-admin/docs/js/bootstrap.min.js') }}"></script>
<script src="{{asset('vali-admin/docs/js/main.js') }}"></script>
<script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
    });
</script>
</body>
</html>
