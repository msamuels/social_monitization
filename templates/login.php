<H1>Login </H1>

<?php if(!empty($email_error)){ ?>
    <p class="error"><?php echo $email_error; ?></p>
<?php } ?>

<?php if(!empty($password_error)){ ?>
    <p class="error"><?php echo $password_error; ?></p>
<?php } ?>

<?php if(!empty($error)){ ?>
    <p class="error"><?php echo $error; ?></p>
<?php } ?>

<form action="/login" method="POST">

    <label>Account Type:</label>

    <select name="user_type">
        <option value="suporter">Suporter</option>
        <option value="producer">Producer</option>
    </select>
    <br />

    <label>Username:</label> 
    <input type="text" name="email" />
    <br />

    <label>Password:</label> 
    <input type="text" name="password" />
    <br />

    <button class="btn btn-primary" type="submit" >Submit</button>

</form>
