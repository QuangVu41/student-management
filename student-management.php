<?php
if (!empty($_SESSION['role']) && $_SESSION['role'] == 1) {
    if (!empty($_POST['filter'])) {
        $_SESSION['student-filter'] = $_POST;
    }
    if (!empty($_SESSION['student-filter'])) {
        $where = '';
        foreach ($_SESSION['student-filter'] as $field => $value) {
            if (!empty($value) && $field != 'filter') {
                switch ($field) {
                    case 'student_name':
                        $where .= !empty($where) ? " AND $field LIKE '%$value%'" : "$field LIKE '%$value%'";
                        break;
                    default:
                        $where .= !empty($where) ?  " AND $field = '$value'" : "$field = '$value'";
                        break;
                }
            }
        }
        extract($_SESSION['student-filter']);
        if (!empty($where)) {
            $totalRecords = getNumRow("SELECT student_id FROM student WHERE $where");
            $totalPages = ceil($totalRecords / $student_per_page);
            $query = "SELECT * FROM student WHERE $where LIMIT $student_per_page OFFSET $offset";
            $students = getAllStudent($query);
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
                                    <h2 class="cart-info__heading">Quản lý sinh viên</h2>
                                    <p class="cart-info__desc profile__desc">Sinh viên</p>
                                </div>
                                <div class="cart-info__row">
                                    <a href="?page=add-student" class="btn btn--primary btn--rounded">
                                        <img src="./assets/icons/plus.svg" alt="">
                                        Thêm sinh viên
                                    </a>
                                    <div class="filter-wrap">
                                        <button class="filter-btn js-toggle" toggle-target="#home-filter">
                                            Bộ lọc
                                            <img src="./assets/icons/filter.svg" alt="" class="icon filter-btn__icon" />
                                        </button>
                                        <div id="home-filter" class="filter hide">
                                            <img src="./assets/icons/arrow-up.png" alt="" class="filter__arrow" />
                                            <h3 class="filter__heading">Bộ lọc</h3>
                                            <form action="" class="filter__form form" style="margin-top: 0" method="post">
                                                <div class="filter__content">
                                                    <div class="row row-cols-6 gx-1">
                                                        <div class="col">
                                                            <div class="form__group">
                                                                <label for="student_id" style="text-align: left" class="form__label form-card__label">
                                                                    Mã sinh viên
                                                                </label>
                                                                <div class="form__text-input form__text-input--small">
                                                                    <input type="text" name="student_id" id="student_id" class="form__input" value="<?= !empty($student_id) ? $student_id : '' ?>" />
                                                                    <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form__group">
                                                                <label for="student_name" style="text-align: left" class="form__label form-card__label">
                                                                    Họ và tên
                                                                </label>
                                                                <div class="form__text-input form__text-input--small">
                                                                    <input type="text" name="student_name" id="student_name" class="form__input" value="<?= !empty($student_name) ? $student_name : '' ?>" />
                                                                    <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form__group">
                                                                <label for="gender" style="text-align: left" class="form__label form-card__label">
                                                                    Giới tính
                                                                </label>
                                                                <div class="form__text-input form__text-input--small">
                                                                    <select class="form__select form__select-lv2" name="gender" id="gender">
                                                                        <option value="">-- Chọn giới tính --</option>
                                                                        <option value="Nữ">Nữ</option>
                                                                        <option value="Nam">Nam</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form__group">
                                                                <label for="class_id" style="text-align: left" class="form__label form-card__label">
                                                                    Lớp
                                                                </label>
                                                                <div class="form__text-input form__text-input--small">
                                                                    <?php $classes = getAllClass();
                                                                    if (!empty($classes)) { ?>
                                                                        <select class="form__select form__select-lv2" name="class_id" id="class_id">
                                                                            <option value="">-- Chọn lớp --</option>
                                                                            <?php foreach ($classes as $class) { ?>
                                                                                <option value="<?= $class['class_id'] ?>"><?= $class['class_name'] ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    <?php } else { ?>
                                                                        <a href="?page=index.php" class="btn btn--xsmall btn--danger">Không có lớp!</a>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form__group">
                                                                <label for="major_id" style="text-align: left" class="form__label form-card__label">
                                                                    Chuyên ngành
                                                                </label>
                                                                <div class="form__text-input form__text-input--small">
                                                                    <?php $majors = getMajors();
                                                                    if (!empty($majors)) { ?>
                                                                        <select class="form__select form__select-lv2" name="major_id" id="major_id">
                                                                            <option value="">-- Chọn chuyên ngành --</option>
                                                                            <?php foreach ($majors as $majoring) { ?>
                                                                                <option value="<?= $majoring['id'] ?>"><?= $majoring['major_name'] ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    <?php } else { ?>
                                                                        <a href="?page=department-manage" class="btn btn--xsmall btn--danger">Không có CN!</a>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form__group">
                                                                <label for="status_id" style="text-align: left" class="form__label form-card__label">
                                                                    Trạng thái
                                                                </label>
                                                                <div class="form__text-input form__text-input--small">
                                                                    <?php $allStatus = getAllStatus();
                                                                    if (!empty($allStatus)) { ?>
                                                                        <select class="form__select form__select-lv2" name="status_id" id="status_id">
                                                                            <option value="">-- Chọn trạng thái --</option>
                                                                            <?php foreach ($allStatus as $st) { ?>
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
                                    if (!empty($students)) {
                                        $i = 1;
                                        foreach ($students as $student) {
                                            extract($student);
                                            $edit = '?page=edit-student&id=' . $student_id;
                                            $delete = '?page=delete-student&id=' . $student_id;
                                            $class = !empty($class_id) ? getStudentClass($class_id) : false;
                                            $major = !empty($major_id) ? getStudentMajor($major_id) : false;
                                            $status = !empty($status_id) ? getStudentStatus($status_id) : false;
                                            $depart = !empty($department_id) ? getStudentDepartment($department_id) : false; ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $student_id ?></td>
                                                <td><img src="<?= $image ?>" alt=""></td>
                                                <td><?= $student_name ?></td>
                                                <td><?= $gender ?></td>
                                                <td <?= !empty($class) ? '' : ' style="color: #ed4337"' ?>><?= !empty($class) ? $class['class_name'] : 'Lớp đã bị xóa!' ?></td>
                                                <td <?= !empty($major) ? '' : ' style="color: #ed4337"' ?>><?= !empty($major) ? $major['major_name'] : 'Chuyên ngành đã bị xóa!' ?></td>
                                                <td <?= !empty($status) ? '' : ' style="color: #ed4337"' ?>><?= !empty($status) ? $status['status_name'] : 'Trạng thái đã bị xóa!' ?></td>
                                                <td>
                                                    <div class="action-btn">
                                                        <button class="action-btn__link js-toggle" toggle-target="#view-dialog-<?= $student_id ?>" style="--color:#ffb700;"><img src="./assets/icons/eye.svg" alt=""></button>
                                                        <!-- Modal: view -->
                                                        <div class="modal modal--large hide" id="view-dialog-<?= $student_id ?>">
                                                            <div class="modal__content">
                                                                <div class="modal__top">
                                                                    <h3 style="text-align: left; margin-bottom: 12px;" class="cart-info__heading">Thông tin sinh viên</h3>
                                                                </div>
                                                                <div class="modal__body">
                                                                    <div class="row ">
                                                                        <div class="col-3">
                                                                            <img src="<?= $image ?>" class="modal__img profile-user__avatar profile-user__avatar--square" alt="">
                                                                        </div>
                                                                        <div class="col-9">
                                                                            <div class="row gy-2">
                                                                                <!-- Account Info -->
                                                                                <div class="col-12">
                                                                                    <div class="account__heading account__heading--lv2">
                                                                                        <h2 class="cart-info__heading cart-info__heading--lv2">Thông tin sinh viên</h2>
                                                                                    </div>
                                                                                    <div class="row row-cols-1">
                                                                                        <div class="col">
                                                                                            <div class="row">
                                                                                                <div class="col-4">
                                                                                                    <p class="account__info">Mã SV</p>
                                                                                                </div>
                                                                                                <div class="col-8">
                                                                                                    <p class="account__info"><?= $student_id ?></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div class="row">
                                                                                                <div class="col-4">
                                                                                                    <p class="account__info">Họ và tên</p>
                                                                                                </div>
                                                                                                <div class="col-8">
                                                                                                    <p class="account__info"><?= $student_name ?></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div class="row">
                                                                                                <div class="col-4">
                                                                                                    <p class="account__info">Ngày sinh</p>
                                                                                                </div>
                                                                                                <div class="col-8">
                                                                                                    <p class="account__info"><?= $date_of_birth ?></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div class="row">
                                                                                                <div class="col-4">
                                                                                                    <p class="account__info">Giới tính</p>
                                                                                                </div>
                                                                                                <div class="col-8">
                                                                                                    <p class="account__info"><?= $gender ?></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div class="row">
                                                                                                <div class="col-4">
                                                                                                    <p class="account__info">Trạng thái</p>
                                                                                                </div>
                                                                                                <div class="col-8">
                                                                                                    <p class="account__info" <?= !empty($status['status_name']) ? '' : ' style="color: #ed4337"' ?>><?= !empty($status['status_name']) ? $status['status_name'] : 'Trạng thái đã bị xóa' ?></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div class="row">
                                                                                                <div class="col-4">
                                                                                                    <p class="account__info">Địa chỉ email</p>
                                                                                                </div>
                                                                                                <div class="col-8">
                                                                                                    <p class="account__info"><?= $email ?></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div class="row">
                                                                                                <div class="col-4">
                                                                                                    <p class="account__info">Địa chỉ nhà riêng</p>
                                                                                                </div>
                                                                                                <div class="col-8">
                                                                                                    <p class="account__info"><?= $address ?></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- Course Info -->
                                                                                <div class="col-12">
                                                                                    <div class="account__heading account__heading--lv2">
                                                                                        <h2 class="cart-info__heading cart-info__heading--lv2">Thông tin khóa học</h2>
                                                                                    </div>
                                                                                    <div class="row row-cols-1">
                                                                                        <div class="col">
                                                                                            <div class="row">
                                                                                                <div class="col-4">
                                                                                                    <p class="account__info">Tên lớp</p>
                                                                                                </div>
                                                                                                <div class="col-8">
                                                                                                    <p class="account__info" <?= !empty($class['class_name']) ? '' : ' style="color: #ed4337"' ?>><?= !empty($class['class_name']) ? $class['class_name'] : 'Lớp đã bị xóa!' ?></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div class="row">
                                                                                                <div class="col-4">
                                                                                                    <p class="account__info">Ngành</p>
                                                                                                </div>
                                                                                                <div class="col-8">
                                                                                                    <p class="account__info" <?= !empty($depart['department_name']) ? '' : ' style="color: #ed4337"' ?>><?= !empty($depart['department_name']) ? $depart['department_name'] : 'Ngành đã bị xóa!' ?></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div class="row">
                                                                                                <div class="col-4">
                                                                                                    <p class="account__info">Chuyên Ngành</p>
                                                                                                </div>
                                                                                                <div class="col-8">
                                                                                                    <p class="account__info" <?= !empty($major['major_name']) ? '' : ' style="color: #ed4337"' ?>><?= !empty($major['major_name']) ? $major['major_name'] : 'Chuyên ngành đã bị xóa!' ?></p>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal__bottom">
                                                                    <button class="btn btn--small btn--outline btn--text modal__btn js-toggle" toggle-target="#view-dialog-<?= $student_id ?>">
                                                                        Thoát
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div class="modal__overlay js-toggle" toggle-target="#view-dialog-<?= $student_id ?>"></div>
                                                        </div>

                                                        <a href="<?= $edit ?>" class="action-btn__link" style="--color:#5676ef;"><img src="./assets/icons/edit.svg" alt=""></a>

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
                                        }
                                    } ?>
                                </tbody>
                            </table>
                            <div class="pagination">
                                <?php
                                if ($current_page > 1) {
                                    $prev_page = $current_page - 1;
                                ?>
                                    <a href="?page=student-manage&page_num=<?= $prev_page ?>" class="pagination__link">&laquo;</a>
                                <?php } ?>
                                <?php
                                for ($num = 1; $num <= $totalPages; $num++) {
                                ?>
                                    <?php if ($num != $current_page) { ?>
                                        <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                                            <a href="?page=student-manage&page_num=<?= $num ?>" class="pagination__link"><?= $num ?></a>
                                        <?php } ?>
                                    <?php } else { ?>
                                        <span class="pagination__link active"><?= $num ?></span>
                                    <?php } ?>
                                <?php } ?>
                                <?php
                                if ($current_page < $totalPages) {
                                    $next_page = $current_page + 1;
                                ?>
                                    <a href="?page=student-manage&page_num=<?= $next_page ?>" class="pagination__link">&raquo;</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    require_once './sidebar-admin-2.php';
                    ?>
                </div>
            </div>
        </div>
    </main>
<?php } else {
    header('location: ./index.php');
} ?>