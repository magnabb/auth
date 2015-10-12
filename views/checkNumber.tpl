<div class="col-md-6 col-md-offset-3">
    <form method="post" action="/register/send">

        <div class="form-group">
            <label for="exampleInputEmail1">Check code</label>
            <input type="text" class="form-control" name="checkCode" placeholder="Check code">
        </div>

        <button type="submit" class="btn btn-default">Send</button>
    </form>
</div>

{*todo: remove when connect api*}
<div class="container">
    <div class="row">
        Code: {$code}

    </div>
</div>
