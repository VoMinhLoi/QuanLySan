    {{-- Responsive --}}
    <style>

        /* Header */
        #showMenuMobile:checked ~ .over-lay {
            display: block;
        }
        .over-lay {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.7);
            cursor: pointer;
            display: none;
        }
        #showMenuMobile:checked ~ .menu-mobile {
            display: block;
        }
        .menu-mobile {
            position: absolute;
            top: 100%;
            right: 0;
            background-image: linear-gradient(0deg,var(--primary-color),#4f8edc);
            height: 100vh;
            width: 370px;
            animation: slideInLeft ease .3s;
            transition: all 0.3s ease;
            display: none;
        }

        .menu-mobile-item:first-child {

        }
        .menu-mobile-item__link--close {
            position: absolute;
            top: 0;
            right: 0;
            background: white;
            color: var(--primary-color);
            height: 56px;
            line-height: 56px;
            width: 56px;
            text-align: center;
            cursor: pointer;
        }
        .menu-mobile-item__link--menu {
            display: block;
        }
        .menu-mobile-item__link--menu, .menu-mobile-item__link,.menu-mobile-item__link--has-sub-nav, .menu-mobile-sub-nav__item-link {
            padding: 16px 30px;
        }
        .menu-mobile-item__link, .menu-mobile-item__link--has-sub-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
        }
        .menu-mobile-item__link:hover {
            background: white;
            color: var(--primary-color);
        }

        .menu-mobile-item__link--has-sub-nav {
            border-bottom: 1px solid rgba(0, 0, 0, 0.7); 
        }
        .menu-mobile-sub-nav {
            transform: scaleY(0);
            transform-origin: top;
            opacity: 0;
            overflow: hidden;
            transition: all ease 0.3s;
        }
        @keyframes OverFlow{
            100% {
                transform: scaleY(1);
                opacity: 1;
            }
        }
        .menu-mobile-sub-nav__item-link {
            display: block;
            background: white;
            color: var(--primary-color);
        }
        .menu-mobile-sub-nav__item-link:hover {
            color: red;
        }
        @media screen and (max-width: 1367px) {
            ul.header-navigation {
                display: none;
            }
            .header-private-item--bars {
                display: block;
            }
            div.arrow::before {
                right: 40px;
            }
        }
        @media screen and (min-width: 1368px) {
            .header-private-item--bars {
                display: none;
            }
        }
        @media screen and (max-width: 739px) {
            /* Header */
            .menu-mobile {
                width: 100vw;
            }
            /* Footer */
            .footer-contact {
                margin-left: 0 !important;
                text-align: center;
                margin-top: 20px; 
            }
            h4.footer-contact__heading::after {
                left: 50%;
                transform: translateX(-50%)
            }
            .footer-contact__list-social {
                justify-content: center;
            }
            /* Container book */
            .sorting-view__heading {
                display: none;
            }
            
            .fullname {
                display: none;
            }
            .image-box {
                /* height: unset; */
            }
            div.sorting-search {
                width: 100%;
            }
        }
        .animationOverFlow {
            animation: OverFlow 0.2s linear 0s forwards;
        }
        .rotate90{
            transform: rotate(180deg);
            transition: all ease 0.3s;
        }
    </style>
