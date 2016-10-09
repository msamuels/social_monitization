
<section class="section" id="features">
    <div class="container">

        <div class="row">

            <div class="col-sm-3"></div>

            <div class="col-sm-6 intro-form">

                <H3>Claim Rewards </H3>
                <!--
                        <fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
                    </fb:login-button>
                -->
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
                <p>Clicking 'redeem' button, reward will be send to email address listed</p>
                <form action="/do-claim-reward" method="POST" id="login" class="form-horizontal">

                    <div class="form-group">
                        <label class="control-label col-sm-4">Claim reward</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="email" value="<?php echo $supporter->email_address; ?>"/>
                        </div>
                    </div>

                    <p style="text-align:center">
                        <button class="btn btn-primary" type="submit">Redeem</button>
                    </p>

                </form>
            </div>

        </div>

        <div class="col-sm-3"></div>


    </div> <!-- end container -->
</section>
<!-- END HOME -->
