<script>

    $(function () {
        $(".datepicker").datepicker();
    });

</script>

<section class="section" id="features">
    <div class="container">

        <div class="row">

            <div class="col-sm-3"></div>

            <div class="col-sm-6">

                <H1>ACCOUNT SETUP</H1>


                <H3>INVITE SUPPORTERS</H3>

                    <div>
                            <p> Does your organization have passionate members or friends of your organization? Why not ask them to help you promote your next initiative. Simply enter their email addresses below and we’ll send an email with instructions about how to sign up.</p>

                    </div>

                <?php if (isset($success_info)) { ?>
                    <div class="alert alert-success"><?php echo $success_info; ?></div>
                <?php } ?>

                <form action="/invite-supporters" enctype="multipart/form-data" method="POST" class="form-horizontal"
                      role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Email Address</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_1"/>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-sm-4">Email Address</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_2"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email Address</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_3"/>
                        </div>
                    </div>



                     <div class="form-group">
                        <label class="control-label col-sm-4">Email Address</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_4"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email Address</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_5"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email Address</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_6"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email Address</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_7"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email Address</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_8"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email Address</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_9"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email Address</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_10"/>
                        </div>
                    </div>


                 

                    <p style="text-align: center">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </p>

                </form>
            </div>
        </div>

        <div class="col-sm-3"></div>

    </div><!--end container -->
</section><!--end section -->