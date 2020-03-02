<div class="col-md-12">
    <div class="row justify-content-center">
        <h1 class="mb-4">Edit book</h1>
    </div>
    <div class="row">
        <?php /** @var app\DTO\BookDTO $data */ ?>

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$data->getId()?>">
            <div class="row m-2">
                <label for="name">Name*</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Book name"
                       value="<?= $data->getName() ?>" required>
            </div>
            <div class="row m-2">
                <label for="isbn">ISBN*</label>
                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN"
                       value="<?= $data->getIsbn() ?>" required>
            </div>
            <div class="row m-2">
                <label for="description">Description*</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                          required><?= $data->getDescription() ?></textarea>
            </div>
            <div class="row m-2">
                <label for="confirm_password">Book cover</label>
                <input type="file" name="book_cover" class="form-control-file" id="image">
            </div>
            <p>Allowed file types: "jpg", "jpeg", "png", "gif"</p>
            <p>Allowed file size: "1Mb"</p>

            <div class="row m-2">
                <input type="submit" class="btn btn-success" value="Edit book">
            </div>
        </form>
        <div id="edit_cover">
            <img src="../../public/<?= $data->getImageSrc() ?>"  alt="<?= $data->getName() ?>> cover">
        </div>
    </div>
</div>