*********************************************
# Sinh viên
- Đăng nhập
- Danh sách khóa học
- Chi tiết khóa học
- Tìm kiếm khóa học
- Đăng ký khóa học
- Đăng câu hỏi vấn về khóa học
- Gửi phản hồi về dịch vụ
- Thay đổi mật khẩu
*********************************************
# Giảng viên
- Đăng nhập
- Trả lời câu hỏi về khóa học
- Xem + Cập nhật khóa học
- Thay đổi mật khẩu
*********************************************
# Quản trị viên
- Thêm sửa xóa khóa học
- Thêm sửa xóa sinh viên
- Thêm sửa xóa giảng viên
- Xem phản hồi
- Tìm kiếm sinh viên - giảng viên
- Đăng thông báo trên web cho sinh viên
- Thay đổi mật khẩu

**********************************************
# Database
- quantrivien
    + id
    + ten_dang_nhap
    + mat_khau
    + email
    + sdt
- sinhvien
    + id
    + ten_dang_nhap
    + mat_khau
    + ho_va_ten
    + ngay_sinh
    + email
    + sdt
    + ngay_tao
- giangvien
    + id
    + ten_dang_nhap
    + mat_khau
    + ho_va_ten
    + ngay_sinh
    + email
    + sdt
    + ngay_tao
- thongtinkhoahoc
    + id
    + ten_khoa_hoc
    + id_giang_vien
    + mo_ta_khoa_hoc
    + thoi_luong
    + chi_phi
- tailieukhoahoc
    + id_khoa_hoc
    + noi_dung
- dangkykhoahoc
    + id
    + id_khoa_hoc
    + id_sinh_vien
- cauhoi
    + id
    + id_khoa_hoc
    + id_sinh_vien
    + noi_dung_cau_hoi
- cautraloi
    + id
    + id_cau_hoi
    + noi_dung_tra_loi
- phanhoi
    + id
    + id_sinh_vien
    + noi_dung_phan_hoi
- thongbao
    + id
    + noi_dung_thong_bao