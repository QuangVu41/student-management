<?php
if (!empty($_SESSION['admin'])) {
    if (isset($_POST['update']) && $_POST['update']) {
        $major_id = $_POST['major_id'];
        $result = updateStudentMajor($student_id, $major_id);
        if ($result) {
            header('location: ./index.php?page=student-manage');
        } else {
            echo 'Cannot update student major!';
            die();
        }
    }

    if (isset($_POST['add']) && $_POST['add']) {
        $depart_id = $_POST['department_id'];
        $major_name = $_POST['major_name'];
        $major_code = $_POST['major_code'];
        $result = addMajor($major_name, $major_code, $depart_id);
        if ($result) {
            header('location: ./index.php?page=update-student-major&id=' . $student_id);
        } else {
            echo 'Cannot add student major!';
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
                                        Chọn chuyên ngành
                                    </h2>
                                    <form action="" class="form form-card" id="form-7" method="post" enctype="multipart/form-data">
                                        <!-- Form row 1 -->
                                        <div class="form__row">
                                            <div class="form__group">
                                                <label for="major" class="form__label form-card__label">
                                                    Chuyên ngành
                                                </label>
                                                <div class="form__text-input">
                                                    <?php if (!empty($majors)) { ?>
                                                        <select class="form__select form__select-lv2" name="major_id" id="major_id">
                                                            <option value="">-- Chọn chuyên ngành --</option>
                                                            <?php foreach ($majors as $major) {
                                                            ?>
                                                                <option value="<?= $major['id'] ?>"><?= $major['major_name'] ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } else { ?>
                                                        <button class="btn btn--primary btn--small js-toggle" toggle-target="#add-dialog">Chưa có chuyên ngành nhấn vào để thêm</button>
                                                    <?php } ?>
                                                </div>
                                                <p class="form__error"></p>
                                            </div>
                                        </div>

                                        <div class="form-card__bottom">
                                            <a href="./index.php?page=student-manage" class="btn btn--text">Hủy</a>
                                            <input type="submit" value="Cập nhật" name="update" class="btn btn--primary btn--rounded">
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
                        <input type="hidden" name="department_id" value="<?= $department_id  ?>">
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

    <script>
        Validator({
            form: '#form-7',
            formParent: '.form__group',
            errorSelector: '.form__error',
            rules: [
                Validator.isRequired('#major_id', 'Vui lòng chọn chọn chuyên ngành'),
            ],
        });
    </script>
<?php } else {
    header('location: ./index.php');
} ?>