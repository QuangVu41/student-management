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
                </div>
                <?php
                if (!empty($_SESSION['admin']) || !empty($_SESSION['student']) || !empty($_SESSION['teacher'])) {
                    if (!empty($_SESSION['role']) && $_SESSION['role'] == 1) {
                        require_once './sidebar-admin-2.php';
                    } else {
                        require_once './sidebar-user.php';
                    }
                }
                ?>
            </div>
        </div>
    </div>
</main>