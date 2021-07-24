<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/images/favicon/favicon.ico')}}">

    <!-- Theme CSS -->
    <!-- build:css @@webRoot/assets/css/theme.min.css -->
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css')}}">

    <title>Shap | Administration</title>
  </head>

<body>
  <!-- container -->
  <div class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0
        min-vh-100">
      <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0">
        <!-- Card -->
        <div class="card smooth-shadow-md">
          <!-- Card body -->
          <div class="card-body p-6">
            <div class="mb-4">
              <a href="../index.html"><img src="../assets/images/brand/logo/logo-primary.svg" class="mb-2" alt=""></a>
              <p class="mb-6">Please enter your user information.</p>
            </div>
            <!-- Form -->
            <form>
              <!-- Username -->
              <div class="mb-3">
                <label for="email" class="form-label">Username or email</label>
                <input type="email" id="email" class="form-control" name="email" placeholder="Email address here" required="">
              </div>
              <!-- Password -->
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" class="form-control" name="password" placeholder="**************" required="">
              </div>
              <!-- Checkbox -->
              <div class="d-lg-flex justify-content-between align-items-center
                  mb-4">
                <div class="form-check custom-checkbox">
                  <input type="checkbox" class="form-check-input" id="rememberme">
                  <label class="form-check-label" for="rememberme">Remember
                      me</label>
                </div>

              </div>
              <div>
                <!-- Button -->
                <div class="d-grid">
                  <button type="submit" class="btn btn-primary">Sign
                    in</button>
                </div>

                <div class="d-md-flex justify-content-between mt-4">
                  <div class="mb-2 mb-md-0">
                    <a href="sign-up.html" class="fs-5">Create An
                        Account </a>
                  </div>
                  <div>
                    <a href="forget-password.html" class="text-inherit
                        fs-5">Forgot your password?</a>
                  </div>

                </div>
              </div>


            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Scripts -->
  <!-- clipboard -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.12/clipboard.min.js"></script>

  <!-- Theme JS -->
  <!-- build:js @@webRoot/assets/js/theme.min.js -->
  <script src="{{ asset('admin/js/main.js')}}"></script>
  <script src="{{ asset('admin/js/feather.js')}}"></script>
  <script src="{{ asset('admin/js/copyButton.js')}}"></script>
  <script src="{{ asset('admin/js/sidebarMenu.js')}}"></script>
</body>

</html>
