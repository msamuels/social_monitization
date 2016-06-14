<div class="row">

    <div class="col-sm-3"></div>

    <div class="col-sm-6">

        <H1>Create Campaign</H1>

        <form action="/save-campaign" enctype="multipart/form-data" method="POST" class="form-horizontal" role="form">
            <div class="form-group">
                <label class="control-label col-sm-4">Campaign Name:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="campaign_name"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4">Budget(Optional):</label>
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
                <label class="control-label col-sm-4">Start Date:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="start_date" placeholder="yyyy-mm-dd"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4">End Date:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="end_date" placeholder="yyyy-mm-dd"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4">Copy:</label>
                <div class="col-sm-8">
                    <textarea name="copy" class="form-control" rows="4" cols="50"></textarea>
                </div>
            </div>


            <input type="hidden" name="MAX_FILE_SIZE" value="10000000"/>

            <div class="form-group">
                <label class="control-label col-sm-4">Image:</label>
                <div class="col-sm-8">
                    <input type="file" name="screen_shot" id="screen_shot"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4">Url:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="url"/>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4">Platform:</label>
                <div class="col-sm-8">
                    <select name="platform" id="platform" class="form-control">
                        <option value="facebook">Facebook</option>
                    </select>
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
            <ul id="donation-types">

                <li style="display: inline">Facebook Post</li>
                <li style="display: inline"><a href="/create-reward">Reward</a></li>
                <li style="display: inline">Newsletter Ad</li>
                <li style="display: inline">Booth at Event</li>
            </ul>

            <button class="btn btn-primary" type="submit">Submit</button>

        </form>
    </div>
</div>

<div class="col-sm-3"></div>

