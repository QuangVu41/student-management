<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" style="color: green;" href="teacher-index.php">Trang chủ</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="teacher-class.php">Lớp chủ nhiệm</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="teacher-class-by-subject.php">Lớp đang giảng dạy</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tài khoản
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="teacher-update.php">Sửa thông tin</a></li>
            <li><a class="dropdown-item" href="teacher-updatepassword.php">Đổi mật khẩu</a></li>
          </ul>
        </li>
      </ul>

        <?php
        session_start();
        $_SESSION['teacher_id'] = 1;
        if(isset($_SESSION['teacher_id'])){
        ?>
            <form class="d-flex" role="search">
                <button class="btn btn-outline-success" type="submit">Đăng xuất</button>
            </form>
        <?php
        }else{
        ?>
            <form class="d-flex" role="search">
                <button class="btn btn-outline-success" type="submit">Đăng nhập</button>
            </form>
        <?php
        }
        ?>
        
      

    </div>
  </div>
</nav>