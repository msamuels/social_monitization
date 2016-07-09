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

    $(function() {
        $( ".datepicker" ).datepicker();
    });

</script>

<div class="row">

    <div class="col-sm-3"></div>

    <div class="col-sm-6">

        <H1>Create Campaign</H1>
        <span class="required">* </span> = Required fields
        <form action="/save-campaign" enctype="multipart/form-data" method="POST" class="form-horizontal" role="form" id="create-campaign">
            <div class="form-group">
                <label class="control-label col-sm-4"><span class="required">* </span>Campaign Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="campaign_name"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4">Budget(Optional)</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <div class="input-group-addon">$</div>
                        <input type="text" class="form-control" name="budget" />
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
                    <input type="text" class="form-control datepicker" name="start_date" placeholder="mm/dd/yyyy"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4"><span class="required">* </span>End Date</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control datepicker" name="end_date" placeholder="mm/dd/yyyy"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4">Copy</label>
                <div class="col-sm-8">
                    <textarea name="copy" class="form-control" rows="4" cols="50" placeholder="describe your campaign and what you hope to achieve "></textarea>
                </div>
            </div>


            <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>

            <div class="form-group">
                <label class="control-label col-sm-4">Image</label>
                <div class="col-sm-8">
                    <input type="file" name="screen_shot" id="screen_shot"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4">URL</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="url" PLACEHOLDER="Where can supporters go to learn more?"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4">Platform</label>
                <div class="col-sm-8">
                    <select name="platform" id="platform" class="form-control">
                        <option value="facebook">Facebook</option>
                    </select>
                    <div style="font-size: small"><span class="required">* </span>shareitcamp will only report on potential reach of posts to Facebook</div>
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
            Non-profits: please consider donating one of the following
            <ul id="donation-types" style="text-align: center;">

                <li>- <a href="/create-reward" class="highlighted">Reward</a></li>
                <li>- Facebook Post</li>
                <li>- Newsletter Ad</li>
                <li>- Booth at Event</li>
            </ul>

            <button class="btn btn-primary" type="submit">Submit</button>

        </form>
    </div>
</div>

<div class="col-sm-3"></div>

