<?php
if (!empty($_SESSION['role']) && $_SESSION['role'] == 1) {
    if (isset($_POST['add']) && $_POST['add']) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $date_of_birth = $_POST['date_of_birth'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $department = $_POST['department_id'];
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
            $result = insertStudent($image, $name, $email, $phone, $date_of_birth, $address, $class_id, $gender, $status_id, $department);
            if ($result) {
                $student_id = $result;
                header('location: ./index.php?page=update-student-major&id=' . $student_id);
            } else {
                echo "Cannot insert student!";
                die();
            }
        }
    }

    if (!empty($_POST['add-department'])) {
        $depart_name = $_POST['department_name'];
        $desc = $_POST['desc'];
        $depart_code = $_POST['depart_code'];
        $result = addDepartment($depart_name, $desc, $depart_code);
        if ($result) {
            header('location: ./index.php?page=add-student');
        } else {
            echo 'Cannot add department!';
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
                                        Thêm sinh viên
                                    </h2>
                                    <form action="" class="form form-card" id="form-3" method="post" enctype="multipart/form-data">
                                        <!-- Form row 1 -->
                                        <div class="form__row">
                                            <div class="form__group">
                                                <label for="image" class="form__label form-card__label">
                                                    Ảnh
                                                </label>
                                                <div class="form__text-input">
                                                    <input type="file" name="image" id="image" class="form__input" />
                                                    <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                </div>
                                                <p class="form__error"></p>
                                            </div>
                                        </div>

                                        <!-- Form row 2 -->
                                        <div class="form__row">
                                            <div class="form__group">
                                                <label for="full-name" class="form__label form-card__label">
                                                    Họ và tên
                                                </label>
                                                <div class="form__text-input">
                                                    <input type="text" name="name" id="name" placeholder="Full Name" class="form__input" />
                                                    <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                </div>
                                                <p class="form__error"></p>
                                            </div>

                                            <div class="form__group">
                                                <label for="email-address" class="form__label form-card__label">
                                                    Email
                                                </label>
                                                <div class="form__text-input">
                                                    <input type="email" name="email" id="email" placeholder="Email Address" class="form__input" />
                                                    <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                </div>
                                                <p class="form__error"></p>
                                            </div>

                                            <div class="form__group">
                                                <label for="phone-number" class="form__label form-card__label">
                                                    Số điện thoại
                                                </label>
                                                <div class="form__text-input">
                                                    <input type="tel" name="phone" id="phone" placeholder="Phone number" class="form__input" maxlength="10" />
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
                                                    <input type="date" name="date_of_birth" id="date_of_birth" class="form__input" />
                                                    <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                </div>
                                                <p class="form__error"></p>
                                            </div>

                                            <div class="form__group">
                                                <label for="address" class="form__label form-card__label">
                                                    Địa chỉ
                                                </label>
                                                <div class="form__text-input">
                                                    <input type="text" name="address" id="address" placeholder="Address" class="form__input" />
                                                    <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                </div>
                                                <p class="form__error"></p>
                                            </div>

                                            <div class="form__group">
                                                <label for="class_name" class="form__label form-card__label">
                                                    Tên lớp
                                                </label>
                                                <div class="form__text-input">
                                                    <?php if (!empty($allClass)) { ?>
                                                        <select class="form__select form__select-lv2" name="class_id" id="class_id">
                                                            <option value="" disabled selected>-- Chọn lớp --</option>
                                                            <?php foreach ($allClass as $class) {
                                                                extract($class) ?>
                                                                <option value="<?= $class_id ?>"><?= $class_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } else { ?>
                                                        <a href="?page=index.php" class="btn btn--small btn--danger">Không có lớp để chọn!</a>
                                                    <?php } ?>
                                                </div>
                                                <p class="form__error"></p>
                                            </div>
                                        </div>

                                        <!-- Form row 4 -->
                                        <div class="form__row">
                                            <div class="form__group">
                                                <label for="gender" class="form__label form-card__label">
                                                    Giới tính
                                                </label>
                                                <div class="form__text-input">
                                                    <select class="form__select form__select-lv2" name="gender" id="gender">
                                                        <option value="" disabled selected>-- Chọn giới tính --</option>
                                                        <option value="Nam">Nam</option>
                                                        <option value="Nữ">Nữ</option>
                                                    </select>
                                                </div>
                                                <p class="form__error"></p>
                                            </div>

                                            <div class="form__group">
                                                <label for="major" class="form__label form-card__label">
                                                    Ngành học
                                                </label>
                                                <div class="form__text-input">
                                                    <?php if (!empty($allDepartment)) { ?>
                                                        <select class="form__select form__select-lv2" name="department_id" id="department_id">
                                                            <option value="" disabled selected>-- Chọn ngành học --</option>
                                                            <?php foreach ($allDepartment as $department) {
                                                                extract($department) ?>
                                                                <option value="<?= $id ?>"><?= $department_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } else { ?>
                                                        <button class="btn btn--danger btn--small js-toggle" toggle-target="#add-dialog">Ngành đã bị xóa, nhấn để thêm</button>
                                                    <?php } ?>
                                                </div>
                                                <p class="form__error"></p>
                                            </div>

                                            <div class="form__group">
                                                <label for="major" class="form__label form-card__label">
                                                    Trạng thái
                                                </label>
                                                <div class="form__text-input">
                                                    <?php if (!empty($allStatus)) { ?>
                                                        <select class="form__select form__select-lv2" name="status_id" id="status_id">
                                                            <option value="" disabled selected>-- Chọn trạng thái --</option>
                                                            <?php foreach ($allStatus as $status) {
                                                                extract($status) ?>
                                                                <option value="<?= $status_id ?>"><?= $status_name ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } else { ?>
                                                        <a href="?page=status-manage" class="btn btn--danger btn--small">Không có trạng thái để chọn!</a>
                                                    <?php } ?>
                                                </div>
                                                <p class="form__error"></p>
                                            </div>
                                        </div>

                                        <div class="form-card__bottom">
                                            <a href="./index.php?page=student-manage" class="btn btn--text">Hủy</a>
                                            <input type="submit" value="Thêm" name="add" class="btn btn--primary btn--rounded">
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
    </main>

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
                    <input type="submit" name="add-department" value="Thêm" class="btn btn--small btn--primary btn--no-margin modal__btn">
                </div>
            </form>
        </div>
        <div class="modal__overlay js-toggle" toggle-target="#add-dialog"></div>
    </div>

    <script src="./assets/js/validator.js"></script>

    <script>
        Validator({
            form: '#form-3',
            formParent: '.form__group',
            errorSelector: '.form__error',
            rules: [
                Validator.isRequired('#image', 'Vui lòng chọn ảnh'),
                Validator.isRequired('#name', 'Nhập cả họ và tên'),
                Validator.isEmail('#email', 'Vui lòng nhập đúng định email'),
                Validator.isPhoneNumber('#phone', 'Vui lòng nhập đúng số điện thoại'),
                Validator.isRequired('#date_of_birth', 'Vui lòng chọn ngày sinh'),
                Validator.isRequired('#class_id', 'Vui lòng chọn lớp'),
                Validator.isRequired('#address', 'Vui lòng nhập địa chỉ'),
                Validator.isRequired('#gender', 'Vui lòng chọn giới tính'),
                Validator.isRequired('#department_id', 'Vui lòng chọn ngành'),
                Validator.isRequired('#status_id', 'Vui lòng chọn trạng thái'),
            ],
        });
    </script>
<?php } else {
    header('location: ./index.php');
} ?>