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

<div class="row">

    <div class="col-sm-3"></div>

    <div class="col-sm-6">

        <H1>Forgot Password </H1>

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

        <form action="/reset-password" method="POST" id="login">

            <div class="form-group">
                <label class="control-label col-sm-4">Email: </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="email" placeholder="Enter email used when creating account"/>
                </div>
            </div>

            <button class="btn btn-primary" type="submit">Submit</button>

        </form>
    </div>

</div>

<div class="col-sm-3"></div>
