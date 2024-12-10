<script>
    function activateItem(element) {
        var menuItems = document.querySelectorAll('.nav-item');
        menuItems.forEach(function(item) {
            item.classList.remove('active', 'text-primary');
        });
        element.parentElement.classList.add('active');
        element.classList.add('text-primary');
    }
    var currentPage = window.location.href.split('/').pop().split('#')[0].split('?')[0];
    var menuLinks = document.querySelectorAll('.nav-item a');
    menuLinks.forEach(function(link) {
        if (link.getAttribute('href') === currentPage) {
            link.parentElement.classList.add('active');
            link.classList.add('text-primary');
        }
    });
</script>
 
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-16638158956">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-16638158956');
    </script>

    <!-- Google tag (gtag.js) event - delayed navigation helper -->
    <script>
        // Helper function to delay opening a URL until a gtag event is sent.
        // Call it in response to an action that should navigate to a URL.
        function gtagSendEvent(url) {
            var callback = function() {
                if (typeof url === 'string') {
                    window.location = url;
                }
            };
            gtag('event', 'ads_conversion_Suscripci_n_1', {
                'event_callback': callback,
                'event_timeout': 2000,
                // <event_parameters>
            });
            return false;
        }
    </script>


    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4F5FVRRB9D"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-4F5FVRRB9D');
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-WMWZ37VQ');
    </script>
    <!-- End Google Tag Manager -->

<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6120195628005897" crossorigin="anonymous"></script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var logoutTimer;
        var timerElement = document.getElementById('timer');
        var countdownTime = <?php echo $inactive_time; ?>; // Tiempo de inactividad en segundos
        var inactiveInterval = 30 * 60 * 1000; // 5 minutos en milisegundos (ajusta según tus necesidades)

        function startLogoutTimer() {
            // Mostrar el tiempo inicial
            displayTime(countdownTime);

            // Iniciar el temporizador
            logoutTimer = setInterval(function() {
                countdownTime--;
                displayTime(countdownTime);

                // Si el tiempo llega a cero, redirigir al inicio de sesión
                if (countdownTime <= 0) {
                    clearInterval(logoutTimer);
                    window.location.href = './../';
                }
            }, 1000); // Actualizar cada segundo
        }

        function displayTime(seconds) {
            var minutes = Math.floor(seconds / 60);
            var remainingSeconds = seconds % 60;

            // Formatear el tiempo para mostrarlo como MM:SS
            var formattedTime = (minutes < 10 ? '0' : '') + minutes + ':' + (remainingSeconds < 10 ? '0' : '') + remainingSeconds;
            timerElement.textContent = formattedTime;
        }

        // Llamar a startLogoutTimer() al cargar la página
        startLogoutTimer();

        var inactiveTimeout;

        // Función para reiniciar el temporizador de inactividad
        function resetInactiveTimeout() {
            clearTimeout(inactiveTimeout);
            inactiveTimeout = setTimeout(function() {
                clearInterval(logoutTimer);
                countdownTime = <?php echo $inactive_time; ?>;
                startLogoutTimer();
            }, inactiveInterval);
        }

        // Event Listeners para detectar interacciones del usuario
        document.addEventListener('mousemove', resetInactiveTimeout);
        document.addEventListener('keypress', resetInactiveTimeout);

        // Iniciar el primer temporizador de inactividad
        resetInactiveTimeout();
    });
</script>

<!-- Library Bundle Script -->
<script src="./../assets/js/core/libs.min.js"></script>

<!-- External Library Bundle Script -->
<script src="./../assets/js/core/external.min.js"></script>

<!-- Widgetchart Script -->
<script src="./../assets/js/charts/widgetcharts.js"></script>

<!-- mapchart Script -->
<script src="./../assets/js/charts/vectore-chart.js"></script>
<script src="./../assets/js/charts/dashboard.js"></script>

<!-- fslightbox Script -->
<script src="./../assets/js/plugins/fslightbox.js"></script>

<!-- Settings Script -->
<script src="./../assets/js/plugins/setting.js"></script>

<!-- Slider-tab Script -->
<script src="./../assets/js/plugins/slider-tabs.js"></script>

<!-- Form Wizard Script -->
<script src="./../assets/js/plugins/form-wizard.js"></script>

<!-- AOS Animation Plugin-->
<script src="./../assets/vendor/aos/dist/aos.js"></script>

<!-- App Script -->
<script src="./../assets/js/hope-ui.js"></script>

<script src="./../assets/js/ecommerce.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script></body> -->

<!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="./../assets/js/report.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4F5FVRRB9D"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-4F5FVRRB9D');
</script>
</body>

</html>