<div class="col-md-12">
    <div class="row justify-content-center">
        <h1 class="mb-4">Edit my data</h1>
    </div>
    <div class="row justify-content-center text-center">
        <form method="post">
            <?php /** @var \app\DTO\UserDTO $data */ ?>
            <input type="hidden" name="user_id" value="<?= $data->getId() ?>">
            <div>
                <label for="first_name">First name*</label>
                <input type="text" class="form-control" name="first_name" id="first_name"
                       value="<?= $data->getFirstName() ?>" required>
            </div>
            <div>
                <label for="last_name">Last name*</label>
                <input type="text" class="form-control" name="last_name" id="last_name"
                       value="<?= $data->getLastName() ?>" required>
            </div>
            <div>
                <label for="email">Email*</label>
                <input type="email" class="form-control" name="email" id="email"
                       value="<?= $data->getEmail() ?>" required>
            </div>
            <div>
                <label for="old_password">Old password*</label>
                <input type="password" class="form-control" name="old_password" id="old_password" required>
            </div>
            <div>
                <label for="password">Password*</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div>
                <label for="confirm_password">Confirm password*</label>
                <input type="password" class="form-control" name="confirm_password" id="confirm_password">
            </div>
            <input type="submit" class="btn btn-success m-2" value="Edit">
        </form>
    </div>
</div>