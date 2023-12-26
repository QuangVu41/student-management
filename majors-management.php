<?php
if (isset($_POST['add']) && !empty($depart_id)) {
    $major_name = $_POST['major_name'];
    $result = addMajor($major_name, $depart_id);
    if ($result) {
        header('location: ./index.php?page=majors-manage&depart_id=' . $depart_id);
    } else {
        echo "Cannot add a new major!";
        die();
    }
}
if (!empty($_POST['update']) && !empty($depart_id)) {
    $major_name = $_POST['major_name'];
    $major_id = $_POST['major_id'];
    $result = updateMajor($major_name, $major_id);
    if ($result) {
        header('location: ./index.php?page=majors-manage&depart_id=' . $depart_id);
    } else {
        echo "Cannot modify this major!";
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
                                <h2 class="cart-info__heading">
                                    <a href="?page=department-manage">
                                        <img src="./assets/icons/arrow-left.svg" alt="" class="icon cart-info__back-arrow" />
                                    </a>
                                    Quản lý chuyên ngành <?= $department['department_name'] ?>
                                </h2>
                                <p class="cart-info__desc profile__desc">Chuyên ngành</p>
                            </div>
                            <form action="" method="post">
                                <div class="form__row">
                                    <div class="form__text-input">
                                        <input type="text" name="major_name" id="major_name" class="form__input" value="" />
                                        <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                    </div>
                                    <input style="flex: initial" type="submit" name="add" value="Thêm" class="btn btn--primary">
                                </div>
                            </form>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Chuyên ngành</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                if (!empty($majors)) {
                                    foreach ($majors as $major) {
                                        extract($major);
                                        $info = '?page=majors-manage&major_id=' . $id;
                                        $delete = '?page=del-major&depart_id=' . $depart_id . '&major_id=' . $id; ?>
                                        <tr>
                                            <td><?= $i ?></td>
                                            <td><?= $major_name ?></td>
                                            <td>
                                                <div class="action-btn">
                                                    <button class="action-btn__link js-toggle" toggle-target="#edit-dialog-<?= $id ?>" style="--color:#5676ef;"><img src="./assets/icons/edit.svg" alt=""></button>
                                                    <!-- Modal: edit -->
                                                    <div class="modal modal--small hide" id="edit-dialog-<?= $id ?>">
                                                        <div class="modal__content">
                                                            <form action="" method="post">
                                                                <h3 style="text-align: left; margin-bottom: 12px;" class="cart-info__heading">Sửa chuyên ngành</h3>
                                                                <div class="form__text-input">
                                                                    <input type="text" name="major_id" value="<?= $id ?>" hidden>
                                                                    <input type="text" name="major_name" id="major_name" class="form__input" value="<?= $major_name ?>" />
                                                                    <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
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

                                                    <button class="action-btn__link js-toggle" toggle-target="#del-dialog-<?= $id ?>" style="--color: #d50c0c;"><img src="./assets/icons/trash.svg" alt=""></button>
                                                    <!-- Modal: delete confirm -->
                                                    <div class="modal modal--small hide" id="del-dialog-<?= $id ?>">
                                                        <div class="modal__content">
                                                            <p class="modal__text" style="white-space: initial">Bạn có chắc muốn xóa chuyên ngành <?= $major_name ?> không?</p>
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