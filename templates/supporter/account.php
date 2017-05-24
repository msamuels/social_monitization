<section class="section" id="features">
    <div class="container">

        <div class="row">

            <div class="col-sm-3"></div>

            <div class="col-sm-6">

                <H1>Account</H1>
                <p> Update your account information.</p>

                <?php if (isset($success_info) && $success_info != "") { ?>
                    <div class="alert alert-success"><?php echo $success_info; ?></div>
                <?php } ?>

                <?php if (!empty($email_error)) { ?>
                    <div class="alert alert-danger"><?php echo $email_error; ?></div>
                <?php } ?>

                <?php if (!empty($username_error)) { ?>
                    <div class="alert alert-danger"><?php echo $username_error; ?></div>
                <?php } ?>

                <?php if (!empty($error)) { ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php } ?>

                <form action="/update-account" method="POST" id="account" class="form-horizontal">

                    <div class="form-group">
                        <label class="control-label col-sm-4"># of Friends: </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" name="num_followers"
                                   value="<?php echo $supporter->id_follower_count; ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-8"><strong>Reset Password:</strong> Leave fields blank to keep password</div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">New Password: </label>
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

                    <div class="form-group">
                        <div class="col-sm-8"><strong>My Organization:</strong> <?php echo $my_nonprofit; ?></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" style="text-align:right">Organization affiliation (optional):</label>
                        <SELECT NAME="organization_affiliation">
                            <option VALUE="--">--</option>
                            <?php foreach($nonprofits as $nonprofit){ ?>
                                <option VALUE="<?php echo $nonprofit->organization_id; ?>"><?php echo $nonprofit->name; ?></option>
                            <?php } ?>
                        </SELECT>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-8"><strong>My School Assoc:</strong> <?php echo $my_school; ?></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4" style="text-align:right">School (optional):</label>
                        <SELECT NAME="school_affiliation">
                            <option VALUE="--">--</option>
                            <?php foreach($schools as $school){ ?>
                                <option VALUE="<?php echo $school->organization_id; ?>"><?php echo $school->name; ?></option>
                            <?php } ?>
                        </SELECT>
                    </div>

                    <p style="text-align: center">
                        <button class="btn btn-primary" type="submit">Update</button>
                    </p>

                </form>
            </div>

        </div>

        <div class="col-sm-3"></div>

    </div> <!-- end container -->
</section>
<!-- END HOME -->

