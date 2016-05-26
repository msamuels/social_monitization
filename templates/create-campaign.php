<H1>Create Campaign</H1>

<form action="/save-campaign"  enctype="multipart/form-data" method="POST" class="form-horizontal" role="form">
  <div class="form-group">
      <label class="control-label col-sm-2">Campaign Name:</label>
    <div class="col-sm-10">
      <input type="text" name="campaign_name" />
      </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2">Budget:</label>
    <div class="col-sm-10">
    <input type="text" name="budget" />
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2">Estimated Impressions:</label>
    <div class="col-sm-10">
    <input type="text" name="estimate" />
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2">Start Date:</label>
    <div class="col-sm-10">
    <input type="text" name="start_date" />
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-2">End Date:</label>
    <div class="col-sm-10">
    <input type="text" name="end_date" />
    </div>
  </div>

 <textarea name="copy" rows="4" cols="50"></textarea> 

  <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />

  <div class="form-group">
    <label class="control-label col-sm-2">Image:</label>
    <div class="col-sm-10">
    <input type="file" name="screen_shot" id="screen_shot" />
    </div>
  </div>

  <label>Targeting:</label>
  <SELECT NAME="interests" MULTIPLE SIZE=5>
    <OPTION VALUE="sports">sports
    <OPTION VALUE="music">music
    <OPTION VALUE="outdoors">onions
    <OPTION VALUE="culture">tomatoes
    <OPTION VALUE="religion">olives
  </SELECT>
  <br />

  Non-profits: please consider donating one of the following
  <ul id="donation-types">

    <li style="display: inline">Facebook Post</li>
    <li style="display: inline"><a href="/create-reward">Reward</a></li>
    <li style="display: inline">Newsletter Ad</li>
    <li style="display: inline">Booth at Event</li>
  </ul>

  <button class="btn btn-primary" type="submit">Submit</button>

</form>

