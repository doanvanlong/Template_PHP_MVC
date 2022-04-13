<div class="content-header">
    <h5 class=" bg-secondary text-light p-2" style="border-radius:3px;">Danh sách môn học</h5>

</div>
<div class="content bg-white">
    <div class="row">
        <div class="danh-muc-chinh col-12">

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên môn học</th>
                        <th>Hình ảnh</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data['result'] as $subject) {
                    ?>
                        <tr>
                            <td scope="row"><?=$subject['id'];?></td>
                            <td><?=$subject['subject_name'];?></td>
                            <td><img width="60" src="../public/upload/<?php echo trim($subject['subject_img']);?>" alt=""></td>
                            <td><a href="">Xem |</a>
                            <a href="">Sửa |</a>
                        <a href="">Xoá</a></td>
                        </tr>
                    <?php
                    }
                    ?>


                </tbody>
            </table>
        </div>



    </div>
</div>