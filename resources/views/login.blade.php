<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <section class="bg-image vh-100" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp'); background-size: auto;">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body px-5 py-4">
                                <h2 class="text-center mb-3">Log In To Your Account</h2>

                                <form id="loginForm" action="{{ route('authenticate') }}" method="POST">
                                    @csrf

                                    <div class="form-outline mb-2">
                                        <label class="form-label" for="email">Your Email</label>
                                        <input type="email" id="email" name="email" class="form-control form-control-lg" value="{{ old('email') }}" required />
                                        <span class="text-danger" id="emailError"></span>
                                    </div>

                                    <div class="form-outline mb-2">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-white">Login</button>
                                    </div>

                                    <p class="text-center text-muted mt-2 mb-0">Don't Have an account? <a href="register" class="fw-bold text-body"><u>Sign up here</u></a></p>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(event) {
                const email = $('#email').val().trim();
                const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

                // Clear any previous error message
                $('#emailError').text('');

                // Validate Email Format
                if (!email.match(emailPattern)) {
                    event.preventDefault(); // Prevent form submission
                    $('#emailError').text("Please enter a valid email address.");
                }
            });
        });
    </script>
</body>

</html>