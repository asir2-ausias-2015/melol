<h1>Login</h1>
<form action = "index.php?action=login" method = "post" name = "login_form">
    <div>
	<div id="inputlogin">Usuario: &nbsp;&nbsp;&nbsp;<input type = "text" name = "usuario" /></div>
	<div id="inputlogin">Password: <input type = "password" name = "password" id = "password"/></div>
    
    
    <input class="margXL" type = "button" value = "Login"
           onclick = "formhash(this.form, this.form.password);" />
    </div>
</form>

