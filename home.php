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
                    <div class="row">
                        <div class="col-5 col-xl-6 col-lg-12">
                            <div class="prod-preview">
                                <div class="prod-preview__list">
                                    <figure class="prod-preview__item">
                                        <img src="./assets/imgs/auth/intro.png" alt="" class="prod-preview__img" />
                                    </figure>
                                </div>
                            </div>
                        </div>
                        <div class="col-7 col-xl-6 col-lg-12">
                            <section class="prod-info">
                                <div class="text-content prod-tab__text-content">
                                    <h2>Ứng dụng quản lý sinh viên.</h2>
                                    <p>
                                        Ngày nay, sự phát triển của công nghệ đã mang lại nhiều cơ hội và tiện ích cho các ngành giáo dục. Trong số đó, ứng dụng quản lý sinh viên đã trở thành một công cụ quan trọng, giúp các trường đại học và các tổ chức giáo dục quản lý thông tin sinh viên một cách hiệu quả và linh hoạt. Ứng dụng này không chỉ giúp tiết kiệm thời gian và công sức mà còn tối ưu hóa trải nghiệm học tập của sinh viên.
                                    </p>
                                    <h3>Nền tảng Hiện đại Hóa Quản lý Học tập.</h3>
                                    <p>
                                        Một trong những tính năng nổi bật của ứng dụng quản lý sinh viên là khả năng theo dõi thông tin cá nhân và học tập của sinh viên. Thông qua hệ thống này, sinh viên có thể dễ dàng cập nhật và kiểm tra thông tin về lịch học, điểm số, tình trạng học phí và các thông báo quan trọng khác. Điều này giúp họ tự quản lý học tập và tiếp cận thông tin một cách thuận lợi, tăng cường trách nhiệm cá nhân và sự tự chủ.
                                    </p>
                                    <p>
                                        <img src="./assets/imgs/humg-logo.png" alt="" />
                                        <em>Logo trường Đại học Mỏ Dịa Chất.</em>
                                    </p>
                                    <blockquote>
                                        <p>
                                            Lorem ipsum dolor sit amet <em>consectetur</em>
                                            <u>adipisicing</u> elit. Aliquid, cupiditate. Modi, quidem, ullam
                                            sint dolorum recusandae voluptates dignissimos similique animi
                                            assumenda praesentium et! Illum dolorem est rem voluptas nam!
                                            Voluptatem.
                                        </p>
                                    </blockquote>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <?php
                if (!empty($_SESSION['role']) && $_SESSION['role'] == 1) {
                    require_once './sidebar-admin-2.php';
                } else {
                    require_once './sidebar-user.php';
                }
                ?>
            </div>
        </div>
    </div>
</main>