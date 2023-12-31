<?php
if (isset($_POST['save']) && $_POST['save']) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $major = $_POST['major_id'];
    $status_id = $_POST['status_id'];
    $class_id = $_POST['class_id'];
    if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
        $uploadFile = $_FILES['image'];
        $result = uploadFiles($uploadFile);
        if (!empty($result['error'])) {
            $error = $result['error'];
        } else {
            $image = $result['path'];
        }
    } else {
        $image = '';
    }
    if (!isset($error)) {
        $update = updateStudentInfo($image, $name, $email, $phone, $date_of_birth, $address, $class_id, $gender, $major, $student_id, $status_id);
        if ($update) {
            header('location: ./index.php?page=student-manage');
        } else {
            echo 'Lỗi cập nhật thông tin!';
            die();
        }
    }
}

if (isset($_POST['reselect']) && $_POST['reselect']) {
    $depart_id = $_POST['depart_id'];
    $result = updateStudentDepart($depart_id, $student_id);
    if ($result) {
        header('location: ./index.php?page=edit-student&id=' . $student_id);
    } else {
        echo 'Cannot update student department!';
        die();
    }
}

if (isset($_POST['add']) && $_POST['add']) {
    $depart_id = $_POST['depart_id'];
    $major_name = $_POST['major_name'];
    $major_code = $_POST['major_code'];
    $result = addMajor($major_name, $major_code, $depart_id);
    if ($result) {
        header('location: ./index.php?page=edit-student&id=' . $student_id);
    } else {
        echo 'Cannot add student major!';
        die();
    }
}

