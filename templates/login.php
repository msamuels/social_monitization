        <div class="row">

    <div class="col-sm-3"></div>

    <div class="col-sm-6">

        <H1>Login </H1>

        <?php if (!empty($email_error)) { ?>
            <div class="alert alert-danger"><?php echo $email_error; ?></div>
        <?php } ?>

        <?php if (!empty($password_error)) { ?>
            <div class="alert alert-danger"><?php echo $password_error; ?></div>
        <?php } ?>

        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

            <form action="/login" method="POST">

                <div class="form-group">
                <label class="control-label col-sm-4">Account Type:</label>

                <div class="col-sm-8">
                    <select name="user_type"  class="form-control"  >
                        <option value="supporter">Supporter</option>
                        <option value="producer">Producer</option>
                    </select>
                </div>
                </div>


                <div class="form-group">
                <label class="control-label col-sm-4">Email:</label>
                <div class="col-sm-8">
                    <input type="text"  class="form-control" name="email"/>
                </div>
                </div>

                <div class="form-group">
                <label class="control-label col-sm-4">Password:</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="password"/>
                </div>
                </div>

                <button class="btn btn-primary" type="submit">Submit</button>

            </form>
        </div>

    </div>

    <div class="col-sm-3"></div>

</div>
