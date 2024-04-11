<style>
    .container {
        margin: 40px 0; 
    }
    .new {
        display: flex;
        /* align-items: center; */
        transition: all ease 0.3s;
        border: 1px solid #ccc;
        padding: 20px 24px;
    }

    .new-extension {
        position: relative;
        display: flex;
        justify-content: center;
        transition: all ease 0.3s;
        align-items: center;
    }

    .new:hover .new-extension__img {
        opacity: 0.7;
    }
    
    .new-extension__img {
        width: 100%;
        object-fit: cover;
        
    }

    .new:hover .extra-extension__button {
        display: block;
    }

    .extra-extension__button {
        position: absolute;
        /* top: 50%;
        transform: translateY(-50%); */
        width: 80%;
        height: 80%;
        color: red;
        text-shadow: 1px 1px black;
        border: 4px solid white;
        display: none;
        animation: Growth 0.3s linear 0.1s forwards;
    }


    @keyframes Growth{
        from {
            transform: scale(0.7);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .extra-extension__detail {
        position: absolute;
        color: white;
        text-shadow: 1px 1px black;
        transition: all linear 0.3s;
    }

    .new:hover .extra-extension__detail {
        transform: translateY(-20px);
    }
    
    .row + .row {
        margin-top: 40px;
    }

    .new-infor {
        margin: 20px 0px 0px;
        padding: 0px 20px;
    }
    .new-infor__heading {
        font-weight: bold;
        font-size: 24px;
    }
    .new-infor__date {
        font-size: 12px;
        color: #ccc;
    }
    .new-infor__description {
        margin-top: 20px;
        font-size: 16px; 
        text-align: justify;
        height: 144px;
        overflow: hidden;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 6;
    }
</style>
<div class="container">
    <div class="grid wide">
        <div class="row">
            <div class="new">
                <div class="new-extension col l-5">
                    <img src="assets/img/news.png" alt="news" class="new-extension__img">
                    <button class="extra-extension__button">
                        Xem thêm
                    </button>
                    <div class="extra-extension__detail">Chi tiết</div>
                </div>
                <div class="new-infor col l-7">
                    <h2 class="new-infor__heading">Sân bóng đang được bảo trì</h2>
                    <p class="new-infor__date">20-03-2002 11PM</p>
                    <p class="new-infor__description">Được xây dựng để phục vụ nhu cầu chơi game, chính vì vậy các linh kiện để xây dựng nên bộ PC Gaming Asus phải đáp ứng được tối thiểu các tựa game phổ biến hiện nay.
                        Được xây dựng để phục vụ nhu cầu chơi game, chính vì vậy các linh kiện để xây dựng nên bộ PC Gaming Asus phải đáp ứng được tối thiểu các tựa game phổ biến hiện nay.
                        Được xây dựng để phục vụ nhu cầu chơi game, chính vì vậy các linh kiện để xây dựng nên bộ PC Gaming Asus phải đáp ứng được tối thiểu các tựa game phổ biến hiện nay.
                        Được xây dựng để phục vụ nhu cầu chơi game, chính vì vậy các linh kiện để xây dựng nên bộ PC Gaming Asus phải đáp ứng được tối thiểu các tựa game phổ biến hiện nay.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="new">
                <div class="new-extension col l-5">
                    <img src="assets/img/news.png" alt="news" class="new-extension__img">
                    <button class="extra-extension__button">
                        Xem thêm
                    </button>
                    <div class="extra-extension__detail">Chi tiết</div>
                </div>
                <div class="new-infor col l-7">
                    <h2 class="new-infor__heading">Sân bóng đang được bảo trì</h2>
                    <p class="new-infor__date">20-03-2002 11PM</p>
                    <p class="new-infor__description">Được xây dựng để phục vụ nhu cầu chơi game, chính vì vậy các linh kiện để xây dựng nên bộ PC Gaming Asus phải đáp ứng được tối thiểu các tựa game phổ biến hiện nay.
                        Được xây dựng để phục vụ nhu cầu chơi game, chính vì vậy các linh kiện để xây dựng nên bộ PC Gaming Asus phải đáp ứng được tối thiểu các tựa game phổ biến hiện nay.
                        Được xây dựng để phục vụ nhu cầu chơi game, chính vì vậy các linh kiện để xây dựng nên bộ PC Gaming Asus phải đáp ứng được tối thiểu các tựa game phổ biến hiện nay.
                        Được xây dựng để phục vụ nhu cầu chơi game, chính vì vậy các linh kiện để xây dựng nên bộ PC Gaming Asus phải đáp ứng được tối thiểu các tựa game phổ biến hiện nay.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="new">
                <div class="new-extension col l-5">
                    <img src="assets/img/news.png" alt="news" class="new-extension__img">
                    <button class="extra-extension__button">
                        Xem thêm
                    </button>
                    <div class="extra-extension__detail">Chi tiết</div>
                </div>
                <div class="new-infor col l-7">
                    <h2 class="new-infor__heading">Sân bóng đang được bảo trì</h2>
                    <p class="new-infor__date">20-03-2002 11PM</p>
                    <p class="new-infor__description">Được xây dựng để phục vụ nhu cầu chơi game, chính vì vậy các linh kiện để xây dựng nên bộ PC Gaming Asus phải đáp ứng được tối thiểu các tựa game phổ biến hiện nay.
                        Được xây dựng để phục vụ nhu cầu chơi game, chính vì vậy các linh kiện để xây dựng nên bộ PC Gaming Asus phải đáp ứng được tối thiểu các tựa game phổ biến hiện nay.
                        Được xây dựng để phục vụ nhu cầu chơi game, chính vì vậy các linh kiện để xây dựng nên bộ PC Gaming Asus phải đáp ứng được tối thiểu các tựa game phổ biến hiện nay.
                        Được xây dựng để phục vụ nhu cầu chơi game, chính vì vậy các linh kiện để xây dựng nên bộ PC Gaming Asus phải đáp ứng được tối thiểu các tựa game phổ biến hiện nay.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>