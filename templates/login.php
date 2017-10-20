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

</script>

<section class="section" id="features">
    <div class="container">

        <div class="row">

            <div class="col-sm-3"></div>

            <div class="col-sm-6 intro-form">

                <H3>LOGIN </H3>

				<?php if (isset($success_info)) { ?>
				    <div class="alert alert-success"><?php echo $success_info; ?></div>
				<?php } ?>

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

                <?php
                    echo '<a href="' . htmlspecialchars($fb_login_url) . '" class="btn btn-social btn-block btn-facebook" style="width: 50%"><span class="fa fa-facebook"></span>Sign in with Facebook!</a>';
                ?>
                <br />
                <p>&nbsp;Or...</p>
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
                        <a href="/forgot-password" style="font-size: medium">Forgot Password</a>
                        | <a href="/get-started/supporter/register" style="font-size: medium">Register</a>
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
