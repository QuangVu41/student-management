<?php
if (!empty($_SESSION['student'])) {
    if (!empty($_POST['change'])) {
        $student_id = $_SESSION['student']['student_id'];
        $student_pw = $_SESSION['student']['password'];
        $old_pw = $_POST['old-password'];
        $new_pw = $_POST['new-password'];
        $confirm_pw = $_POST['confirm-password'];
        if ($old_pw == $student_pw) {
            $result = changeStudentPassword($student_id, $new_pw);
            if ($result) {
                $success_message = 'Đổi mật khẩu thành công';
                $_SESSION['student']['password'] = $new_pw;
            }
        } else {
            $txt_error = 'Mật khẩu cũ không đúng vui lòng nhập lại';
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
                                        <a href="./index.php">
                                            <img src="./assets/icons/arrow-left.svg" alt="" class="icon cart-info__back-arrow" />
                                        </a>
                                        Đổi mật khẩu
                                        <?php if (!empty($success_message)) { ?>
                                            <p style="margin-left: 50px; color: #12b412"><?= $success_message ?></p>
                                        <?php } ?>
                                    </h2>
                                    <form action="" class="form form-card" id="form-9" method="post" enctype="multipart/form-data">
                                        <!-- Form row 2 -->
                                        <div class="form__row">
                                            <div class="form__group">
                                                <label for="name" class="form__label form-card__label">
                                                    Mật khẩu cũ
                                                </label>
                                                <div class="form__text-input">
                                                    <input type="password" name="old-password" id="old-password" class="form__input" />
                                                    <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                </div>
                                                <p class="form__error"></p>
                                                <?php if (isset($txt_error)) { ?>
                                                    <p class="form__error" style="display: block"><?= $txt_error ?></p>
                                                <?php } else {
                                                    echo '';
                                                } ?>
                                            </div>
                                        </div>

                                        <!-- Form row 3 -->
                                        <div class="form__row">
                                            <div class="form__group">
                                                <label for="new-password" class="form__label form-card__label">
                                                    Mật khẩu mới
                                                </label>
                                                <div class="form__text-input">
                                                    <input type="password" name="new-password" id="new-password" class="form__input" />
                                                    <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                </div>
                                                <p class="form__error"></p>
                                            </div>
                                        </div>

                                        <!-- Form row 4 -->
                                        <div class="form__row">
                                            <div class="form__group">
                                                <label for="confirm-password" class="form__label form-card__label">
                                                    Nhập lại mật khẩu
                                                </label>
                                                <div class="form__text-input">
                                                    <input type="password" name="confirm-password" id="confirm-password" class="form__input" />
                                                    <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                                </div>
                                                <p class="form__error"></p>
                                            </div>
                                        </div>

                                        <div class="form-card__bottom">
                                            <a href="./index.php?page=student-manage" class="btn btn--text">Hủy</a>
                                            <input type="submit" value="Thay đổi" name="change" class="btn btn--primary btn--rounded">
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

    <script>
        Validator({
            form: '#form-9',
            formParent: '.form__group',
            errorSelector: '.form__error',
            rules: [
                Validator.isRequired('#old-password', 'Vui lòng nhập trường này'),
                Validator.minLength('#new-password', 6, 'Mật khẩu phải tối thiếu 6 kí tự'),
                Validator.isRequired('#confirm-password', 'Vui lòng nhập trường này'),
                Validator.isConfirmed('#confirm-password', function() {
                    return document.querySelector('#form-9 #new-password').value;
                }, 'Mật khẩu nhập lại không chính xác'),
            ],
        });
    </script>
<?php } else {
    header('location: ./index.php');
} ?>