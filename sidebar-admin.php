<div class="col-3 col-xl-4 col-lg-5 col-md-12">
    <aside class="profile__sidebar">
        <!-- User -->
        <div class="profile-user">
            <h2 class="profile-user__name"><?php echo $_SESSION['admin']['admin_name'] ?></h2>
        </div>

        <!-- Menu 1 -->
        <div class="profile-menu">
            <h3 class="profile-menu__title">Tính năng</h3>
            <ul class="profile-menu__list">
                <li>
                    <a href="./phamvantoan/class-management.php" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/profile.svg" alt="" class="icon" />
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
            <h3 class="profile-menu__title">Subscriptions & plans</h3>
            <ul class="profile-menu__list">
                <li>
                    <a href="#!" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/shield.svg" alt="" class="icon" />
                        </span>
                        Protection plans
                    </a>
                </li>
            </ul>
        </div>

        <!-- Menu 4 -->
        <div class="profile-menu">
            <h3 class="profile-menu__title">Customer Service</h3>
            <ul class="profile-menu__list">
                <li>
                    <a href="#!" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/info.svg" alt="" class="icon" />
                        </span>
                        Help
                    </a>
                </li>
                <li>
                    <a href="#!" class="profile-menu__link">
                        <span class="profile-menu__icon">
                            <img src="assets/icons/danger.svg" alt="" class="icon" />
                        </span>
                        Terms of Use
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</div>