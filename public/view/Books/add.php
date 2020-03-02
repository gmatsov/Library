<div class="col-md-12">
    <div class="row justify-content-center">
        <h1 class="mb-4">Add book</h1>
    </div>
    <div class="row justify-content-center">
        <form method="post" enctype="multipart/form-data">
            <div class="row m-2">
                <label for="name">Name*</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Book name" required>
            </div>
            <div class="row m-2">
                <label for="isbn">ISBN*</label>
                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN" required>
            </div>
            <div class="row m-2">
                <label for="description">Description*</label>
                <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                          required></textarea>
            </div>
            <div class="row m-2">
                <label for="confirm_password">Book cover*</label>
                <input type="file" name="book_cover" class="form-control-file" id="image"
                       required>
            </div>
            <p>Allowed file types: "jpg", "jpeg", "png", "gif"</p>
            <p>Allowed file size: "1Mb"</p>
            <div class="row m-2">
                <input type="submit" class="btn btn-success" value="Add book">
            </div>
        </form>
    </div>
</div>