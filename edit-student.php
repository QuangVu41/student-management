<?php
if (isset($_POST['save']) && $_POST['save']) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $class = $_POST['class_name'];
    $gender = $_POST['gender'];
    $major = $_POST['major'];
    $status_id = $_POST['status'];
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
        $update = updateStudentInfo($image, $name, $email, $phone, $date_of_birth, $address, $gender, $major, $student_id, $status_id);
        if ($update) {
            header('location: ./index.php?page=student-manage');
        } else {
            echo 'Lỗi cập nhật thông tin!';
            die();
        }
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
                                    Edit student information
                                </h2>
                                <form action="" class="form form-card" method="post" enctype="multipart/form-data">
                                    <!-- Form row 1 -->
                                    <div class="form__row">
                                        <div class="form__group" style="text-align: center;">
                                            <img src="<?= $student['image'] ?>" class="profile-user__avatar profile-user__avatar--square" alt="">
                                        </div>

                                        <div class="form__group">
                                            <label for="image" class="form__label form-card__label">
                                                Image
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
                                            <label for="full-name" class="form__label form-card__label">
                                                Full Name
                                            </label>
                                            <div class="form__text-input">
                                                <input type="text" name="name" id="full-name" placeholder="Full Name" class="form__input" value="<?= $student['student_name'] ?>" />
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                        </div>

                                        <div class="form__group">
                                            <label for="email-address" class="form__label form-card__label">
                                                Email Address
                                            </label>
                                            <div class="form__text-input">
                                                <input type="email" name="email" id="email-address" placeholder="Email Address" class="form__input" value="<?= $student['email'] ?>" />
                                                <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                        </div>

                                        <div class="form__group">
                                            <label for="phone-number" class="form__label form-card__label">
                                                Phone Number
                                            </label>
                                            <div class="form__text-input">
                                                <input type="tel" name="phone" id="phone-number" placeholder="Phone number" class="form__input" value="<?= $student['phonenumber'] ?>" />
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form row 3 -->
                                    <div class="form__row">
                                        <div class="form__group">
                                            <label for="date_of_birth" class="form__label form-card__label">
                                                Date of Birth
                                            </label>
                                            <div class="form__text-input">
                                                <input type="date" name="date_of_birth" id="date_of_birth" class="form__input" value="<?= $student['date_of_birth'] ?>" />
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                        </div>

                                        <div class="form__group">
                                            <label for="address" class="form__label form-card__label">
                                                Address
                                            </label>
                                            <div class="form__text-input">
                                                <input type="text" name="address" id="address" placeholder="Address" class="form__input" value="<?= $student['address'] ?>" />
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                        </div>

                                        <div class="form__group">
                                            <label for="class_name" class="form__label form-card__label">
                                                Class Name
                                            </label>
                                            <div class="form__text-input">
                                                <input type="text" name="class_name" id="class_name" class="form__input" value="<?= $student['class_id'] ?>" />
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form row 4 -->
                                    <div class="form__row">
                                    </div>

                                    <!-- Form row 5 -->
                                    <div class="form__row">
                                        <div class="form__group">
                                            <label for="gender" class="form__label form-card__label">
                                                Gender
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
                                        </div>

                                        <div class="form__group">
                                            <label for="major" class="form__label form-card__label">
                                                Major
                                            </label>
                                            <div class="form__text-input">
                                                <select class="form__select form__select-lv2" name="major" id="major">
                                                    <option value="<?= $major['id'] ?>"><?= $major['major_name'] ?></option>
                                                    <?php $majors = getAllMajor($major['department_id']);
                                                    foreach ($majors as $majoring) {
                                                        if ($majoring['major_name'] !== $major['major_name']) { ?>
                                                            <option value="<?= $majoring['id'] ?>"><?= $majoring['major_name'] ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form__group">
                                            <label for="major" class="form__label form-card__label">
                                                Status
                                            </label>
                                            <div class="form__text-input">
                                                <select class="form__select form__select-lv2" name="status" id="status">
                                                    <option value="<?= $status['status_id'] ?>"><?= $status['status_name'] ?></option>
                                                    <?php $allStatus = getAllStatus();
                                                    foreach ($allStatus as $st) {
                                                        if ($st['status_name'] !== $status['status_name']) { ?>
                                                            <option value="<?= $st['status_id'] ?>"><?= $st['status_name'] ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-card__bottom">
                                        <a href="./index.php?page=student-manage" class="btn btn--text">Cancel</a>
                                        <input type="submit" value="Save" name="save" class="btn btn--primary btn--rounded">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once './sidebar-user.php' ?>
            </div>
        </div>
    </div>
</main>