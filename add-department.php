<?php
if (isset($_POST['add']) && $_POST['add']) {
    $department_name = $_POST['department_name'];
    $desc = $_POST['desc'];
    $result = addDepartment($department_name, $desc);
    if ($result) {
        header('location: ./index.php?page=department-manage');
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
                                    <a href="?page=department-manage">
                                        <img src="./assets/icons/arrow-left.svg" alt="" class="icon cart-info__back-arrow" />
                                    </a>
                                    Add department
                                </h2>
                                <form action="" class="form form-card" method="post" enctype="multipart/form-data">
                                    <!-- Form row 1 -->
                                    <div class="form__row">
                                        <div class="form__group">
                                            <label for="department_name" class="form__label form-card__label">
                                                Tên ngành
                                            </label>
                                            <div class="form__text-input">
                                                <input type="text" name="department_name" id="department_name" class="form__input" value="" />
                                                <img src=" ./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
                                            </div>
                                        </div>
                                        <div class="form__group">
                                            <label for="desc" class="form__label form-card__label">Mô tả</label>
                                            <div class="form__text-area">
                                                <textarea name="desc" id="desc" placeholder="Description" class="form__text-area-input"></textarea>
                                                <img src="./assets/icons/form-error.svg" alt="" class="form__input-icon-error" />
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