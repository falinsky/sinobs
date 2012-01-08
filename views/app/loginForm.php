<form action='/' method='POST'>
    <input type='hidden' name='action' value='login'/>
    <label for='login'>Login:</label>
    <input id='login' type='text' name='params[user][login]' value='<?php echo isset($params["user"]["login"])? $params["user"]["login"] : '';?>' />

    <br/>
    <label for='pass'>Pass:</label>&nbsp;&nbsp;
    <input id='pass' type='password' name='params[user][pass]' value='<?php echo isset($params["user"]["pass"])? $params["user"]["pass"] : '';?>' />

    <br/>
    <input type='submit'/>
</form>
