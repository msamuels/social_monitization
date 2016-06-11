<H1>Campaign Setup</H1>
<h2>Non-Profit Donation:Reward</h2>
<form action="/save-reward"  enctype="multipart/form-data" method="POST" class="form-horizontal" role="form">
    <div class="form-group">
        <label class="control-label col-sm-2">Reward Name:</label>
        <div class="col-sm-10">
            <input type="text" name="reward_name" />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Quanity:</label>
        <div class="col-sm-10">
            <input type="text" name="quantity_remaining" />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Expiration date:</label>
        <div class="col-sm-10">
            <input type="text" name="expiration date" placeholder="yyyy/mm/dd"/>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Details:</label>
        <div class="col-sm-10">
           <textarea rows="4" cols="50" name="details">Bla</textarea>
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-sm-2">Image:</label>
        <div class="col-sm-10">
            <input type="file" name="image" id="image" />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">URL:</label>
        <div class="col-sm-10">
            <input type="text" name="url" />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">Point Value:</label>
        <div class="col-sm-10">
            <input type="text" name="point_value" />
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-2">How will you provide this to us:</label>
        <div class="col-sm-10">
            <textarea rows="4" cols="50" name="details">Bla</textarea>
        </div>
    </div>

    <button class="btn btn-primary" type="submit" >Submit</button>

</form>