if (!empty($_POST['add-status'])) {
    $status_name = $_POST['status_name'];
    $desc = $_POST['desc'];
    $result = addStatus($status_name, $desc);
    if ($result) {
        header('location: index.php?page=edit-student&id=' . $student_id);
    } else {
        echo 'Cannot add status!';
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

        <!-- Profile content -->
        <div class="profile-container">
            <div class="row gy-md-3">
                <div class="col-9 col-xl-8 col-lg-12">
                    <div class="cart-info">
                        <div class="row gy-3">
                            <div class="col-12">
                                <h2 class="cart-info__heading">
                                    <a href="./index.php?page=student-manage">
                                        <img src="./assets/icons/arrow-left.svg" alt="" class="icon cart-info__back-arrow" />
                                    </a>
                                    Chỉnh sửa thông tin sinh viên
                                </h2>
                                <form action="" class="form form-card" id="form-8" method="post" enctype="multipart/form-data">
                                    <!-- Form row 1 -->
                                    <div class="form__row">
                                        <div class="form__group" style="text-align: center;">
                                            <img src="<?= $student['image'] ?>" class="profile-user__avatar profile-user__avatar--square" alt="">
                                        </div>

                                        <div class="form__group">
                                            <label for="image" class="form__label form-card__label">
                                                Ảnh
                                            </label>
                                            <div class="form__text-input">
                                                <input type="file" name="image" id="image" class="form__input" />
                                                <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form row 2 -->
                                    <div class="form__row">
                                        <div class="form__group">
                                            <label for="name" class="form__label form-card__label">
                                                Họ và tên
                                            </label>
                                            <div class="form__text-input">
                                                <input type="text" name="name" id="name" placeholder="Full Name" class="form__input" value="<?= $student['student_name'] ?>" />
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                            <p class="form__error"></p>
                                        </div>

                                        <div class="form__group">
                                            <label for="address" class="form__label form-card__label">
                                                Email
                                            </label>
                                            <div class="form__text-input">
                                                <input type="email" name="email" id="email" placeholder="Email Address" class="form__input" value="<?= $student['email'] ?>" />
                                                <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                            <p class="form__error"></p>
                                        </div>

                                        <div class="form__group">
                                            <label for="phone-number" class="form__label form-card__label">
                                                Số điện thoại
                                            </label>
                                            <div class="form__text-input">
                                                <input type="tel" name="phone" id="phone" placeholder="Phone number" class="form__input" maxlength="10" value="<?= $student['phonenumber'] ?>" />
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                            <p class="form__error"></p>
                                        </div>
                                    </div>

                                    <!-- Form row 3 -->
                                    <div class="form__row">
                                        <div class="form__group">
                                            <label for="date_of_birth" class="form__label form-card__label">
                                                Ngày sinh
                                            </label>
                                            <div class="form__text-input">
                                                <input type="date" name="date_of_birth" id="date_of_birth" class="form__input" value="<?= $student['date_of_birth'] ?>" />
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                            <p class="form__error"></p>
                                        </div>

                                        <div class="form__group">
                                            <label for="address" class="form__label form-card__label">
                                                Địa chỉ
                                            </label>
                                            <div class="form__text-input">
                                                <input type="text" name="address" id="address" placeholder="Address" class="form__input" value="<?= $student['address'] ?>" />
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                            <p class="form__error"></p>
                                        </div>

                                        <div class="form__group">
                                            <label for="class_name" class="form__label form-card__label">
                                                Tên lớp
                                            </label>
                                            <div class="form__text-input">
                                                <?php if (!empty($studentClass)) { ?>
                                                    <select class="form__select form__select-lv2" name="class_id" id="class_id">
                                                        <option value="<?= $studentClass['class_id'] ?>"><?= $studentClass['class_name'] ?></option>
                                                        <?php $allClass = getAllClass();
                                                        foreach ($allClass as $class) {
                                                            if ($studentClass['class_name'] !== $class['class_name']) { ?>
                                                                <option value="<?= $class['class_id'] ?>"><?= $class['class_name'] ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                <?php } else { ?>
                                                    <?php $allClass = getAllClass();
                                                    if (!empty($allClass)) { ?>
                                                        <select class="form__select form__select-lv2" name="class_id" id="class_id">
                                                            <?php foreach ($allClass as $class) { ?>
                                                                <option value="<?= $class['class_id'] ?>"><?= $class['class_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } else { ?>
                                                        <a href="?page=#!" class="btn btn--primary btn--small">Lớp đã bị xóa nhấn vào để thêm</a>
                                                <?php }
                                                } ?>
                                            </div>
                                            <p class="form__error"></p>
                                        </div>
                                    </div>

                                    <!-- Form row 5 -->
                                    <div class="form__row">
                                        <div class="form__group">
                                            <label for="gender" class="form__label form-card__label">
                                                Giới tính
                                            </label>
                                            <div class="form__text-input">
                                                <select class="form__select form__select-lv2" name="gender" id="gender">
                                                    <option value="<?= $student['gender'] ?>"><?= $student['gender'] ?></option>
                                                    <?php if ($student['gender'] == 'Nam') { ?>
                                                        <option value="Nữ">Nữ</option>
                                                    <?php } else { ?>
                                                        <option value="Nam">Nam</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <p class="form__error"></p>
                                        </div>

                                        <div class="form__group">
                                            <label for="major" class="form__label form-card__label">
                                                Chuyên ngành
                                            </label>
                                            <div class="form__text-input">
                                                <?php if (!empty($major)) { ?>
                                                    <select class="form__select form__select-lv2" name="major_id" id="major_id">
                                                        <option value="<?= $major['id'] ?>"><?= $major['major_name'] ?></option>
                                                        <?php $majors = getAllMajor($major['department_id']);
                                                        foreach ($majors as $majoring) {
                                                            if ($majoring['major_name'] !== $major['major_name']) { ?>
                                                                <option value="<?= $majoring['id'] ?>"><?= $majoring['major_name'] ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                    <?php } else if (!empty($depart_id)) {
                                                    $majors  = getAllMajor($depart_id);
                                                    if (!empty($majors)) { ?>
                                                        <select class="form__select form__select-lv2" name="major_id" id="major_id">
                                                            <?php foreach ($majors as $major) { ?>
                                                                <option value="<?= $major['id'] ?>"><?= $major['major_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } else { ?>
                                                        <button class="btn btn--primary btn--small js-toggle" toggle-target="#add-dialog">Chưa có chuyên ngành nhấn vào để thêm</button>
                                                    <?php }
                                                } else { ?>
                                                    <button class="btn btn--danger btn--small js-toggle" toggle-target="#reselect-dialog">Ngành đã bị xóa, nhấn để chọn lại ngành</button>
                                                <?php } ?>
                                            </div>
                                            <p class="form__error"></p>
                                        </div>

                                        <div class="form__group">
                                            <label for="major" class="form__label form-card__label">
                                                Trạng thái
                                            </label>
                                            <div class="form__text-input">
                                                <?php if (!empty($status)) { ?>
                                                    <select class="form__select form__select-lv2" name="status_id" id="status_id">
                                                        <option value="<?= $status['status_id'] ?>"><?= $status['status_name'] ?></option>
                                                        <?php $allStatus = getAllStatus();
                                                        foreach ($allStatus as $st) {
                                                            if ($st['status_name'] !== $status['status_name']) { ?>
                                                                <option value="<?= $st['status_id'] ?>"><?= $st['status_name'] ?></option>
                                                        <?php }
                                                        } ?>
                                                    </select>
                                                <?php } else { ?>
                                                    <?php $allStatus = getAllStatus();
                                                    if (!empty($allStatus)) { ?>
                                                        <select class="form__select form__select-lv2" name="status_id" id="status_id">
                                                            <?php foreach ($allStatus as $st) { ?>
                                                                <option value="<?= $st['status_id'] ?>"><?= $st['status_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } else { ?>
                                                        <button class="btn btn--primary btn--small js-toggle" toggle-target="#add-status-dialog">Chưa có trạng thái nhấn vào để thêm</button>
                                                <?php }
                                                } ?>
                                            </div>
                                            <p class="form__error"></p>
                                        </div>
                                    </div>

                                    <div class="form-card__bottom">
                                        <a href="./index.php?page=student-manage" class="btn btn--text">Hủy</a>
                                        <input type="submit" value="Lưu" name="save" class="btn btn--primary btn--rounded">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once './sidebar-admin-2.php' ?>
            </div>
        </div>
    </div>

    <!-- Modal: reselect  -->
    <div class="modal modal--medium hide" id="reselect-dialog">
        <div class="modal__content">
            <form action="" method="post">
                <div class="modal__inline">
                    <h3 style="text-align: left; margin-bottom: 12px;" class="cart-info__heading">Chọn lại ngành học</h3>
                    <a href="?page=department-manage" class="btn btn--small btn--primary modal__link">
                        Thêm ngành học
                        <img src="./assets/icons/arrow-right.svg" style="filter: brightness(0) saturate(100%) invert(0%) sepia(0%) saturate(0%) hue-rotate(324deg) brightness(96%) contrast(104%);" alt="">
                    </a>
                </div>
                <div class="form__text-input">
                    <?php $departments = getAllDepartment();
                    if (!empty($departments)) { ?>
                        <select class="form__select form__select-lv2" name="depart_id" id="depart">
                            <?php foreach ($departments as $department) {
                                extract($department) ?>
                                <option value="<?= $id ?>"><?= $department_name ?></option>
                            <?php } ?>
                        </select>
                    <?php } else { ?>
                        <span style="color: #ed4337">Ngành học đã bị xóa hết! Nhấn nút bên trên để thêm</span>
                    <?php } ?>
                </div>
                <div class="modal__bottom">
                    <button class="btn btn--small btn--outline btn--text modal__btn js-toggle" toggle-target="#reselect-dialog">
                        Hủy bỏ
                    </button>
                    <input type="submit" name="reselect" value="Lưu" class="btn btn--primary btn--small btn--primary btn--no-margin modal__btn">
                </div>
            </form>
        </div>
        <div class="modal__overlay js-toggle" toggle-target="#reselect-dialog"></div>
    </div>

    <!-- Modal: add  -->
    <div class="modal modal--medium hide" id="add-dialog">
        <div class="modal__content">
            <form action="" method="post">
                <div class="modal__inline">
                    <h3 style="text-align: left; margin-bottom: 12px;" class="cart-info__heading">Thêm chuyên ngành</h3>
                </div>
                <div class="form__group">
                    <label for="major_code" style="text-align: left" class="form__label form-card__label">
                        Tên chuyên ngành
                    </label>
                    <div class="form__text-input">
                        <input type="hidden" name="depart_id" value="<?= $depart_id  ?>">
                        <input type="text" name="major_name" id="major_name" class="form__input" value="" />
                        <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                    </div>
                </div>
                <div class="form__group">
                    <label for="major_code" style="text-align: left" class="form__label form-card__label">
                        Mã chuyên ngành
                    </label>
                    <div class="form__text-input">
                        <input type="text" name="major_code" id="major_code" class="form__input" value="" />
                        <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                    </div>
                </div>
                <div class="modal__bottom">
                    <button class="btn btn--small btn--outline btn--text modal__btn js-toggle" toggle-target="#add-dialog">
                        Hủy bỏ
                    </button>
                    <input type="submit" name="add" value="Thêm" class="btn btn--primary btn--small btn--primary btn--no-margin modal__btn">
                </div>
            </form>
        </div>
        <div class="modal__overlay js-toggle" toggle-target="#add-dialog"></div>
    </div>

    <div class="modal modal--medium hide" id="add-status-dialog">
        <div class="modal__content">
            <form action="" method="post">
                <div class="modal__inline">
                    <h3 style="text-align: left; margin-bottom: 12px;" class="cart-info__heading">Thêm trạng thái</h3>
                </div>
                <div class="form__group">
                    <label for="status_name" class="form__label form-card__label">
                        Trạng thái
                    </label>
                    <div class="form__text-input">
                        <input type="text" name="status_name" id="status_name" class="form__input" placeholder="Trạng thái" />
                        <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                    </div>
                </div>

                <div class="form__group">
                    <label for="desc" class="form__label form-card__label">
                        Mô tả
                    </label>
                    <div class="form__text-area">
                        <textarea name="desc" id="desc" placeholder="Description" class="form__text-area-input"></textarea>
                        <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                    </div>
                    <p class="form__error"></p>
                </div>

                <div class="modal__bottom">
                    <button class="btn btn--small btn--outline btn--text modal__btn js-toggle" toggle-target="#add-status-dialog">
                        Hủy bỏ
                    </button>
                    <input type="submit" name="add-status" value="Thêm" class="btn btn--primary btn--small btn--primary btn--no-margin modal__btn">
                </div>
            </form>
        </div>
        <div class="modal__overlay js-toggle" toggle-target="#add-status-dialog"></div>
    </div>
</main>

<script src="./assets/js/validator.js"></script>

<script>
    Validator({
        form: '#form-8',
        formParent: '.form__group',
        errorSelector: '.form__error',
        rules: [
            Validator.isRequired('#name', 'Nhập cả họ và tên'),
            Validator.isEmail('#email', 'Vui lòng nhập đúng định email'),
            Validator.isPhoneNumber('#phone', 'Vui lòng nhập đúng số điện thoại'),
            Validator.isRequired('#date_of_birth', 'Vui lòng chọn ngày sinh'),
            Validator.isRequired('#class_id', 'Vui lòng chọn lớp'),
            Validator.isRequired('#address', 'Vui lòng nhập địa chỉ'),
            Validator.isRequired('#gender', 'Vui lòng chọn giới tính'),
            Validator.isRequired('#status_id', 'Vui lòng chọn trạng thái'),
            Validator.isRequired('#major_id', 'Vui lòng chọn chuyên thái'),
        ],
    });
</script>