<div class="content-header">
    <h5 class=" bg-secondary text-light p-2" style="border-radius:3px;">Thêm môn học</h5>

</div>
<div class="content">
    <div class="row">
        <div class="danh-muc-chinh col-12">
            <?php
            if (isset($_COOKIE["msg"])){
            ?>
                <div class="bg-info p-2"><?php echo $_COOKIE['msg']; ?></div>
            <?php
            }
            ?>

            <form action="../subject/xulyadd" id="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên môn học</label>
                    <input type="text" autocomplete="off" class="form-control" name="subject-name" id="" aria-describedby="" placeholder="...">
                    <small id="error-" class="form-text text-danger "></small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Hình ảnh</label>
                    <br>
                    <input type="file" name="subject-img" id="" aria-describedby="">
                </div>
                <button type="submit" name="submit" class="btn btn-success">Thêm mới</button>
            </form>
        </div>



    </div>
</div>