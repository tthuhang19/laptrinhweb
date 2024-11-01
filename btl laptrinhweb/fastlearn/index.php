<title>Đăng nhập</title>
<?php include './components/link.php' ?>
<div class="container bg-gra">
    <div class="d-flex justify-content-center align-items-center h-100vh">
        <div class="text-center">
            <h1 class="text-dark p-2 font-weight-bold">Chào mừng bạn đến với FastLearn</h1>
            <p class="mb-2">Hệ thống hiện đại cung cấp các khóa học online và trải nghiệm tốt nhất cho bạn</p>
            <img src="https://r2.community.samsung.com/t5/image/serverpage/image-id/2475766i106F9E934F1E6965?v=v2" width="500px" style="border: 5px solid #e194d2; border-radius: 10px" alt="">
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="./dangnhap.php?role=sinhvien" class="btn btn-primary"><i class="fa-solid fa-graduation-cap"></i> Sinh viên</a>
                <a href="./dangnhap.php?role=giangvien" class="btn btn-dark"><i class="fa-solid fa-users"></i> Giảng viên</a>
                <a href="./dangnhap.php?role=quantrivien" class="btn btn-danger"><i class="fa-solid fa-user-gear"></i> Quản trị viên</a>
            </div>
        </div>
    </div>
</div>