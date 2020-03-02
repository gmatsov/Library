<div class="col-md-12">
    <div class="row justify-content-center">
        <h1 class="mb-4">My Collection</h1>
    </div>
    <div class="row">
        <div class="row col-md-12">
            <div class="col-md-4"><strong>Name</strong></div>
            <div class="col-md-3 "><strong>ISBN</strong></div>
            <div class="col-md-2 "><strong>View</strong></div>
            <div class="col-md-3 "><strong></strong></div>
        </div>
        <div class="row col-md-12 ">

            <?php /** @var \app\DTO\BookDTO $book */

            foreach ($data as $book): ?>
                <div class="col-md-4"><?= $book->getName() ?></div>
                <div class="col-md-3 "><?= $book->getIsbn() ?></div>
                <div class="col-md-2">
                    <a href="view/<?= $book->getId() ?>" class="btn btn-info m-1">View book</a>
                </div>
                <td>
                    <form method="post" action="/<?= APP_ROOT ?>/users/removeFromCollection/<?= $_SESSION['user_id'] ?>">
                        <input type="hidden" name="book_id" value="<?= $book->getId() ?>">
                        <input type="submit" class="btn btn-danger" value="Remove">
                    </form>
                </td>
            <?php endforeach; ?>
        </div>
    </div>
</div>