<?php
if (isset($_POST['add']) && $_POST['add']) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $status_id = $_POST['status_id'];
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
        $result = insertStudent($image, $name, $email, $phone, $date_of_birth, $address, $gender, $status_id);
        if ($result) {
            $student_id = $result;
            header('location: ./index.php?page=update-student-major&id=' . $student_id . '&department_id=' . $department);
        } else {
            echo "Cannot insert student!";
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
                                    Add student
                                </h2>
                                <form action="" class="form form-card" method="post" enctype="multipart/form-data">
                                    <!-- Form row 1 -->
                                    <div class="form__row">
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
                                                <input type="text" name="name" id="full-name" placeholder="Full Name" class="form__input" />
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                        </div>

                                        <div class="form__group">
                                            <label for="email-address" class="form__label form-card__label">
                                                Email Address
                                            </label>
                                            <div class="form__text-input">
                                                <input type="email" name="email" id="email-address" placeholder="Email Address" class="form__input" />
                                                <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                        </div>

                                        <div class="form__group">
                                            <label for="phone-number" class="form__label form-card__label">
                                                Phone Number
                                            </label>
                                            <div class="form__text-input">
                                                <input type="tel" name="phone" id="phone-number" placeholder="Phone number" class="form__input" />
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
                                                <input type="date" name="date_of_birth" id="date_of_birth" class="form__input" />
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                        </div>

                                        <div class="form__group">
                                            <label for="address" class="form__label form-card__label">
                                                Address
                                            </label>
                                            <div class="form__text-input">
                                                <input type="text" name="address" id="address" placeholder="Address" class="form__input" />
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                        </div>

                                        <div class="form__group">
                                            <label for="class_name" class="form__label form-card__label">
                                                Class Name
                                            </label>
                                            <div class="form__text-input">
                                                <input type="text" name="class_name" id="class_name" class="form__input" />
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Form row 4 -->
                                    <div class="form__row">
                                        <div class="form__group">
                                            <label for="gender" class="form__label form-card__label">
                                                Gender
                                            </label>
                                            <div class="form__text-input">
                                                <select class="form__select form__select-lv2" name="gender" id="gender">
                                                    <option value="Nam">Nam</option>
                                                    <option value="Nữ">Nữ</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form__group">
                                            <label for="major" class="form__label form-card__label">
                                                Department
                                            </label>
                                            <div class="form__text-input">
                                                <select class="form__select form__select-lv2" name="department" id="department">
                                                    <?php if (!empty($allDepartment)) {
                                                        foreach ($allDepartment as $department) {
                                                            extract($department) ?>
                                                            <option value="<?= $id ?>"><?= $department_name ?></option>
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
                                                <select class="form__select form__select-lv2" name="status_id" id="status_id">
                                                    <?php if (!empty($allStatus)) {
                                                        foreach ($allStatus as $status) {
                                                            extract($status) ?>
                                                            <option value="<?= $status_id ?>"><?= $status_name ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-card__bottom">
                                        <a href="./index.php?page=student-manage" class="btn btn--text">Cancel</a>
                                        <input type="submit" value="Add" name="add" class="btn btn--primary btn--rounded">
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