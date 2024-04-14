<style>
    * {
        --primary-color: #306FBE;
        --primary-color-hover: #7fb0ec;
    }
    body {
        position: relative;
    }
    .display-none {
        display: none !important;
    }
    .display-block {
        display: block !important;
    }
    .container {
            margin: 90px 0 40px;
    }
    /* CSS common  */
    .arrow::before {
        position: absolute;
        top: -24px;
        right: 60px;
        content: "";
        border: 12px solid;
        border-color: transparent transparent white; 
        /* border-color: transparent transparent white transparent;  */
        /* border-right: 12px solid transparent; 
        border-bottom:12px solid white; 
        border-left: 12px solid transparent;  */

    }
    @keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(calc(100% + 32px));
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
    }

    @keyframes fadeOut {
    to {
        opacity: 0;
    }
    }
</style>
<script>
    var $ = document.querySelector.bind(document);
    var $$ = document.querySelectorAll.bind(document);
</script>