<div class="col-3 col-xl-4 col-lg-5 col-md-12">
    <aside class="profile__sidebar">
        <!-- User -->
        <div class="profile-user">
            <?php if (!empty($_SESSION['student'])) { ?>
                <img src="<?php echo $_SESSION['student']['image'] ?>" alt="" class="profile-user__avatar" />
                <h2 class="profile-user__name"><?php echo $_SESSION['student']['student_name'] ?></h2>
            <?php } else {
                echo "";
            } ?>
        </div>

        <!-- Menu 1 -->
        <div class="profile-menu">
            <h3 class="profile-menu__title">Tính năng</h3>
            <ul class="profile-menu__list">
                <li>
                    <a href="./index.php?page=profile" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/profile.svg" alt="" class="icon" />
                        </span>
                        Thông tin cá nhân
                    </a>
                </li>
                <li>
                    <a href="?page=list-subject" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/address.svg" alt="" class="icon" />
                        </span>
                        Đăng ký môn học
                    </a>
                </li>
                <li>
                    <a href="?page=list-registered" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/bag.svg" alt="" class="icon" />
                        </span>
                        Xem những môn đã đăng ký
                    </a>
                </li>
                <li>
                    <a href="#!" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/message.svg" alt="" class="icon" />
                        </span>
                        Xem học phí
                    </a>
                </li>
            </ul>
        </div>

        <!-- Menu 3 -->
        <div class="profile-menu">
            <h3 class="profile-menu__title">Đăng ký và kế hoạch</h3>
            <ul class="profile-menu__list">
                <li>
                    <a href="#!" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/shield.svg" alt="" class="icon" />
                        </span>
                        Kế hoạch bảo vệ
                    </a>
                </li>
            </ul>
        </div>

        <!-- Menu 4 -->
        <div class="profile-menu">
            <h3 class="profile-menu__title">Dịch vụ</h3>
            <ul class="profile-menu__list">
                <li>
                    <a href="#!" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/info.svg" alt="" class="icon" />
                        </span>
                        Hỗ trợ
                    </a>
                </li>
                <li>
                    <a href="#!" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/danger.svg" alt="" class="icon" />
                        </span>
                        Điều khoản sử dụng
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</div>