<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <style>
      * {
        margin: 0;
        padding: 0;
      }
      .slider {
        position: relative;
        margin-top: 90px;
        height: 695px;
        /* width: 1066px; */
      }
      /* @media screen and (max-width: 1065px) {
        .slider {
          width: 100%;
        }
      } */
      .slider-navigation {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 1;
      }
      .slider-navigation--prev {
        left: 30px;
      }

      .slider-navigation--after {
        right: 30px;
      }

      .slider-navigation__button {
        background-color: #ccc;
        opacity: 0.5;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: none;
        cursor: pointer;
        transition: all ease 0.3s;
      }
      .slider-navigation__button:hover {
        opacity: 1;
      }
      .slider-navigation__button--prev:hover {
        transform: translateX(-10px);
      }
      .slider-navigation__button--after:hover {
        transform: translateX(10px);
      }

      .slider-content,
      .slider-content-item,
      .slider-content-item__list-image {
        height: 100%;
      }

      .slider-content__context {
        position: absolute;
        top: 60%;
        text-align: center;
        width: 100%;
        color: white;
        text-shadow: 
        -1px -1px 0 #000,  
         1px -1px 0 #000,
        -1px  1px 0 #000,
         1px  1px 0 #000;
        z-index: 1;
      }
      .slider-content__context-desc {
        margin: 10px;
      }

      .slider-content__context-book-link {
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        text-decoration: none;
        display: block;
        width: fit-content;
        margin: auto;
        text-align: center;
        background-color: rgba(227, 34, 34, 0.7);
      }

      .slider-content__context-book-link:hover {
        background-color: rgba(227, 34, 34, 1);
      }

      .slider-content-item {
        overflow: hidden;
      }

      .slider-content-item__list-image {
        display: flex;
        /* overflow: hidden; */
        transition: all ease 0.3s;
      }

      .slider-content-item__list-image-background {
        width: 100%;
        height: auto;
        object-fit: cover;
      }
      .slider-dots {
        position: absolute;
        bottom: 5px;
        left: 50%;
        transform: translateX(-50%);
        text-align: center;
        display: flex;
        list-style: none;
        justify-content: center;
        color: white;
      }
      .slider-dots__item + .slider-dots__item {
        margin-left: 4px;
      }
      .slider-dots__item-button {
        width: 16px;
        height: 16px;
        background: rgba(255, 255, 255, 0);
        border: 1px solid white;
        border-radius: 50%;
        cursor: pointer;
      }
      .slider-dots__item-button:hover {
        background: rgba(255, 255, 255, 0.5);
      }

      .slider-dots__item-button--active {
        background: rgba(255, 255, 255, 1) !important;
      }
    </style>
  </head>
  <body>
    <div class="slider">
      <div class="slider-navigation slider-navigation--prev">
        <button
          class="slider-navigation__button slider-navigation__button--prev"
        >
          <i class="fa-solid fa-arrow-left"></i>
        </button>
      </div>
      <div class="slider-content">
        <div class="slider-content-item">
          <div class="slider-content__context">
            <h2 class="slider-content__context-heading">
              Sân bóng hiện đại cho dân banh
            </h2>
            <p class="slider-content__context-desc">
              Để đạt được kết quả tốt trong mọi việc ta cần xác định mục tiêu rõ
              ràng cho việc đó.
            </p>
            <div class="slider-content__context-book">
              <a class="slider-content__context-book-link" href="#"
                >Đặt sân ngay</a
              >
            </div>
          </div>
          <div class="slider-content-item__list-image">
            <!-- <img
              class="slider-content-item__list-image-background"
              src="test.jpg"
              alt="slide image"
            /> -->
          </div>
        </div>
      </div>
      <div class="slider-navigation slider-navigation--after">
        <button
          class="slider-navigation__button slider-navigation__button--after"
        >
          <i class="fa-solid fa-arrow-right"></i>
        </button>
      </div>
      <ul class="slider-dots"></ul>
    </div>

    <script>
      var data = [
        {
          imageURL: "slider1.jpg",
        },
        {
          imageURL: "slider2.jpg",
        },
        {
          imageURL: "slider3.jpg",
        },
        {
          imageURL: "slider4.jpg",
        },
      ];
      sliderImage(0, data, 5000);

      function sliderImage(current, slides, time) {
        var $ = document.querySelector.bind(document);
        var listImage = $(".slider-content-item__list-image");

        slides.forEach((slide, index) => {
          listImage.innerHTML += `
            <img class="slider-content-item__list-image-background" src="assets/img/${slide.imageURL}" alt="slide image"/>
          `;
        });
        var image_0 = listImage.querySelector(
          ".slider-content-item__list-image-background"
        );
        var imageQuantity = listImage.childElementCount;
        var listDots = document.querySelector(".slider-dots");
        for (let i = 0; i < imageQuantity; i++)
          listDots.innerHTML += `<li class="slider-dots__item"><button class="slider-dots__item-button slider-dots__item-button-${i}" data-set="${i}"></button></li>`;
        var dotIsActive = listDots.querySelector(
          ".slider-dots__item-button-" + current
        );
        dotIsActive.classList.add("slider-dots__item-button--active");

        // current = 0 Thì mới vào translate 0 thì đứng yên chỗ ban đầu
        var autoSlide = setInterval(handleChangeSlideAfter, time);
        var buttonPrev = document.querySelector(
          ".slider-navigation__button--prev"
        );
        buttonPrev.onclick = () => {
          clearInterval(autoSlide);
          handleChangeSlidePrev();
          autoSlide = setInterval(handleChangeSlideAfter, time);
        };
        var buttonAfter = document.querySelector(
          ".slider-navigation__button--after"
        );
        buttonAfter.addEventListener("click", () => {
          clearInterval(autoSlide);
          handleChangeSlideAfter();
          autoSlide = setInterval(handleChangeSlideAfter, time);
        });

        function handleChangeSlidePrev() {
          const width = image_0.offsetWidth;
          if (current == 0) {
            current = imageQuantity - 1;
            listImage.style.transform = `translateX(${width * -current}px)`;
          } else {
            current--;
            listImage.style.transform = `translateX(${width * -current}px)`;
          }
          handleCircle();
        }
        function handleChangeSlideAfter() {
          const width = image_0.offsetWidth;
          if (current == imageQuantity - 1) {
            current = 0;
            listImage.style.transform = "translateX(0px)";
          } else {
            ++current;
            listImage.style.transform = `translateX(${width * -current}px)`;
          }
          handleCircle();
        }
        function handleCircle() {
          var dotActiving = listDots.querySelector(
            ".slider-dots__item-button--active"
          );
          if (dotActiving)
            dotActiving.classList.remove("slider-dots__item-button--active");
          var dotIsActive = listDots.querySelector(
            ".slider-dots__item-button-" + current
          );
          dotIsActive.classList.add("slider-dots__item-button--active");
        }
        function chooseImage() {
          listDots.onclick = (e) => {
            const width = image_0.offsetWidth;
            clearInterval(autoSlide);
            current = Number(e.target.dataset.set);
            listImage.style.transform = `translateX(${width * -current}px)`;
            autoSlide = setInterval(handleChangeSlideAfter, time);
            handleCircle();
          };
        }
        chooseImage();
      }
    </script>
  </body>
</html>