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

<div class="row">

    <div class="col-sm-3"></div>

    <div class="col-sm-6">

        <H1>Login </H1>

        <?php if (!empty($email_error)) { ?>
            <div class="alert alert-danger"><?php echo $email_error; ?></div>
        <?php } ?>

        <?php if (!empty($username_error)) { ?>
            <div class="alert alert-danger"><?php echo $username_error; ?></div>
        <?php } ?>

        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <form action="/login" method="POST" id="login">

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

            <button class="btn btn-primary" type="submit">Submit</button>

        </form>
    </div>

</div>

<div class="col-sm-3"></div>
