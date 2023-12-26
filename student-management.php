<!-- Main -->
<main class="profile">
    <div class="container">
        <!-- Mobile Search bar -->
        <div class="profile-container">
            <div class="search-bar d-none d-md-flex">
                <input type="text" name="" id="" placeholder="Search for item" class="search-bar__input" />
                <button class="search-bar__submit">
                    <img src="./assets/icons/search.svg" alt="" class="search-bar__icon icon" />
                </button>
            </div>
        </div>

        <!-- profile content -->
        <div class="profile-container">
            <div class="row gy-md-3">
                <div class="col-9 col-xl-8 col-lg-7 col-md-12">
                    <div class="cart-info">
                        <div class="cart-info__prod">
                            <div>
                                <h2 class="cart-info__heading">Students Management</h2>
                                <p class="cart-info__desc profile__desc">Students</p>
                            </div>
                            <a href="?page=add-student" class="btn btn--primary btn--rounded">
                                <img src="./assets/icons/plus.svg" alt="">
                                Thêm sinh viên
                            </a>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã SV</th>
                                    <th>Ảnh</th>
                                    <th>Họ và tên</th>
                                    <th>Giới tính</th>
                                    <th>Tên lớp</th>
                                    <th>Chuyên ngành</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($students as $student) {
                                    extract($student);
                                    $edit = '?page=edit-student&id=' . $student_id;
                                    $delete = '?page=delete-student&id=' . $student_id;
                                    $major = getStudentMajor($major_id);
                                    $status = getStudentStatus($status_id); ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $student_id ?></td>
                                        <td><img src="<?= $image ?>" alt=""></td>
                                        <td><?= $student_name ?></td>
                                        <td><?= $gender ?></td>
                                        <td><?= $class_id ?></td>
                                        <td><?= $major['major_name'] ?></td>
                                        <td><?= $status['status_name'] ?></td>
                                        <td>
                                            <div class="action-btn">
                                                <a href="" class="action-btn__link" style="--color:#ffb700;"><img src="./assets/icons/eye.svg" alt=""></a>
                                                <a href="<?= $edit ?>" class="action-btn__link" style="--color:#5676ef;"><img src="./assets/icons/edit.svg" alt=""></a>
                                                <!-- <a href="<?= $delete ?>" class="action-btn__link action-btn__link--delete" style="--color: #d50c0c;"><img src="./assets/icons/trash.svg" alt=""></a> -->
                                                <button class="action-btn__link js-toggle" toggle-target="#del-dialog-<?= $student_id ?>" style="--color: #d50c0c;"><img src="./assets/icons/trash.svg" alt=""></button>
                                                <!-- Modal: delete confirm -->
                                                <div class="modal modal--small hide" id="del-dialog-<?= $student_id ?>">
                                                    <div class="modal__content">
                                                        <p class="modal__text" style="white-space: initial">Bạn có chắc muốn xóa sinh viên <?= $student_name . ' MSV là: ' . $student_id ?></p>
                                                        <div class="modal__bottom">
                                                            <button class="btn btn--small btn--outline btn--text modal__btn js-toggle" toggle-target="#del-dialog-<?= $student_id ?>">
                                                                Hủy bỏ
                                                            </button>
                                                            <a href="<?= $delete ?>" class="btn btn--danger btn--small btn--primary btn--no-margin modal__btn">
                                                                Xóa
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="modal__overlay js-toggle" toggle-target="#del-dialog-<?= $student_id ?>"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    $i++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                require_once './sidebar-user.php';
                ?>
            </div>
        </div>
    </div>
</main>