<script>

    $(document).ready(function () {

        $('#login').validate({ // initialize the plugin
            debug: true,
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                email: "Please enter email address"
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

            <div class="col-sm-6">

                <H1>Account</H1>
                <p> Update your account information.</p>
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

                <form action="/update-account" method="POST" id="login">

                    <div class="form-group">
                        <label class="control-label col-sm-4"># of Facebook followers: </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="num_followers" value="<?php echo $supporter->id_follower_count; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Reset Password: </label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="password"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Confirm Password: </label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" name="confirm_password"/>
                        </div>
                    </div>

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