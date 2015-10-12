<div class="col-md-6 col-md-offset-3">
    <form id='register' method="post" action="/register/checkNumber">

        {if isset($error)}
            <div class="form-group has-error">
                {$error}
            </div>
        {/if}

        <div class="form-group">
            <label for="exampleInputEmail1">Phone number</label>
            <input type="tel" class="form-control" name="phoneNumber" placeholder="Phone number">
        </div>

        {*<div class="form-group">*}
        {*<label for="exampleInputEmail1">Check code</label>*}
        {*<input type="text" class="form-control" name="checkCode" placeholder="Check code">*}
        {*</div>*}

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" id='password' size='60' class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Repeat Password</label>
            <input type="password" id='password2' size='60' class="form-control" name="repassword" placeholder="Repeat Password">
        </div>

        <button type="submit" class="btn btn-default">Register</button>
    </form>
</div>