<script>

    $(document).ready(function () {

        $('#login').validate({ // initialize the plugin
            debug: true,
            rules: {
                username: {
                    required: true,
                    minlength: 5
                },
                password: {
                    required: true,
                    minlength: 4
                }
            },
            messages: {
                username: "Please enter your user name",
                password: "Please enter your password"
            },
            submitHandler: function (form) {
                form.submit();
            }

        });
    });

    // This is called with the results from from FB.getLoginStatus().
    function statusChangeCallback(response) {
        console.log('statusChangeCallback');
        console.log(response);
        // The response object is returned with a status field that lets the
        // app know the current login status of the person.
        // Full docs on the response object can be found in the documentation
        // for FB.getLoginStatus().
        if (response.status === 'connected') {
            // Logged into your app and Facebook.
            testAPI();
        } else if (response.status === 'not_authorized') {
            // The person is logged into Facebook, but not your app.
            document.getElementById('status').innerHTML = 'Please log ' +
                'into this app.';
        } else {
            // The person is not logged into Facebook, so we're not sure if
            // they are logged into this app or not.
            document.getElementById('status').innerHTML = 'Please log ' +
                'into Facebook.';
        }
    }

    // This function is called when someone finishes with the Login
    // Button.  See the onlogin handler attached to it in the sample
    // code below.
    function checkLoginState() {
        FB.getLoginStatus(function (response) {
            statusChangeCallback(response);
        });
    }

    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function (response) {
        statusChangeCallback(response);
    });

    }
    ;

    // Load the SDK asynchronously
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    // Here we run a very simple test of the Graph API after login is
    // successful.  See statusChangeCallback() for when this call is made.
    function testAPI() {
        console.log('Welcome!  Fetching your information.... ');
        FB.api('/me', function (response) {
            console.log('Successful login for: ' + response.name);
            document.getElementById('status').innerHTML =
                'Thanks for logging in, ' + response.name + '!';
        });
    }
</script>

<section class="section" id="features">
    <div class="container">

        <div class="row">

            <div class="col-sm-3"></div>

            <div class="col-sm-6 intro-form">

                <H3>LOGIN </H3>

                        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                    </fb:login-button>

                <div id="status">
                </div>

                <?php if (!empty($email_error)) { ?>
                    <div class="alert alert-danger"><?php echo $email_error; ?></div>
                <?php } ?>

                <?php if (!empty($username_error)) { ?>
                    <div class="alert alert-danger"><?php echo $username_error; ?></div>
                <?php } ?>

                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>

                <form action="/login" method="POST" id="login" class="form-horizontal">

                    <div class="form-group">
                        <label class="control-label col-sm-4">Account Type</label>

                        <div class="col-sm-8">
                            <select name="user_type" class="form-control">
                                <option value="supporter">Supporter</option>
                                <option value="producer">Producer</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-4">Username</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="username" placeholder="Enter Username"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Password</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password" placeholder="Enter Password"/>
                        </div>
                    </div>
                    <br/>
                    <p style="text-align:center">
                        <a href="/forgot-password" class="highlighted" style="font-size: medium">Forgot Password</a>
                        | <a href="/get-started/supporter/register" class="highlighted" style="font-size: medium">Register</a>
                    <p>

                    <p style="text-align:center">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </p>

                </form>
            </div>

        </div>

        <div class="col-sm-3"></div>


    </div> <!-- end container -->
</section>
<!-- END HOME -->
