<?php
if (!empty($_POST['update'])) {
    $depart_name = $_POST['department_name'];
    $desc = $_POST['desc'];
    $depart_id = $_POST['depart_id'];
    $result = updateDepartment($depart_name, $desc, $depart_id);
    if ($result) {
        header('location: ./index.php?page=department-manage');
    } else {
        echo 'Cannot modify department!';
        die();
    }
}
?>

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
                                <h2 class="cart-info__heading">Quản lý ngành học</h2>
                                <p class="cart-info__desc profile__desc">Ngành</p>
                            </div>
                            <a href="?page=add-department" class="btn btn--primary btn--rounded">
                                <img src="./assets/icons/plus.svg" alt="">
                                Thêm ngành học
                            </a>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên ngành</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                if (!empty($departments)) {
                                    foreach ($departments as $department) {
                                        extract($department);
                                        $edit = '?page=edit-department&depart_id=' . $id;
                                        $info = '?page=majors-manage&depart_id=' . $id;
                                        $delete = '?page=delete-department&depart_id=' . $id; ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $department_name ?></td>
                                            <td>
                                                <div class="action-btn">
                                                    <button class="action-btn__link js-toggle" toggle-target="#edit-dialog-<?= $id ?>" style="--color:#5676ef;"><img src="./assets/icons/edit.svg" alt=""></button>
                                                    <!-- Modal: edit -->
                                                    <div class="modal modal--medium hide" id="edit-dialog-<?= $id ?>">
                                                        <div class="modal__content">
                                                            <form action="" method="post">
                                                                <div class="form__row" style="flex-direction: column; gap: 0;">
                                                                    <h3 class="cart-info__heading">Sửa ngành học</h3>
                                                                    <div class="form__group">
                                                                        <input hidden type="text" name="depart_id" id="depart_id" value="<?= $id ?>">
                                                                        <label for="department_name" style="text-align: left" class="form__label form-card__label">
                                                                            Department name
                                                                        </label>
                                                                        <div class="form__text-input">
                                                                            <input type="text" name="department_name" id="department_name" class="form__input" value="<?= $department['department_name'] ?>" />
                                                                            <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form__group">
                                                                        <label for="desc" style="text-align: left" class="form__label form-card__label">Mô tả</label>
                                                                        <div class="form__text-area">
                                                                            <textarea name="desc" id="desc" placeholder="Description" class="form__text-area-input"><?= $department['description'] ?></textarea>
                                                                            <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal__bottom">
                                                                    <button class="btn btn--small btn--outline btn--text modal__btn js-toggle" toggle-target="#edit-dialog-<?= $id ?>">
                                                                        Hủy bỏ
                                                                    </button>
                                                                    <input type="submit" name="update" value="Cập nhật" class="btn btn--small btn--primary btn--no-margin modal__btn">
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal__overlay js-toggle" toggle-target="#edit-dialog-<?= $id ?>"></div>
                                                    </div>

                                                    <a href="<?= $info ?>" class="action-btn__link" style="--color:#ffb700;"><img src="./assets/icons/info.svg" alt=""></a>

                                                    <button class="action-btn__link js-toggle" toggle-target="#del-dialog-<?= $id ?>" style="--color: #d50c0c;"><img src="./assets/icons/trash.svg" alt=""></button>
                                                    <!-- Modal: delete confirm -->
                                                    <div class="modal modal--small hide" id="del-dialog-<?= $id ?>">
                                                        <div class="modal__content">
                                                            <p class="modal__text" style="white-space: initial">Bạn có chắc muốn xóa ngành <?= $department_name ?> không?</p>
                                                            <div class="modal__bottom">
                                                                <button class="btn btn--small btn--outline btn--text modal__btn js-toggle" toggle-target="#del-dialog-<?= $id ?>">
                                                                    Hủy bỏ
                                                                </button>
                                                                <a href="<?= $delete ?>" class="btn btn--danger btn--small btn--primary btn--no-margin modal__btn">
                                                                    Xóa
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="modal__overlay js-toggle" toggle-target="#del-dialog-<?= $id ?>"></div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                <?php $i++;
                                    }
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