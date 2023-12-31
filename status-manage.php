<?php
if (!empty($_SESSION['role']) && $_SESSION['role'] == 1) {
    if (!empty($_POST['update'])) {
        $status_name = $_POST['status_name'];
        $desc = $_POST['desc'];
        $status_id = $_POST['status_id'];
        $result = updateStatus($status_name, $desc, $status_id);
        if ($result) {
            header('location: ./index.php?page=status-manage');
        } else {
            echo 'Cannot modify status!';
            die();
        }
    }
    if (!empty($_POST['add'])) {
        $status_name = $_POST['status_name'];
        $desc = $_POST['desc'];
        $result = addStatus($status_name, $desc);
        if ($result) {
            header('location: ./index.php?page=status-manage');
        } else {
            echo 'Cannot add status!';
            die();
        }
    }
    if (!empty($_POST['filter'])) {
        $_SESSION['status-filter'] = $_POST;
    }
    if (!empty($_SESSION['status-filter'])) {
        $where = '';
        foreach ($_SESSION['status-filter'] as $field => $value) {
            if (!empty($value) && $field != 'filter') {
                $where =  "$field = '$value'";
            }
        }
        extract($_SESSION['status-filter']);
        if (!empty($where)) {
            $query = "SELECT * FROM student_status WHERE $where";
            $allStatus = getStatusByParam($query);
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
                                    <h2 class="cart-info__heading">Quản lý trạng thái</h2>
                                    <p class="cart-info__desc profile__desc">Trạng thái</p>
                                </div>
                                <div class="cart-info__row">
                                    <button class="btn btn--primary btn--rounded js-toggle" toggle-target="#add-dialog">
                                        <img src="./assets/icons/plus.svg" alt="">
                                        Thêm trạng thái
                                    </button>
                                    <div class="filter-wrap">
                                        <button class="filter-btn js-toggle" toggle-target="#home-filter">
                                            Bộ lọc
                                            <img src="./assets/icons/filter.svg" alt="" class="icon filter-btn__icon" />
                                        </button>
                                        <div id="home-filter" class="filter hide" style="left: 60%">
                                            <img src="./assets/icons/arrow-up.png" alt="" class="filter__arrow" />
                                            <h3 class="filter__heading">Bộ lọc</h3>
                                            <form action="" class="filter__form form" style="margin-top: 0" method="post">
                                                <div class="filter__content">
                                                    <div class="row gx-1">
                                                        <div class="col">
                                                            <div class="form__group">
                                                                <label for="student_id" style="text-align: left" class="form__label form-card__label">
                                                                    Trạng thái
                                                                </label>
                                                                <div class="form__text-input form__text-input--small">
                                                                    <?php $Statuses = getAllStatus();
                                                                    if (!empty($Statuses)) { ?>
                                                                        <select class="form__select form__select-lv2" name="status_id" id="status_id">
                                                                            <option value="">-- Chọn trạng thái --</option>
                                                                            <?php foreach ($Statuses as $st) { ?>
                                                                                <option value="<?= $st['status_id'] ?>"><?= $st['status_name'] ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    <?php } else { ?>
                                                                        <a href="?page=status-manage" class="btn btn--xsmall btn--danger">Không có trạng thái!</a>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="filter__row filter__footer">
                                                    <button class="btn btn--text filter__cancel js-toggle" toggle-target="#home-filter">
                                                        Hủy
                                                    </button>
                                                    <input type="submit" name="filter" value="Lọc" class="btn btn--primary filter__submit">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal: edit -->
                                <div class="modal hide" id="add-dialog">
                                    <div class="modal__content">
                                        <form action="" method="post" id="form-6">
                                            <div class="form__row" style="flex-direction: column; gap: 0;">
                                                <h3 class="cart-info__heading">Thêm trạng thái</h3>
                                                <div class="form__group">
                                                    <label for="status_name" style="text-align: left" class="form__label form-card__label">
                                                        Trạng thái
                                                    </label>
                                                    <div class="form__text-input">
                                                        <input type="text" name="status_name" id="status_name" class="form__input" />
                                                        <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                    </div>
                                                    <p class="form__error"></p>
                                                </div>

                                                <div class="form__group">
                                                    <label for="desc" style="text-align: left" class="form__label form-card__label">Mô tả</label>
                                                    <div class="form__text-area">
                                                        <textarea name="desc" id="desc" placeholder="Description" class="form__text-area-input"></textarea>
                                                        <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                    </div>
                                                    <p class="form__error"></p>
                                                </div>
                                            </div>
                                            <div class="modal__bottom">
                                                <button class="btn btn--small btn--outline btn--text modal__btn js-toggle" toggle-target="#add-dialog">
                                                    Hủy bỏ
                                                </button>
                                                <input type="submit" name="add" value="Thêm" class="btn btn--small btn--primary btn--no-margin modal__btn">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal__overlay js-toggle" toggle-target="#add-dialog"></div>
                                </div>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1;
                                    if (!empty($allStatus)) {
                                        foreach ($allStatus as $status) {
                                            extract($status);
                                            $delete = '?page=delete-status&status_id=' . $status_id; ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $status_name ?></td>
                                                <td>
                                                    <div class="action-btn">
                                                        <button class="action-btn__link js-toggle" toggle-target="#edit-dialog-<?= $status_id ?>" style="--color:#5676ef;"><img src="./assets/icons/edit.svg" alt=""></button>
                                                        <!-- Modal: edit -->
                                                        <div class="modal hide" id="edit-dialog-<?= $status_id ?>">
                                                            <div class="modal__content">
                                                                <form action="" method="post">
                                                                    <div class="form__row" style="flex-direction: column; gap: 0;">
                                                                        <h3 class="cart-info__heading">Sửa Trạng thái</h3>
                                                                        <div class="form__group">
                                                                            <input hidden type="text" name="status_id" id="status_id" value="<?= $status_id ?>">
                                                                            <label for="status_name" style="text-align: left" class="form__label form-card__label">
                                                                                Trạng thái
                                                                            </label>
                                                                            <div class="form__text-input">
                                                                                <input type="text" name="status_name" id="status_name" class="form__input" value="<?= $status['status_name'] ?>" />
                                                                                <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="form__group">
                                                                            <label for="desc" style="text-align: left" class="form__label form-card__label">Mô tả</label>
                                                                            <div class="form__text-area">
                                                                                <textarea name="desc" id="desc" placeholder="Description" class="form__text-area-input"><?= $status['description'] ?></textarea>
                                                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal__bottom">
                                                                        <button class="btn btn--small btn--outline btn--text modal__btn js-toggle" toggle-target="#edit-dialog-<?= $status_id ?>">
                                                                            Hủy bỏ
                                                                        </button>
                                                                        <input type="submit" name="update" value="Cập nhật" class="btn btn--small btn--primary btn--no-margin modal__btn">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal__overlay js-toggle" toggle-target="#edit-dialog-<?= $status_id ?>"></div>
                                                        </div>

                                                        <button class="action-btn__link js-toggle" toggle-target="#del-dialog-<?= $status_id ?>" style="--color: #d50c0c;"><img src="./assets/icons/trash.svg" alt=""></button>
                                                        <!-- Modal: delete confirm -->
                                                        <div class="modal modal--small hide" id="del-dialog-<?= $status_id ?>">
                                                            <div class="modal__content">
                                                                <p class="modal__text" style="white-space: initial">Bạn có chắc muốn xóa trạng thái <?= $status_name ?> không?</p>
                                                                <div class="modal__bottom">
                                                                    <button class="btn btn--small btn--outline btn--text modal__btn js-toggle" toggle-target="#del-dialog-<?= $status_id ?>">
                                                                        Hủy bỏ
                                                                    </button>
                                                                    <a href="<?= $delete ?>" class="btn btn--danger btn--small btn--primary btn--no-margin modal__btn">
                                                                        Xóa
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="modal__overlay js-toggle" toggle-target="#del-dialog-<?= $status_id ?>"></div>
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
                    require_once './sidebar-admin-2.php';
                    ?>
                </div>
            </div>
        </div>
    </main>

    <script src="./assets/js/validator.js"></script>

    <script>
        Validator({
            form: '#form-6',
            formParent: '.form__group',
            errorSelector: '.form__error',
            rules: [
                Validator.isRequired('#status_name', 'Vui lòng nhập trạng thái'),
                Validator.isRequired('#desc', 'Nhập mô tả của trạng thái'),
            ],
        });
    </script>

<?php } else {
    header('location: ./index.php');
} ?>