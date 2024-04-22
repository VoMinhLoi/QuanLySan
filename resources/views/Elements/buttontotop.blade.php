<style>
    #scrollToTopBtn {
  display: none;
  position: fixed;
  bottom: 20px;
  right: 20px;
  z-index: 99;
  font-size: 18px;
  border: 1px solid black;
  outline: none;
  background-color: var(--primary-color);
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 50%;
  width: 58px;
  height: 58px;
}

#scrollToTopBtn:hover {
    background-color: white;
    color: var(--primary-color);
}
</style>
<button onclick="scrollToTop()" id="scrollToTopBtn" title="Go to top"><i class="fa-solid fa-arrow-up"></i></button>

<script>
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
    var scrollToTopBtn = document.getElementById("scrollToTopBtn");
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollToTopBtn.style.display = "block";
    } else {
        scrollToTopBtn.style.display = "none";
    }
    }

    function scrollToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
    }
</script>