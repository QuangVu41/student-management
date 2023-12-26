<?php
if (isset($_POST['add']) && $_POST['add']) {
    $major_id = $_POST['major'];
    $result = updateStudentMajor($student_id, $major_id);
    if ($result) {
        header('location: ./index.php?page=student-manage');
    } else {
        echo 'Cannot update student major!';
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
                                    Choose major
                                </h2>
                                <form action="" class="form form-card" method="post" enctype="multipart/form-data">
                                    <!-- Form row 1 -->
                                    <div class="form__row">
                                        <div class="form__group">
                                            <label for="major" class="form__label form-card__label">
                                                Major
                                            </label>
                                            <div class="form__text-input">
                                                <select class="form__select form__select-lv2" name="major" id="major">
                                                    <?php
                                                    foreach ($majors as $major) {
                                                    ?>
                                                        <option value="<?= $major['id'] ?>"><?= $major['major_name'] ?></option>
                                                    <?php }
                                                    ?>
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