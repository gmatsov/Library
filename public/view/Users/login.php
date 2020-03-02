<div class="col-md-12">
    <div class="row justify-content-center">
        <h1 class="mb-4">Login</h1>
    </div>
    <div class="row justify-content-center">
        <form method="post">
            <div class="row">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" value="Email" required>
            </div>
            <div class="row">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" value="Password" required>
            </div>
            <div class="row mt-3">
                <input type="submit" class="btn btn-success" value="Login">
            </div>
        </form>
    </div>
    <div class="row justify-content-center">
        If you haven't account&nbsp;<a href="/<?= APP_ROOT ?>/users/register">Register</a>
    </div>
</div>