<style>
    .footer {
        background-image: linear-gradient(0deg,var(--primary-color),#4f8edc);
        color: white;
        justify-content: space-around;
        padding-top: 30px;
    }
    .footer-contact {
        margin-left: 100px;
    }

    .footer-contact__heading {
        font-weight: bold;
        font-size: 18px;
        position: relative;
        padding-bottom: 8px;
    }
    .footer-contact__heading::after {
        content: "";
        height: 2px;
        width: 78px;
        position: absolute;
        bottom: 0;
        left: 0;
        background: white;
    }

    .footer-contact__list {
        margin-top: 10px; 
    }

    .footer-contact-list__item {
        font-size: 14px;
    }
    
    .footer-contact__list-social {
        display: flex;
        font-size: 24px; 
    }
    .footer-contact__list-social-item {
        font-size: 28px; 
    }
    .footer-contact__list-social-item + .footer-contact__list-social-item {
        margin-left: 20px;
    }
    .copy-right {
        margin-top: 30px; 
        text-align: center;
        padding: 16px 0;
        width: 100%;
        font-size: 12px;
        background: rgba(5, 58, 120, 0.755);
    }
</style>
<footer class="footer row no-gutters">
    <div class="grid wide">
        <div class="row">
            <div class="col l-4">
                <div class="footer-contact">
                    <h4 class="footer-contact__heading">Thông tin</h4>
                    <ul class="footer-contact__list">
                        <li class="footer-contact-list__item"><a href="" class="footer-contact-list-item__link">Giới thiệu</a></li>
                        <li class="footer-contact-list__item"><a href="" class="footer-contact-list-item__link">Đặt sân</a></li>
                        <li class="footer-contact-list__item"><a href="" class="footer-contact-list-item__link">Liên hệ</a></li>
                        <li class="footer-contact-list__item"><a href="" class="footer-contact-list-item__link">Chính sách</a></li>
                    </ul>
                </div>
            </div>
    
            <div class="col l-4">
                <div class="footer-contact">
                    <h4 class="footer-contact__heading">Tài khoản</h4>
                    <ul class="footer-contact__list">
                        <li class="footer-contact-list__item"><a href="" class="footer-contact-list-item__link">Số dư</a></li>
                        <li class="footer-contact-list__item"><a href="" class="footer-contact-list-item__link">Thuê sân</a></li>
                        <li class="footer-contact-list__item"><a href="" class="footer-contact-list-item__link">Thông tin cá nhân</a></li>
                    </ul>
                </div>
            </div>
            <div class="col l-4">
                <div class="footer-contact">
                    <h4 class="footer-contact__heading">Theo dõi</h4>
                    <ul class="footer-contact__list footer-contact__list-social">
                        <li class="footer-contact-list__item footer-contact__list-social-item"><a href="" class="footer-contact-list-item__link">
                            <i class="fa-brands fa-google"></i>    
                        </a></li>
                        <li class="footer-contact-list__item footer-contact__list-social-item"><a href="" class="footer-contact-list-item__link">
                            <i class="fa-brands fa-twitter"></i>   
                        </a></li>
                        <li class="footer-contact-list__item footer-contact__list-social-item"><a href="" class="footer-contact-list-item__link">
                            <i class="fa-brands fa-linkedin"></i>
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <p class="copy-right">© 2050531200226 - Võ Minh Lợi - minhloi1131130@gmail.com</p>
        
</footer>