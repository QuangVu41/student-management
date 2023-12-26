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
                        <div class="row gy-3">
                            <!-- Account Info -->
                            <div class="col-12">
                                <div class="account__heading">
                                    <h2 class="cart-info__heading">Thông tin sinh viên</h2>
                                </div>
                                <div class="row row-cols-1">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Mã SV</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $_SESSION['student']['student_id'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Họ và tên</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $_SESSION['student']['student_name'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Ngày sinh</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $_SESSION['student']['date_of_birth'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Giới tính</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $_SESSION['student']['gender'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Trạng thái</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $status['status_name'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Địa chỉ email</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $_SESSION['student']['email'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Địa chỉ nhà riêng</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $_SESSION['student']['address'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Course Info -->
                            <div class="col-12">
                                <div class="account__heading">
                                    <h2 class="cart-info__heading">Thông tin khóa học</h2>
                                </div>
                                <div class="row row-cols-1">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Tên lớp</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $_SESSION['student']['class_id'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Ngành</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $department['department_name'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4">
                                                <p class="account__info">Chuyên Ngành</p>
                                            </div>
                                            <div class="col-8">
                                                <p class="account__info"><?= $major['major_name'] ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                require_once './sidebar-user.php';
                ?>
            </div>
        </div>
    </div>
</main>