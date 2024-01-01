<div class="col-3 col-xl-4 col-lg-5 col-md-12">
    <aside class="profile__sidebar">
        <!-- User -->
        <div class="profile-user">
            <h2 class="profile-user__name"><?php echo $_SESSION['admin']['user_name'] ?></h2>
        </div>

        <!-- Menu 1 -->
        <div class="profile-menu">
            <h3 class="profile-menu__title">Tính năng</h3>
            <ul class="profile-menu__list">
                <li>
                    <a href="./index.php?page=student-manage" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/profile.svg" alt="" class="icon" />
                        </span>
                        Quản lý sinh viên
                    </a>
                </li>
                <li>
                    <a href="./index.php?page=department-manage" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/address.svg" alt="" class="icon" />
                        </span>
                        Quản lý ngành học
                    </a>
                </li>
                <li>
                    <a href="./index.php?page=status-manage" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/bag.svg" alt="" class="icon" />
                        </span>
                        Quản lý trạng thái sinh viên
                    </a>
                </li>
                <li>
                    <a href="index.php?page=list-subject" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/cart.svg" alt="" class="icon" />
                        </span>
                        Quản lý môn học
                    </a>
                </li>
                <li>
                    <a href="./phamvantoan/class-management.php" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/linkedin.svg" alt="" class="icon" />
                        </span>
                        Lớp học
                    </a>
                </li>
                <li>
                    <a href="./phamvantoan/teacher-management.php" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/address.svg" alt="" class="icon" />
                        </span>
                        Giáo viên
                    </a>
                </li>
                <li>
                    <a href="#" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/message.svg" alt="" class="icon" />
                        </span>
                        Môn học
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