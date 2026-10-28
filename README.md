# BookStore – Website bán sách trực tuyến

## Yêu cầu

* PHP: 8.2 trở lên
* Laravel: 12.70.1
* Composer: 2.10.3
* MySQL/MariaDB: Phiên bản tương thích với Laravel 12
* XAMPP: Khuyến nghị sử dụng trên Windows

## Cài đặt

1. Clone repository về máy:

   ```bash
   git clone https://github.com/QuocAnh1501/nhom1_GioHangBanSach.git
   cd nhom1_GioHangBanSach
   ```

2. Cài đặt thư viện:

   ```bash
   composer install
   ```

3. Sao chép `.env.example` thành `.env`.

4. Cấu hình thông tin cơ sở dữ liệu trong file `.env`:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=qlgiohang
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. Tạo khóa ứng dụng:

   ```bash
   php artisan key:generate
   ```

6. Tạo cơ sở dữ liệu `qlgiohang` trong MySQL/MariaDB và import file SQL của dự án nếu có.

7. Xóa cache cấu hình:

   ```bash
   php artisan optimize:clear
   ```

8. Khởi chạy website:

   ```bash
   php artisan serve
   ```

9. Truy cập website tại `http://localhost/nhom1_GioHangBanSach/public/gio-hang`.

**Lưu ý:** Nếu đã import file SQL có sẵn cấu trúc bảng, không chạy `php artisan migrate` trước khi kiểm tra các migration để tránh xung đột với cơ sở dữ liệu hiện tại.

## Chức năng

* Đăng ký, đăng nhập và đăng xuất tài khoản.
* Phân quyền Admin và Khách hàng.
* Hiển thị danh sách và chi tiết sách.
* Quản lý sản phẩm: thêm, sửa, xóa và xem thông tin sách.
* Quản lý giỏ hàng và số lượng sản phẩm.
* Đặt hàng trực tuyến.
* Thanh toán COD và hiển thị mã QR chuyển khoản.
* Khách hàng xem lịch sử và chi tiết đơn hàng.
* Admin xem danh sách, chi tiết và cập nhật trạng thái đơn hàng.

## Công nghệ sử dụng

* PHP, Laravel 12
* MySQL/MariaDB
* HTML, CSS, Bootstrap 5.3.3
* Blade Template
* Git, GitHub

## Thành viên

* [Nguyễn Quốc Anh – Nhóm trưởng]
* [Đặng Thái Bảo]
* [Thạch Chí Vĩnh]
* [Võ Đức Tiền]
* [Thạch Phú Cường]
* [Nguyễn Thành Dự]
