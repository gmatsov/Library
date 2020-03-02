<div class="col-md-12">
    <div class="row justify-content-center">
        <h1 class="mb-4">Books</h1>
    </div>
    <?php if (isset($_SESSION['is_admin'])): ?>
        <div class="row">
            <a href="add" class="btn btn-info m-3">Add book</a>
        </div>
    <?php endif; ?>
    <table class="table">
        <tr>
            <th>Name</th>
            <th>ISBN</th>
            <th></th>
            <th></th>
            <?php if (isset($_SESSION['is_admin'])): ?>
                <th></th>
                <th></th>
            <?php endif; ?>
        </tr>
        <?php /** @var \DTO\BookDTO $book */
        foreach ($data as $book):?>
            <tr>
                <td>
                    <?= $book->getName() ?>
                </td>
                <td>
                    <?= $book->getIsbn() ?>
                </td>
                <td>
                    <a href="view/<?= $book->getId() ?>" class="btn btn-secondary">View</a>

                </td>
                <td>
                    <form method="post" action="/<?= APP_ROOT ?>/users/addToCollection/<?= $_SESSION['user_id'] ?>">
                        <input type="hidden" name="book_id" value="<?= $book->getId() ?>">
                        <input type="submit" class="btn btn-secondary" value="Add to collection">
                    </form>
                </td>

                <?php if (isset($_SESSION['is_admin'])): ?>
                    <td>
                        <a href="edit/<?= $book->getId() ?>" class="btn btn-secondary">Edit</a>
                    </td>
                    <td>
                        <form method="post" action="/<?= APP_ROOT ?>/books/remove/<?= $book->getId() ?>">
                            <input type="submit" class="btn btn-danger" value="Remove">
                        </form>
                    </td>
                <?php endif ?>
            </tr>
        <?php endforeach; ?>
    </table>
</div>