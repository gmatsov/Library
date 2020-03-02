<div class="col-md-12">
    <div class="row justify-content-center">
        <h1 class="mb-4">My Collection</h1>
    </div>
    <div class="text-center row justify-content-center">
        <div>
            <?php /** @var \DTO\BookDTO $data */ ?>
            <p>Name: <?= $data->getName() ?></p>
            <p>ISBN: <?= $data->getIsbn() ?></p>
            <p>Description: <?= $data->getDescription() ?></p>
            <div id="book_cover">
                <img src="../../public/<?= $data->getImageSrc() ?>" alt="<?= $data->getName() ?> cover" class="rounded">
            </div>
        </div>

    </div>
</div>