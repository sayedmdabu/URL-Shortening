<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Free URL Shortener</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex flex-column align-items-center">

      <h1>Free URL Shortener</h1>
      

      <div class="subscribe">
        <p>
            Best free custom URL shortener. Generate shortened links. Create massive passive income with your unused domain names. 
        </p>
        <form action="{{ route('shorten') }}" method="post" role="form">
            @csrf
            <div class="subscribe-form">
                {{-- <input type="email" name="email"> --}}
                <input id="original_url" type="text"
                    class="form-control @error('original_url') is-invalid @enderror"
                    name="original_url"
                    value="{{ old('original_url') }}"
                    required autofocus>
                <input type="submit" value="Shorten link">
            </div>


            @error('original_url')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="mt-2">
                <div class="loading">Shorten link</div>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        <a href="{{ session('success') }}" target="_blank" style="color: #2281c2;">{{ session('success') }}</a>
                    </div>
                @endif
            </div>
        </form>
      </div>
    </div>
  </header><!-- End #header -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>URL Shortener</span></strong>. All Rights Reserved
      </div>
    </div>
  </footer><!-- End #footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>