<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <section class="bg-image vh-100" style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp'); background-size: auto;">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body px-5 py-3">
                                <h2 class="text-center mb-3">Create An Account</h2>

                                <form id="signupForm" action="{{ route('registerUser') }}" method="POST" autocomplete="off">
                                    @csrf
                                    <div class="form-outline mb-2">
                                        <label class="form-label" for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" />
                                        <span class="text-danger" id="nameError"></span>
                                    </div>

                                    <div class="form-outline mb-2">
                                        <label class="form-label" for="email">Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com" />
                                        <span class="text-danger" id="emailError">
                                            @error('email')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="form-outline mb-2">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Must be at least 8 characters long" />
                                        <span class="text-danger" id="passwordError"></span>
                                    </div>

                                    <div class="form-outline mb-2">
                                        <label class="form-label" for="confirm_password">Confirm your password</label>
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" />
                                        <span class="text-danger" id="confirmPasswordError"></span>
                                    </div>

                                    <div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-white">Register</button>
                                    </div>

                                    <p class="text-center text-muted mt-2 mb-0">Already have an account? <a href="login" class="fw-bold text-body"><u>Login here</u></a></p>
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
            $('#signupForm').submit(function(event) {
                event.preventDefault(); // Prevent form submission

                // Clear previous error messages
                $('#nameError').text('');
                $('#emailError').text('');
                $('#passwordError').text('');
                $('#confirmPasswordError').text('');

                // Retrieve form field values
                const name = $('#name').val().trim();
                const email = $('#email').val().trim();
                const password = $('#password').val();
                const confirmPassword = $('#confirm_password').val();

                let isValid = true;

                // Validate Name
                if (name === "") {
                    $('#nameError').text("Please enter your name.");
                    isValid = false;
                }

                // Validate Email
                const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
                if (!email.match(emailPattern)) {
                    $('#emailError').text("Please enter a valid email address.");
                    isValid = false;
                }

                // Validate Password (at least 8 characters)
                if (password.length < 8) {
                    $('#passwordError').text("Password must be at least 8 characters.");
                    isValid = false;
                }

                // Confirm Password Match
                if (password !== confirmPassword) {
                    $('#confirmPasswordError').text("Passwords do not match.");
                    isValid = false;
                }

                // If all validations pass, submit the form
                if (isValid) {
                    this.submit();
                }
            });
        });
    </script>
</body>

</html>