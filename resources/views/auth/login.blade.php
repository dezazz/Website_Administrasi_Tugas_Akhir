<!doctype html>
<html lang="en">

<head>
    <title>Administrasi Tugas Akhir</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('auth/css/style.css') }}">
</head>

<body>
    <section class="ftco-section">
        <div class="container">

            <!--TITLE  -->
            <div class="row justify-content-start">
                <div class="col-md-6 mb-5">
                    {{-- <h1 class="heading-section" style="font-family: Barlow, sans-serif; font-weight:bolder">Thesis
                        Administration
                        System
                    </h1> --}}
                    <br><br>
                    <h1 class="heading-section" style="font-family: Barlow, sans-serif; font-weight:bolder">
                        Sistem Administrasi Tugas Akhir</h1>
                    <p style="color: black">Selamat Datang <br>
                        Halaman login ini diperuntukkan bagi : <br>
                        1. Mahasiswa Teknologi Informasi <br>
                        2. Dosen (Kepala Program Studi, Sekretaris Program Studi, Kepala Laboratorium, Dosen Pembimbing
                        , Dosen Penguji) <br>
                    </p>
                </div>
                <div class="col-md-8 col-lg-6">
                    <div class="wrap">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="col-md-12 text-center mb-5">
                                <h2 class="heading-section">LOGIN</h2>
                            </div>

                            <!-- LOGIN FORM -->
                            <form method="POST" action="{{ route('login') }}" class="signin-form">
                                @csrf
                                {{-- <div class="form-group mt-3 mb-2">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    <label class="form-control-placeholder" for="email">NIP/NIDN/NIM</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
                                <div class="form-group mt-3 mb-3">
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username" autofocus>
                                    <label class="form-control-placeholder" for="username">NIP/NIDN/NIM</label>
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mt-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">
                                    <label class="form-control-placeholder mt-2" for="password">Password</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit"
                                        class="form-control btn btn-success rounded submit px-3">Masuk</button>
                                </div>
                            </form>
                            <!-- END OF FORM LOGIN -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- END TITLE SECTION -->

            <!-- LOGIN  SECTION-->
            <div class="row justify-content-center">

            </div>
            <!-- END LOGIN SECTION -->
        </div>
    </section>

    <!-- ANY NECESSARY SCRIPT -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
