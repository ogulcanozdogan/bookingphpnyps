<script defer>
document.addEventListener("DOMContentLoaded", function() {
    if (document.querySelector('.owl-carousel')) {
        var script1 = document.createElement("script");
        script1.src = "js/jquery-3.6.0.min.js";
        script1.onload = function() {
            var script2 = document.createElement("script");
            script2.src = "js/owl.carousel.min.js";
            document.body.appendChild(script2);
        };
        document.body.appendChild(script1);
    }
});

</script>
