<!DOCTYPE html>
<html lang="en">
<head>
    @include('Library.grid_system')
    @include('Library.responsive')
    @include('Library.variable')
    {{-- CSS policies terms --}}
    <style>
        .content {
            margin-top: 20px; 
        }
        .content__heading {
            font-weight: bold;
            font-size: 28px;
        }
        .content__description {
            color: rgb(119, 119, 119);   
            line-height: 2;
            text-align: justify;
        }
    </style>
</head>
<body>
    <div class="grid">
        @include('Components.header')
        <div class="container">
            <div class="grid wide">
                @include('Components.breadcrumb')
                <script>
                    breadCrumbHeading.innerText = 'Điều khoản và chính sách'
                </script>
                <div class="row no-gutters">
                    <div class="col l-12 m-12 c-12">
                        <div class="content">
                            <div class="content__heading">1. Điều khoản sử dụng & Chính sách quyền riêng tư</div>
                            <div class="content__description">Tại Website đặt sân Đại học Thể Dục Thể Thao Đà Nẵng, chúng tôi cam kết tôn trọng và bảo vệ quyền riêng tư của tất cả những người sử dụng dịch vụ của chúng tôi. Đó là lý do tại sao chúng tôi phát triển Điều khoản sử dụng và Chính sách quyền riêng tư này.

                                Điều khoản sử dụng và Chính sách quyền riêng tư sau đây giải thích các cách khác nhau mà chúng tôi thu thập thông tin và dữ liệu cá nhân về người dùng của mình, giải thích thời điểm và lý do chúng tôi sẽ chia sẻ dữ liệu cá nhân cũng như nêu chi tiết các quyền và lựa chọn mà bạn sở hữu đối với đến dữ liệu cá nhân của mình. Bằng cách sử dụng website đặt sân Đại học Thể Dục Thể Thao Đà Nẵng, bạn đã xác nhận rằng bạn đồng ý với các điều khoản của chính sách này.
                                
                                Website của chúng tôi có thể chứa các liên kết đến các trang web khác do các tổ chức khác điều hành có điều khoản sử dụng và chính sách quyền riêng tư của riêng họ. Vui lòng đảm bảo bạn đọc kỹ các điều khoản, điều kiện và chính sách quyền riêng tư trước khi cung cấp bất kỳ dữ liệu cá nhân nào trên trang web vì chúng tôi không chấp nhận bất kỳ trách nhiệm hoặc nghĩa vụ pháp lý nào đối với trang web của các tổ chức khác.
                                
                                Đôi khi, chính sách này có thể thay đổi nên bạn sẽ muốn kiểm tra để đảm bảo rằng bạn hài lòng với những thay đổi của chúng tôi. Các câu hỏi về chính sách này hoặc các vấn đề khác liên quan đến quyền riêng tư có thể được gửi tới cskh@daiduong.com. Số điện thoại liên hệ của chúng tôi là +84 (0)869 622 389.</div>
                        </div>
                    </div>
                    
                    <div class="col l-12 m-12 c-12">
                        <div class="content">
                            <div class="content__heading">2. Dữ liệu cá nhân chúng tôi thu thập</div>
                            <div class="content__description">Khi bạn đăng ký Ứng dụng di động của chúng tôi, bạn có thể cung cấp cho chúng tôi:

                                Thông tin cá nhân của bạn, bao gồm tên, địa chỉ, email, số điện thoại và ngày sinh.
                                Chi tiết đăng nhập tài khoản của bạn, như tên người dùng và mật khẩu bạn đã chọn.
                                Khi bạn sử dụng Ứng dụng di động của chúng tôi, chúng tôi có thể thu thập thông tin về:
                                
                                Các thiết bị bạn đã sử dụng để truy cập Ứng dụng di động của chúng tôi (bao gồm địa chỉ IP, loại trình duyệt và số nhận dạng thiết bị di động)
                                Hành vi trực tuyến của bạn</div>
                        </div>
                    </div>
                    <div class="col l-12 m-12 c-12">
                        <div class="content">
                            <div class="content__heading">3. Thông tin của bạn được sử dụng như thế nào?</div>
                            <div class="content__description">Chúng tôi có thể sử dụng thông tin cá nhân của bạn để:

                                Thông báo cho bạn về những thay đổi quan trọng đối với Dịch vụ và Chính sách của chúng tôi
                                Gửi cho bạn thông tin về Sản phẩm và Dịch vụ mà bạn có thể quan tâm từ chúng tôi hoặc các đối tác của chúng tôi
                                Thực hiện nghĩa vụ hợp đồng của chúng tôi
                                Cho phép truy cập vào các Trang web hoặc Dịch vụ ứng dụng di động cụ thể
                                Cải thiện Sản phẩm và Dịch vụ mà chúng tôi cung cấp và mang lại trải nghiệm tốt hơn trên Ứng dụng di động Aguri Fitness
                                Giao tiếp tốt hơn với bạn
                                Khoảng thời gian chúng tôi lưu giữ thông tin cá nhân được xem xét thường xuyên. Thông tin cá nhân được lưu giữ an toàn trên hệ thống của chúng tôi trong khoảng thời gian cần thiết cho các hoạt động liên quan.</div>
                        </div>
                    </div>
                    <div class="col l-12 m-12 c-12">
                        <div class="content">
                            <div class="content__heading">4. Chia sẻ dữ liệu cá nhân với các tổ chức khác</div>
                            <div class="content__description">Chúng tôi chỉ có thể chia sẻ dữ liệu cá nhân với các tổ chức khác trong các trường hợp sau:

                                Nếu luật pháp hoặc cơ quan công quyền yêu cầu;
                                Nếu chúng tôi cần chia sẻ dữ liệu cá nhân để thiết lập, thực hiện hoặc bảo vệ các quyền hợp pháp của mình;
                                Cho tổ chức mà chúng tôi bán hoặc chuyển nhượng (hoặc tham gia đàm phán để bán hoặc chuyển nhượng) bất kỳ hoạt động kinh doanh nào của chúng tôi. Nếu việc chuyển nhượng hoặc bán được tiến hành, tổ chức nhận dữ liệu cá nhân của bạn có thể sử dụng dữ liệu cá nhân của bạn theo cách giống như chúng tôi.
                                Thông tin của bạn không bao giờ được chia sẻ với bên thứ ba vì mục đích tiếp thị mà không có sự đồng ý của bạn.</div>
                        </div>
                    </div>
                    <div class="col l-12 m-12 c-12">
                        <div class="content">
                            <div class="content__heading">5. Bảo vệ dữ liệu cá nhân</div>
                            <div class="content__description">Chúng tôi sử dụng các biện pháp bảo vệ máy chủ như tường lửa, sao lưu dữ liệu thường xuyên, mã hóa dữ liệu và chính sách bảo vệ mật khẩu an toàn trên tất cả các hệ thống xử lý thông tin cá nhân của bạn. Chúng tôi thực thi các biện pháp kiểm soát quyền truy cập vật lý vào các tòa nhà và tệp để giữ an toàn cho dữ liệu.

                                Mặc dù chúng tôi thực hiện các biện pháp kỹ thuật và tổ chức phù hợp để bảo vệ dữ liệu cá nhân của bạn, chúng tôi không thể đảm bảo tính bảo mật của bất kỳ dữ liệu cá nhân nào mà bạn chuyển qua internet cho chúng tôi.</div>
                        </div>
                    </div>
                    <div class="col l-12 m-12 c-12">
                        <div class="content">
                            <div class="content__heading">6. Quyền lợi của bạn</div>
                            <div class="content__description">Bạn có quyền xem dữ liệu cá nhân mà chúng tôi lưu giữ về bạn. Mọi yêu cầu phải được thực hiện bằng văn bản và chúng tôi sẽ trả lời trong vòng một tuần. Chúng tôi không tính phí cho dịch vụ này.

                                Nếu bạn muốn có bản sao dữ liệu cá nhân mà chúng tôi lưu giữ về bạn, vui lòng gửi email cho chúng tôi theo địa chỉ cskh@daiduong.com
                                Chúng tôi muốn đảm bảo rằng dữ liệu cá nhân mà chúng tôi lưu giữ về bạn là chính xác và cập nhật. Nếu bất kỳ chi tiết nào không chính xác, vui lòng cho chúng tôi biết và chúng tôi sẽ sửa đổi chúng.</div>
                        </div>
                    </div>
                    <div class="col l-12 m-12 c-12">
                        <div class="content">
                            <div class="content__heading">7. Hướng dẫn đặt lịch sử dụng dịch vụ</div>
                            <div class="content__description">Để sử dụng đầy các dịch vụ của sân bóng đặt sân Đại học Thể Dục Thể Thao Đà Nẵng, các bạn cần đăng ký/ đăng nhập.

                                Đối với việc đặt lịch sử dụng sân bóng. Quý khách hàng vui lòng chọn thời gian muốn sử dụng (ngày/giờ) sau đó chọn các sân rảnh để tiếp hành đặt lịch sử dụng .
                                
                                Vì lý do đảm bảo tài sản cho sân bóng, dịch vụ thuê dụng củ chỉ được sử dụng kèm với dịch vụ thuê sân. Chỉ thuê dụng cụ khi sử dụng sân ở các cơ sở thuộc sân bóng đặt sân Đại học Thể Dục Thể Thao Đà Nẵng.
                                
                                Việc đặt sử dụng dịch vụ có thể thực hiện trực tiếp ở website cũng như đặt trực tiếp. Đối với việc đặt lịch qua website. Quý khách hàng vui lòng đặt sân trước 30 phút và đến check-in trước 10 phút đối với thời điểm sử dụng dịch vụ</div>
                        </div>
                    </div>
                    <div class="col l-12 m-12 c-12">
                        <div class="content">
                            <div class="content__heading">8. Chính sách đặt sân</div>
                            <div class="content__description">Đối với dịch vụ thuê sân, chúng tôi sẽ hỗ trợ:
                                1 Quả bóng bất kỳ,
                                5L nước lọc.
                                Đối với dịch vụ thuê sân:
                                <ul style="list-style: circle; margin-left: 50px">
                                    <li>
                                        Đủ 12 tiếng thì được giảm 20%
                                    </li>
                                    <li>
                                        Đủ 24 tiếng thì được giảm 50%
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col l-12 m-12 c-12">
                        <div class="content">
                            <div class="content__heading">9. Chính sách hủy sân</div>
                            <div class="content__description">Chúng tôi có thể hỗ trợ hủy sân theo chính sách:

                                Hủy sân trước 1 tiếng hoàn lại 100% vào số dư trong ví nhưng hủy sân sau 1 tiếng không thể hoàn sân.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('Components.footer')
    </div>
</body>
</html>