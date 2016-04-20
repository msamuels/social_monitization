<H1>Create Campaign</H1>

<form action="/save-campaign" method="POST" class="form-horizontal" role="form">
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
    <label class="control-label col-sm-2">Estimate:</label>
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

  <div class="form-group">
    <label class="control-label col-sm-2">Screen Shot:</label>
    <div class="col-sm-10">
    <input type="text" name="screen_shot" />
    </div>
  </div>

    <button class="btn btn-primary" type="submit" >Submit</button>

</form>