<?php
if (isset($_POST['add']) && !empty($depart_id)) {
    $major_name = $_POST['major_name'];
    $major_code = $_POST['major_code'];
    $result = addMajor($major_name, $major_code, $depart_id);
    if ($result) {
        header('location: ./index.php?page=majors-manage&depart_id=' . $depart_id);
    } else {
        echo "Cannot add a new major!";
        die();
    }
}

if (!empty($_POST['update']) && !empty($depart_id)) {
    $major_name = $_POST['major_name'];
    $major_code = $_POST['major_code'];
    $major_id = $_POST['major_id'];
    $result = updateMajor($major_name, $major_code, $major_id);
    if ($result) {
        header('location: ./index.php?page=majors-manage&depart_id=' . $depart_id);
    } else {
        echo "Cannot modify this major!";
        die();
    }
}

if (!empty($_POST['filter'])) {
    $_SESSION['major-filter'] = $_POST;
}
if (!empty($_SESSION['major-filter'])) {
    $where = '';
    foreach ($_SESSION['major-filter'] as $field => $value) {
        if (!empty($value) && $field != 'filter') {
            switch ($field) {
                case 'major_code':
                    $where .= !empty($where) ? " AND $field LIKE '%$value%'" : "$field LIKE '%$value%'";
                    break;
                default:
                    $where .= !empty($where) ?  " AND $field = '$value'" : "$field = '$value'";
                    break;
            }
        }
    }
    extract($_SESSION['major-filter']);
    if (!empty($where)) {
        $query = "SELECT * FROM majors WHERE $where AND department_id = $depart_id";
        $majors = getMajorsByParam($query);
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
                            <div class="cart-info__row">
                                <button class="btn btn--primary btn--rounded js-toggle" toggle-target="#add-dialog">
                                    <img src="./assets/icons/plus.svg" alt="">
                                    Thêm Chuyên ngành
                                </button>
                                <div class="filter-wrap">
                                    <button class="filter-btn js-toggle" toggle-target="#home-filter">
                                        Bộ lọc
                                        <img src="./assets/icons/filter.svg" alt="" class="icon filter-btn__icon" />
                                    </button>
                                    <div id="home-filter" class="filter hide" style="left: 50%">
                                        <img src="./assets/icons/arrow-up.png" alt="" class="filter__arrow" />
                                        <h3 class="filter__heading">Bộ lọc</h3>
                                        <form action="" class="filter__form form" style="margin-top: 0" method="post">
                                            <div class="filter__content">
                                                <div class="row row-cols-2 gx-1">
                                                    <div class="col">
                                                        <div class="form__group">
                                                            <label for="major_code" style="text-align: left" class="form__label form-card__label">
                                                                Mã chuyên ngành
                                                            </label>
                                                            <div class="form__text-input form__text-input--small">
                                                                <input type="text" name="major_code" id="major_code" class="form__input" value="<?= !empty($major_code) ? $major_code : '' ?>" placeholder="VD: dpmc" />
                                                                <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form__group">
                                                            <label for="department_id" style="text-align: left" class="form__label form-card__label">
                                                                Tên chuyên ngành ngành
                                                            </label>
                                                            <div class="form__text-input form__text-input--small">
                                                                <?php $allMajor = getAllMajor($depart_id);
                                                                if (!empty($allMajor)) { ?>
                                                                    <select class="form__select form__select-lv2" name="id" id="major_id">
                                                                        <option value="">-- Chọn ngành --</option>
                                                                        <?php foreach ($allMajor as $major) { ?>
                                                                            <option value="<?= $major['id'] ?>"><?= $major['major_name'] ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                <?php } else { ?>
                                                                    <a href="?page=?page=majors-manage" class="btn btn--xsmall btn--danger">Không có CN!</a>
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
                            <!-- Modal: add -->
                            <div class="modal hide" id="add-dialog">
                                <div class="modal__content">
                                    <form action="" method="post" id="form-5">
                                        <div class="form__row" style="flex-direction: column; gap: 0;">
                                            <h3 class="cart-info__heading">Thêm chuyên ngành ngành</h3>
                                            <div class="form__group">
                                                <label for="major_name" style="text-align: left" class="form__label form-card__label">
                                                    Tên chuyên ngành
                                                </label>
                                                <div class="form__text-input">
                                                    <input type="text" name="major_name" id="major_name" class="form__input" />
                                                    <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                </div>
                                                <p class="form__error"></p>
                                            </div>

                                            <div class="form__group">
                                                <label for="major_code" style="text-align: left" class="form__label form-card__label">
                                                    Mã chuyên ngành
                                                </label>
                                                <div class="form__text-input">
                                                    <input type="text" name="major_code" id="major_code" class="form__input" placeholder="VD: mjc001" />
                                                    <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
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
                                    <th>Mã chuyên ngành</th>
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
                                            <td><?= $major_code ?></td>
                                            <td><?= $major_name ?></td>
                                            <td>
                                                <div class="action-btn">
                                                    <button class="action-btn__link js-toggle" toggle-target="#edit-dialog-<?= $id ?>" style="--color:#5676ef;"><img src="./assets/icons/edit.svg" alt=""></button>
                                                    <!-- Modal: edit -->
                                                    <div class="modal hide" id="edit-dialog-<?= $id ?>">
                                                        <div class="modal__content">
                                                            <form action="" method="post">
                                                                <div class="form__row" style="flex-direction: column; gap: 0;">
                                                                    <h3 class="cart-info__heading">Sửa chuyên ngành</h3>
                                                                    <div class="form__group">
                                                                        <input hidden type="text" name="depart_id" id="depart_id" value="<?= $id ?>">
                                                                        <label for="major_name" style="text-align: left" class="form__label form-card__label">
                                                                            Tên chuyên ngành
                                                                        </label>
                                                                        <div class="form__text-input">
                                                                            <input type="hidden" name="major_id" value="<?= $id ?>">
                                                                            <input type="text" name="major_name" id="major_name" class="form__input" value="<?= $major_name ?>" />
                                                                            <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="form__group">
                                                                        <label for="major_code" style="text-align: left" class="form__label form-card__label">
                                                                            Mã chuyên ngành
                                                                        </label>
                                                                        <div class="form__text-input">
                                                                            <input type="text" name="major_code" id="major_code" class="form__input" value="<?= $major_code ?>" />
                                                                            <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
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
                require_once './sidebar-admin-2.php';
                ?>
            </div>
        </div>
    </div>
</main>

<script src="./assets/js/validator.js"></script>

<script>
    Validator({
        form: '#form-5',
        formParent: '.form__group',
        errorSelector: '.form__error',
        rules: [
            Validator.isRequired('#major_name', 'Vui lòng nhập đúng tên chuyên ngành'),
            Validator.isRequired('#major_code', 'Nhập mã chuyên ngành'),
        ],
    });
</script>