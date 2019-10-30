<!-- <form action="#" method="POST">
    <input id="text" name="mailuid" placeholder="Username/E-mail...." require>
    <input id="password" name="pwd" placeholder="Password...." require>
    <button type="submit" name="login-submit">Login</button>
</form> -->


<form action="./login.php" method="POST">
    <label for="email">Email</label> 
    <input type="email" id="email" name="email" required="email"/>
    <label for="password">Email</label> 
    <input type="password" id="password" name="password" required/>
    <input type="submit" name="submit" />
</form>