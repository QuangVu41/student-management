<header id="header" class="header">
    <div class="container">
        <div class="top-bar">
            <!-- More -->
            <button class="top-bar__more d-none d-lg-block js-toggle" toggle-target="#navbar">
                <img src="./assets/icons/more.svg" alt="" class="icon top-bar__more-icon" />
            </button>

            <!-- Logo -->
            <a href="./" class="logo top-bar__logo">
                <img src="./assets/icons/logo.svg" alt="grocerymart" class="logo__img top-bar__logo-img main-logo" />
                <h1 class="logo__title top-bar__logo-title">Trang Chủ</h1>
            </a>

            <!-- Navbar -->
            <nav id="navbar" class="navbar hide">
                <button class="navbar__close-btn js-toggle" toggle-target="#navbar">
                    <img class="icon" src="./assets/icons/arrow-left.svg" alt="" />
                </button>

                <a href="./checkout.php" class="nav-btn d-none d-md-flex">
                    <img src="./assets/icons/cart.svg" alt="" class="nav-btn__icon icon" />
                    <span class="nav-btn__title">Cart</span>
                    <span class="nav-btn__qty">3</span>
                </a>

                <a href="#!" class="nav-btn d-none d-md-flex">
                    <img src="./assets/icons/heart.svg" alt="" class="nav-btn__icon icon" />
                    <span class="nav-btn__title">Favorite</span>
                    <span class="nav-btn__qty">3</span>
                </a>

                <ul class="navbar__list js-dropdown-list">
                    <!-- Navbar item 1 -->
                    <li class="navbar__item">
                        <a href="#!" class="navbar__link">
                            Thủ Tục Một Cửa
                        </a>
                    </li>

                    <!-- Navbar item 2 -->
                    <li class="navbar__item">
                        <a href="#!" class="navbar__link">
                            Một Cửa Online
                        </a>
                    </li>

                    <!-- Navbar item 3 -->
                    <li class="navbar__item">
                        <a href="#!" class="navbar__link">
                            E-mail
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="navbar__overlay js-toggle" toggle-target="#navbar"></div>

            <!-- Actions -->
            <div class="top-act">
                <?php
                if (!empty($_SESSION['student']) || !empty($_SESSION['teacher']) || !empty($_SESSION['admin'])) {
                ?>
                    <div class="top-act__user">
                        <?php if ($_SESSION['role'] == 1) { ?>
                            <a href="" style="padding: 40px 0 40px 20px;" class="user-menu_name"><?= $_SESSION['admin']['user_name'] ?></a>
                        <?php } else { ?>
                            <a href="./index.php?page=profile">
                                <img src="<?php echo $_SESSION['student']['image'] ?>" alt="" class="top-act__avatar" />
                            </a>
                        <?php } ?>
                        <!-- Dropdown -->
                        <div class="act-dropdown top-act__dropdown">
                            <div class="act-dropdown__inner user-menu">
                                <img src="./assets/icons/arrow-up.png" alt="" class="act-dropdown__arrow top-act__dropdown-arrow" />

                                <div class="user-menu__top">
                                    <?php if ($_SESSION['role'] == 1) { ?>
                                        <div>
                                            <p class="user-menu__name"><?php echo $_SESSION['admin']['user_name'] ?></p>
                                            <p><?= '@' . strtolower(preg_replace('/\s+/', '', $_SESSION['admin']['user_name'])) ?></p>
                                        </div>
                                    <?php } else { ?>
                                        <img src="<?php echo $_SESSION['student']['image'] ?>" alt="" class="user-menu__avatar" />
                                        <div>
                                            <p class="user-menu__name"><?php echo $_SESSION['student']['student_name'] ?></p>
                                            <p><?= '@' . strtolower(preg_replace('/\s+/', '', $_SESSION['student']['student_name'])) ?></p>
                                        </div>
                                    <?php } ?>
                                </div>

                                <ul class="user-menu__list">
                                    <li>
                                        <a href="./index.php?page=profile" class="user-menu__link">
                                            <img src="./assets/icons/user.svg" alt="" class="icon" />
                                            Hồ sơ</a>
                                    </li>
                                    <li class="user-menu__separate">
                                        <button class="user-menu__link js-toggle" toggle-target="">
                                            <img src="./assets/icons/settings.svg" alt="" class="icon" />
                                            Đổi mật khẩu
                                        </button>
                                    </li>
                                    <li>
                                        <a href="./index.php?page=signout" class="user-menu__link">
                                            <img src="./assets/icons/signout.svg" alt="" class="icon" />Đăng xuất</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <a href="./sign-in.php" class="top-act__signup btn btn--primary">Đăng nhập</a>
                <?php } ?>
            </div>
        </div>
    </div>
</header>