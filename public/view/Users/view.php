<div class="col-md-12">
    <div class="row justify-content-center">
        <h1 class="mb-4">Users</h1>
    </div>

    <div class="row">
        <div class="row col-md-12">
            <div class="col-md-3"><strong>Name</strong></div>
            <div class="col-md-3 "><strong>Email</strong></div>
            <div class="col-md-3 "><strong>Status</strong></div>
        </div>

        <?php /** @var \App\DTO\UserDTO $user */
        foreach ($data as $user): ?>
            <div class="row col-md-12 ">
                <span class="col-md-3 ">
                    <?= $user->getFirstName() ?>
                    <?= $user->getLastName() ?> </span>
                <span class="col-md-3"><?= $user->getEmail() ?></span>

                <form method="post">
                    <input type="hidden" name="user_id" value="<?= $user->getId() ?>">
                    <button type="submit"
                            name="is_active"
                            value="<?= $user->isIsActive() ?>"
                            class="btn btn-<?= $user->isIsActive() ? 'success' : 'danger' ?> m-1">
                        <?= $user->isIsActive() ? 'Active' : 'Inactive' ?>
                    </button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</div>