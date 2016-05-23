<H1>Login </H1>

<p><?php echo '<a href="' . htmlspecialchars($fb_login_url) . '">Log in with Facebook!</a>'; ?></p>

<?php if(!empty($email_error)){ ?>
    <div class="alert alert-danger"><?php echo $email_error; ?></div>
<?php } ?>

<?php if(!empty($password_error)){ ?>
    <div class="alert alert-danger"><?php echo $password_error; ?></div>
<?php } ?>

<?php if(!empty($error)){ ?>
    <div class="alert alert-danger"><?php echo $error; ?></div>
<?php } ?>

<form action="/login" method="POST">

    <label>Account Type:</label>

    <select name="user_type">
        <option value="supporter">Supporter</option>
        <option value="producer">Producer</option>
    </select>
    <br />

    <label>Email:</label> 
    <input type="text" name="email" />
    <br />

    <label>Password:</label> 
    <input type="text" name="password" />
    <br />

    <button class="btn btn-primary" type="submit" >Submit</button>

</form>
