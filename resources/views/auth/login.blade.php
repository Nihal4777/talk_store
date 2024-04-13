<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="css/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>


    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center pt-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <form action="{{ route('login') }}" method="post">
                                            @csrf
                                            <div class="section text-center">
                                                <h4 class="mb-4 pb-3" style="color: #c4c3ca">Log In</h4>
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-style"
                                                        placeholder="Your Email" id="logemail"
                                                        value="{{ old('email') }}" autocomplete="off" required>
                                                    <i class="input-icon bi bi-at"></i>


                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style"
                                                        placeholder="Your Password" id="logpass" autocomplete="off"
                                                        required>
                                                    <i class="input-icon bi bi-lock"></i>
                                                </div>
                                                <button type="submit" class="btn mt-4">submit</button>
                                                <p class="mb-0 mt-4 text-center"><a
                                                        href="{{ route('password.request') }}" class="link">Forgot
                                                        your password?</a></p>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <div class="card-back">
                                    <div class="center-wrap">
                                        <form action="{{ route('register') }}" method="post">
                                            @csrf
                                            <div class="section text-center">
                                                <h4 class="mb-4 pb-3" style="color: #c4c3ca">Sign Up</h4>
                                                <div class="form-group">
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        class="form-style" placeholder="Your Full Name" id="logname"
                                                        autocomplete="off">
                                                    <i class="input-icon bi bi-person"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="email" name="email" value="{{ old('email') }}"
                                                        class="form-style" placeholder="Your Email" id="logemail"
                                                        autocomplete="off">
                                                    <i class="input-icon bi bi-at"></i>
                                                    
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style"
                                                        placeholder="Your Password" id="logpass" autocomplete="off">
                                                    <i class="input-icon bi bi-lock"></i>
                                                    
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password_confirmation"
                                                        class="form-style" placeholder="Confirm Your Password"
                                                        id="logpass" autocomplete="off">
                                                    <i class="input-icon bi bi-lock"></i>
                                                </div>
                                                <button type="submit" class="btn mt-4">submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($errors->get('email'))
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast show fade bg-danger" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="toast-header bg-danger">
                        <strong class="me-auto text-white fw-bold">Email error</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <x-input-error :messages="$errors->get('email')"  class="text-white"/>
                    </div>
                </div>
            </div>
        @endif
        @if ($errors->get('password'))
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast" class="toast show fade bg-danger" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="toast-header bg-danger">
                        <strong class="me-auto text-white fw-bold">Password error</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        <x-input-error :messages="$errors->get('password')"  class="text-white"/>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
