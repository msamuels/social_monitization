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

                <H1>Reward Setup</H1>

                <?php if (isset($success_info)) { ?>
                    <div class="alert alert-success"><?php echo $success_info; ?></div>
                <?php } ?>

                <form action="/save-reward" enctype="multipart/form-data" method="POST" class="form-horizontal"
                      role="form">
                    <div class="form-group">
                        <label class="control-label col-sm-4">Reward Name</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="reward_name"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Type</label>
                        <div class="col-sm-8">
                            <select name="type">
                                <option value="Reward" selected>Reward</option>
                                <option value="Raffle">Raffle</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Quantity</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="quantity_remaining"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Expiration date</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control datepicker" name="expiration date"
                                   placeholder="yyyy-mm-dd"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Description</label>
                        <div class=" col-sm-8">
                            <textarea rows="4" cols="50" name="description" class="form-control"></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-4">Image</label>
                        <div class=" col-sm-8">
                            <input type="file" name="image" id="image"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">URL</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="url"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Point Value</label>
                        <div class=" col-sm-8">
                            <input type="text" class="form-control" name="point_value"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">How will you provide this to us</label>
                        <div class=" col-sm-8">
                            <textarea rows="4" cols="50" name="details" class="form-control">   </textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Campaign (optional)</label>
                        <div class="col-sm-8">
                            <select name="campaign">
                                <option selected>Select One:</option>
                                <?php foreach ($campaigns as $campaign) { ?>
                                    <option
                                        value="<?php echo $campaign->campaign_id; ?>"><?php echo $campaign->campaign_name; ?></option>
                                <?php } ?>
                            </select>
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