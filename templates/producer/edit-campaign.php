<script>

    $(document).ready(function () {

        $('#create-campaign').validate({ // initialize the plugin
            rules: {
                campaign_name: {
                    required: true,
                    minlength: 5
                },
                end_date: {
                    required: true,
                    minlength: 5
                }
            }
        });

    });

    $(function () {
        $(".datepicker").datepicker();
    });

</script>

<section class="section" id="features">
    <div class="container">

        <div class="row">

            <div class="col-sm-3"></div>

            <div class="col-sm-6">

                <H1>Create Campaign</H1>
                <span class="required">* </span> = Required fields
                <form action="/edit-campaign" enctype="multipart/form-data" method="POST" class="form-horizontal"
                      role="form" id="create-campaign">
    <input type="hidden" class="form-control" name="campaign_id" placeholder="Campaign name" value="<?php echo $campaign->campaign_id ?>"/>
                    <div class="form-group">
                        <label class="control-label col-sm-4"><span class="required">* </span>Campaign Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="campaign_name" placeholder="Campaign name" value="<?php echo $campaign->campaign_name ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Budget(Optional)</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-addon">$</div>
                                <input type="text" class="form-control" name="budget" placeholder="Budget" value="<?php echo $campaign->budget ?>"/>
                            </div>
                        </div>
                    </div>
                    
                    <!--
                      <div class="form-group">
                        <label class="control-label col-sm-4">Estimated Impressions:</label>
                        <div class="col-sm-8">
                        <input type="text"  class="form-control" name="estimate" />
                        </div>
                      </div>
                    -->

                    <div class="form-group">
                        <label class="control-label col-sm-4"><span class="required">* </span>Start Date</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control datepicker" name="start_date"
                                   placeholder="mm/dd/yyyy" value="<?php echo $campaign->start_date ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4"><span class="required">* </span>End Date</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control datepicker" name="end_date"
                                   placeholder="mm/dd/yyyy" value="<?php echo $campaign->end_date ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Copy</label>
                        <div class="col-sm-8">
                            <textarea name="copy" class="form-control" rows="4" cols="50"
                                      placeholder="describe your campaign and what you hope to achieve "><?php echo $campaign->budget ?></textarea>
                        </div>
                    </div>


                    <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Image (.jpg)</label>
                        <div class="col-sm-8">
                            <input type="file" name="screen_shot" id="screen_shot"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Youtube embed link (optional): </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="youtube_embed"  id="youtube_embed"
                                      placeholder="Paste the embed youtube EMBED code" value="<?php echo $campaign->youtube_embed ?>" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">URL</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="url"
                                   PLACEHOLDER="Where can supporters go to learn more?" value="<?php echo $campaign->url ?>"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-4">Platform</label>
                        <div class="col-sm-8">
                            <select name="platform" id="platform" class="form-control">
                                <option value="facebook">Facebook</option>
                            </select>
                            <div style="font-size: small"><span class="required">* </span>shareitcamp will only report
                                on potential reach of posts to Facebook
                            </div>
                        </div>
                    </div>

                    <!--
                      <label>Targeting:</label>
                      <SELECT NAME="interests" MULTIPLE SIZE=5>
                        <OPTION VALUE="sports">sports
                        <OPTION VALUE="music">music
                        <OPTION VALUE="outdoors">onions
                        <OPTION VALUE="culture">tomatoes
                        <OPTION VALUE="religion">olives
                      </SELECT>
                      <br />
                    -->
                    <p style="text-align: center">
                        Non-profits: please consider donating one of the following
                    </p>

                    <ul id="donation-types" style="text-align: center;">

                        <li>- Reward</li>
                        <li>- Facebook Post</li>
                        <li>- Newsletter Ad</li>
                        <li>- Booth at Event</li>
                    </ul>

                    <p style="text-align: center">
                        <button class="btn btn-primary" type="submit">Save</button>
                    </p>

                </form>
            </div>
        </div>

        <div class="col-sm-3"></div>


    </div><!--end container -->
</section><!--end section -->
