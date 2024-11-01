<aside class="sidebar h-100vh">
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include './models/database.php';
    $db = new Database();
    $action = $_GET["action"] ?? "";
    $role = $_SESSION["role"] ?? "";
    if(empty($role)){
        header("Location: ./");
    }
    ?>
    
    <h2 class="text-light text-center">
    <img src="https://cdn-icons-png.flaticon.com/512/1642/1642446.png" alt="FastLearn Logo" class="logo-class" width="50" height="50" style="vertical-align: middle;">
    <span style="display: inline-block; vertical-align: middle;">FastLearn</span>
</h2>

</h2>

    
    

    <?php if($role === 'sinhvien') : ?>
        <ul class="nav">
            <li class="nav-item">
                <a href="./xemthongbao.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-solid fa-bullhorn"></i> Thông báo</a>
            </li>
            <li class="nav-item">
                <a href="./sinhvien-tatcakhoahoc.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-brands fa-dropbox"></i> Tất cả khóa học</a>
            </li>
            <li class="nav-item">
                <a href="./sinhvien-khoahocdadangky.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-regular fa-calendar-check"></i> Khóa học đã đăng ký</a>
            </li>
            <li class="nav-item">
                <a href="./sinhvien-guiphanhoi.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-regular fa-paper-plane"></i> Gửi phản hồi</a>
            </li>
            <li class="nav-item">
                <a href="./doimatkhau.php?role=sinhvien" class="nav-link d-flex align-items-center gap-3"><i class="fa-solid fa-key"></i> Đổi mật khẩu</a>
            </li>
            <li class="nav-item">
                <a href="./dangxuat.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-solid fa-right-from-bracket"></i> Đăng Xuất</a>
            </li>
        </ul>
    <?php endif ?>
    <?php if($role === 'giangvien') : ?>
        <ul class="nav">
            <li class="nav-item">
                <a href="./xemthongbao.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-solid fa-bullhorn"></i> Thông báo</a>
            </li>
            <li class="nav-item">
                <a href="./giangvien-khoahocdangday.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-solid fa-clipboard-list"></i> Khóa học đang dạy</a>
            </li>
            <li class="nav-item">
                <a href="./doimatkhau.php?role=giangvien" class="nav-link d-flex align-items-center gap-3"><i class="fa-solid fa-key"></i> Đổi mật khẩu</a>
            </li>
            <li class="nav-item">
                <a href="./dangxuat.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-solid fa-right-from-bracket"></i> Đăng Xuất</a>
            </li>
        </ul>
    <?php endif ?>
    <?php if($role === 'quantrivien') : ?>
        <ul class="nav">
            <li class="nav-item">
                <a href="./admin-sinhvien.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-solid fa-users"></i> Quản lý sinh viên</a>
            </li>
            <li class="nav-item">
                <a href="./admin-giangvien.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-solid fa-user-group"></i> Quản lý giảng viên</a>
            </li>
            <li class="nav-item">
                <a href="./admin-khoahoc.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-solid fa-chalkboard"></i> Quản lý khóa học</a>
            </li>
            <li class="nav-item">
                <a href="./admin-phanhoi.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-brands fa-facebook-messenger"></i> Quản lý phản hồi</a>
            </li>
            <li class="nav-item">
                <a href="./admin-thongbao.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-solid fa-bullhorn"></i> Quản lý thông báo</a>
            </li>
            <li class="nav-item">
                <a href="./doimatkhau.php?role=quantrivien" class="nav-link d-flex align-items-center gap-3"><i class="fa-solid fa-key"></i> Đổi mật khẩu</a>
            </li>
            <li class="nav-item">
                <a href="./dangxuat.php" class="nav-link d-flex align-items-center gap-3"><i class="fa-solid fa-right-from-bracket"></i> Đăng Xuất</a>
            </li>
        </ul>
    <?php endif ?>
</aside>