<?php
if (!empty($_SESSION['role']) && $_SESSION['role'] == 1) {
    if (!empty($_POST['update'])) {
        $depart_name = $_POST['department_name'];
        $desc = $_POST['desc'];
        $depart_id = $_POST['depart_id'];
        $depart_code = $_POST['depart_code'];
        $result = updateDepartment($depart_name, $desc, $depart_code, $depart_id);
        if ($result) {
            header('location: ./index.php?page=department-manage');
        } else {
            echo 'Cannot modify department!';
            die();
        }
    }

    if (!empty($_POST['add'])) {
        $depart_name = $_POST['department_name'];
        $desc = $_POST['desc'];
        $depart_code = $_POST['depart_code'];
        $result = addDepartment($depart_name, $desc, $depart_code);
        if ($result) {
            header('location: ./index.php?page=department-manage');
        } else {
            echo 'Cannot add department!';
            die();
        }
    }

    if (!empty($_POST['filter'])) {
        $_SESSION['department-filter'] = $_POST;
    }
    if (!empty($_SESSION['department-filter'])) {
        $where = '';
        foreach ($_SESSION['department-filter'] as $field => $value) {
            if (!empty($value) && $field != 'filter') {
                switch ($field) {
                    case 'department_code':
                        $where .= !empty($where) ? " AND $field LIKE '%$value%'" : "$field LIKE '%$value%'";
                        break;
                    default:
                        $where .= !empty($where) ?  " AND $field = '$value'" : "$field = '$value'";
                        break;
                }
            }
        }
        extract($_SESSION['department-filter']);
        if (!empty($where)) {
            $query = "SELECT * FROM departments WHERE $where";
            $departments = getDepartmentsByParam($query);
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
                                <div class="cart-info__row">
                                    <button class="btn btn--primary btn--rounded js-toggle" toggle-target="#add-dialog">
                                        <img src="./assets/icons/plus.svg" alt="">
                                        Thêm ngành học
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
                                                                <label for="department_code" style="text-align: left" class="form__label form-card__label">
                                                                    Mã ngành
                                                                </label>
                                                                <div class="form__text-input form__text-input--small">
                                                                    <input type="text" name="department_code" id="department_code" class="form__input" value="<?= !empty($department_code) ? $department_code : '' ?>" placeholder="VD: dpmc" />
                                                                    <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form__group">
                                                                <label for="department_id" style="text-align: left" class="form__label form-card__label">
                                                                    Tên ngành
                                                                </label>
                                                                <div class="form__text-input form__text-input--small">
                                                                    <?php $allDepartment = getAllDepartment();
                                                                    if (!empty($allDepartment)) { ?>
                                                                        <select class="form__select form__select-lv2" name="id" id="department_id">
                                                                            <option value="">-- Chọn ngành --</option>
                                                                            <?php foreach ($allDepartment as $department) { ?>
                                                                                <option value="<?= $department['id'] ?>"><?= $department['department_name'] ?></option>
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
                                        <form action="" method="post" id="form-4">
                                            <div class="form__row" style="flex-direction: column; gap: 0;">
                                                <h3 class="cart-info__heading">Thêm ngành học</h3>
                                                <div class="form__group">
                                                    <label for="department_name" style="text-align: left" class="form__label form-card__label">
                                                        Tên ngành
                                                    </label>
                                                    <div class="form__text-input">
                                                        <input type="text" name="department_name" id="department_name" class="form__input" />
                                                        <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                    </div>
                                                    <p class="form__error"></p>
                                                </div>

                                                <div class="form__group">
                                                    <label for="depart_code" style="text-align: left" class="form__label form-card__label">
                                                        Mã ngành
                                                    </label>
                                                    <div class="form__text-input">
                                                        <input type="text" name="depart_code" id="depart_code" class="form__input" placeholder="VD: dpmc001" />
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
                                        <th>Mã ngành</th>
                                        <th>Tên ngành</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1;
                                    if (!empty($departments)) {
                                        foreach ($departments as $department) {
                                            extract($department);
                                            $info = '?page=majors-manage&depart_id=' . $id;
                                            $delete = '?page=delete-department&depart_id=' . $id; ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $department_code ?></td>
                                                <td><?= $department_name ?></td>
                                                <td>
                                                    <div class="action-btn">
                                                        <button class="action-btn__link js-toggle" toggle-target="#edit-dialog-<?= $id ?>" style="--color:#5676ef;"><img src="./assets/icons/edit.svg" alt=""></button>
                                                        <!-- Modal: edit -->
                                                        <div class="modal hide" id="edit-dialog-<?= $id ?>">
                                                            <div class="modal__content">
                                                                <form action="" method="post">
                                                                    <div class="form__row" style="flex-direction: column; gap: 0;">
                                                                        <h3 class="cart-info__heading">Sửa ngành học</h3>
                                                                        <div class="form__group">
                                                                            <input hidden type="text" name="depart_id" id="depart_id" value="<?= $id ?>">
                                                                            <label for="department_name" style="text-align: left" class="form__label form-card__label">
                                                                                Tên ngành
                                                                            </label>
                                                                            <div class="form__text-input">
                                                                                <input type="text" name="department_name" id="department_name" class="form__input" value="<?= $department['department_name'] ?>" />
                                                                                <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="form__group">
                                                                            <label for="depart_code" style="text-align: left" class="form__label form-card__label">
                                                                                Mã ngành
                                                                            </label>
                                                                            <div class="form__text-input">
                                                                                <input type="text" name="depart_code" id="depart_code" class="form__input" value="<?= $department_code ?>" />
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
                    require_once './sidebar-admin-2.php';
                    ?>
                </div>
            </div>
        </div>
    </main>

    <script src="./assets/js/validator.js"></script>

    <script>
        Validator({
            form: '#form-4',
            formParent: '.form__group',
            errorSelector: '.form__error',
            rules: [
                Validator.isRequired('#department_name', 'Vui lòng nhập đúng tên ngành'),
                Validator.isRequired('#depart_code', 'Nhập mã ngành'),
                Validator.isRequired('#desc', 'Nhập mô tả của ngành'),
            ],
        });
    </script>

<?php } else {
    header('location: ./index.php');
} ?>