<script>

    $(function () {
        $(".datepicker").datepicker();
    });

</script>

<section class="section" id="features">
    <div class="container">

        <div class="row">

            <div class="col-sm-6">

                <H1>Account Setup</H1>


                <H3>INVITE SUPPORTERS</H3>

                    <div>
                            <p> Does your organization have passionate members or friends of your organization? Why not ask them to help you promote your next initiative. Simply enter their email addresses below and we’ll send an email with instructions about how to sign up.</p>

                    </div>

                <form action="/invite-supporters" enctype="multipart/form-data" method="POST" class="form-horizontal"
                      role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Email</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_1" placeholder="enter email address"/>
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="control-label col-sm-4">Email</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_2" placeholder="enter email address"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_3" placeholder="enter email address"/>
                        </div>
                    </div>



                     <div class="form-group">
                        <label class="control-label col-sm-4">Email</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_4" placeholder="enter email address"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_5" placeholder="enter email address"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_6" placeholder="enter email address"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_7" placeholder="enter email address"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_8" placeholder="enter email address"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_9" placeholder="enter email address"/>
                        </div>
                    </div>


                     <div class="form-group">
                        <label class="control-label col-sm-4">Email</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="email_10" placeholder="enter email address"/>
                        </div>
                    </div>


                 

                    <p style="text-align: center">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </p>

                </form>
            </div>

            <div class="col-sm-6">

                <p>
                    <h1>Select organizations you support.</h1>	

                    <?php if (isset($success_info)) { ?>
                        <div class="alert alert-success"><?php echo $success_info; ?></div>
                    <?php } ?>

                </p>

                <p>
                    <ul>
                    <?php foreach($all_producers as $producer) { ?>
                        <li style="margin-bottom: 15px; border-bottom: 1px solid  #0f0f0f;">
                            <form action="/producer/save-membership" method="POST">
                                <p>
                                <input type="hidden" name="member_producer_id" value="<?php echo $producer->id_producer; ?>"> <?php echo $producer->org_name; ?></p>
                        <p>
                        Member: <?php echo $producer->isMember($parent->id_producer, $producer->id_producer); ?>
                        </p>
                        <p>
                                <button type="submit" class="btn btn-success">Support</button>
                        </p>
                            </form>
                        </li>
                    <?php } ?>
                    <ul>
                </p>

            </div>

        </div>

    </div><!--end container -->
</section><!--end section -->
