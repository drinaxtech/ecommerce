<?php $this->start('body'); ?>
<div class="wrapper">
    <div class="auth-content">
        <div class="card">
            <div class="card-body text-center">
                <div class="mb-4">
                    <img class="brand" src="<?php echo BASE_URL; ?>assets/images/logo.png" alt="logo">
                </div>
                <h6 class="mb-4 text-muted">Sign in to your account</h6>

                <form id="login" action="" method="POST">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Email or Username"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group text-left">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="remember" class="custom-control-input" id="remember-me">
                            <label class="custom-control-label" for="remember-me">Remember me</label>
                        </div>
                    </div>
                    <button class="btn btn-primary shadow-2 mb-4">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $this->end(); ?>

<?php $this->start('footer'); ?>

<script>
$("#login").validate({
    errorClass: "text-danger border-danger",
    submitHandler: function(form) {
        let data = new FormData(form);
        login(serializeData(data));
        //console.log(serializeData(data));
    }
});

function serializeData(data) {
    let obj = {};
    for (let [key, value] of data) {
        if (obj[key] !== undefined) {
            if (!Array.isArray(obj[key])) {
                obj[key] = [obj[key]];
            }
            obj[key].push(value);
        } else {
            obj[key] = value;
        }
    }
    return obj;
}

function login(data){
    $.post('<?php echo BASE_URL; ?>auth/loginAction', data, function(data){
        data = JSON.parse(data);
        if(data.status == 'success'){
            window.location.reload();
            return ;
        }

        alertify[data.status](data.message);
    });
}
</script>

<?php $this->end(); ?>