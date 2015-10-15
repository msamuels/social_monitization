<!DOCTYPE html>
<html>
<body>

<form action="/save-producer" method="POST">
  <label>First Name:</label> 
  <input type="text" name="first_name" />
  <br />

  <label>Last Name:</label> 
  <input type="text" name="last_name" />
  <br />

  <label>Username:</label> 
  <input type="text" name="user_name" />
  <br />

  <label>Password:</label> 
  <input type="text" name="password" />
  <br />

  <label>Email Address:</label> 
  <input type="text" name="email_address" />
  <br />

  <label>Organization Name:</label> 
  <input type="text" name="org_name" />
  <br />

  <label>Website:</label> 
  <input type="text" name="organization_url" />
  <br />

  <label>Org Description:</label> 
  <input type="text" name="description" />
  <br />
  Country: <select name="country">
    <option value="volvo">Volvo</option>
    <option value="saab">Saab</option>
    <option value="fiat">Fiat</option>
    <option value="audi">Audi</option>
  </select>
  <br>

  <label>Non Profits Click Here:</label> 
  <input type="radio" name="non-profit" />
  <br />

  <br>
  <input type="submit">
  <br />

  By clicking this form you agree to the Iliv8 terms and conditions.
</form>

</body>
</html>
