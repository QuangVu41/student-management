<?php
session_start();
ob_start();
require_once './model/connect.php';
require_once './model/function.php';
if (isset($_POST['signin']) && $_POST['signin']) {
    $user_code = $_POST['user_code'];
    $password = $_POST['password'];
    $student = checkStudentInfo($user_code, $password);
    $role;
    if ($student) {
        $_SESSION['student'] = [];
        $_SESSION['student'] = $student;
        $role = $_SESSION['student']['role_id'];
        $_SESSION['role'] = $role;
        header('location: ./index.php?page=profile');
    } else if ($teacher = checkTeacherInfo($user_code, $password)) {
        $_SESSION['teacher'] = [];
        $_SESSION['teacher'] = $teacher;
        $_SESSION['teacher_id'] = $teacher["teacher_id"];
        $role = $_SESSION['teacher']['role_id'];
        $_SESSION['role'] = $role;
        header('location: ./phamvantoan/teacher-index.php');
    } else if ($admin = checkAdminInfo($user_code, $password)) {
        $_SESSION['admin'] = [];
        $_SESSION['admin'] = $admin;
        $role = $_SESSION['admin']['role_id'];
        $_SESSION['role'] = $role;
        header('location: ./index.php?page=profile-admin');
    } else {
        $txt_error = 'Tài khoản hoặc mật khẩu không đúng!';
    }
}

?>

<!DOCTYPE html>
<html lang="en" class="">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign In</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/favicon/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png" />
    <link rel="manifest" href="./assets/favicon/site.webmanifest" />
    <link rel="mask-icon" href="./assets/favicon/safari-pinned-tab.svg" color="#5bbad5" />
    <meta name="msapplication-TileColor" content="#da532c" />
    <meta name="theme-color" content="#ffffff" />

    <!-- Font -->
    <link rel="stylesheet" href="./assets/fonts/stylesheet.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
    <main class="auth">
        <!-- Auth intro -->
        <div class="auth__intro d-md-none">
            <img src="./assets/imgs/auth/intro.png" alt="" class="auth__intro-img" />
            <p class="auth__intro-text">
                The best of luxury brand values, high quality products, and innovative services
            </p>
        </div>

        <!-- Auth content -->
        <div class="auth__content">
            <div class="auth__content-inner">
                <!-- Logo -->
                <a href="./" class="logo">
                    <img src="./assets/icons/logo.svg" alt="grocerymart" class="logo__img main-logo" />
                    <h2 class="logo__title">Trang Chủ</h2>
                </a>

                <h1 class="auth__heading">Hello Again!</h1>
                <p class="auth__desc">
                    Welcome back to sign in. As a returning customer, you have access to your previously saved all
                    information.
                </p>
                <form action="" class="form auth__form" id="form-1" method="post">
                    <div class="form__group">
                        <div class="form__text-input">
                            <input type="text" name="user_code" id="student_code" placeholder="Mã sinh viên hoặc tên tài khoản" class="form__input" />
                            <img src="./assets/icons/message.svg" alt="" class="form__input-icon" />
                            <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                        </div>
                        <p class="form__error"></p>
                    </div>
                    <div class="form__group">
                        <div class="form__text-input">
                            <input type="password" name="password" id="password" placeholder="Mật khẩu" class="form__input" />
                            <img src="./assets/icons/locked.svg" alt="" class="form__input-icon" />
                            <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                        </div>
                        <p class="form__error"></p>
                        <?php
                        if (isset($txt_error)) {
                            echo '<p class="form__error" style="display: block">' . $txt_error . '</p>';
                        }
                        ?>
                    </div>

                    <div class="form__group form__group--inline">
                        <label class="form__checkbox">
                            <input type="checkbox" name="" id="" class="form__checkbox-input d-none" />
                            <span class="form__checkbox-label">Set as default card</span>
                        </label>
                        <a href="./reset-password.php" class="auth__link form__pull-right">Forgot Password</a>
                    </div>
                    <div class="form__group auth__btn-group">
                        <input type="submit" name="signin" class="btn btn--primary auth__btn form__submit-btn" value="Sign In">
                        <button class="btn btn--outline auth__btn btn--no-margin">
                            <img src="./assets/icons/google.svg" alt="" class="btn__icon icon" />
                            Sign in with Google
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="./assets/js/validator.js"></script>

    <script>
        Validator({
            form: '#form-1',
            formParent: '.form__group',
            errorSelector: '.form__error',
            rules: [
                Validator.isRequired('#student_code', 'Nhập mã sinh viên hoặc tên đăng nhập của bạn'),
                Validator.minLength('#password', 6, 'Mật khẩu tối thiểu 6 kí tự'),
            ],
        });
    </script>
</body>

</html>