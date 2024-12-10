<?php

if (isset($_GET["course-id"])) {
    $courseId = $_GET["course-id"];
    $rolId = $_SESSION['Rid'];

    $courseController = new CourseController();
    $discountController = new DiscountController();
    $moduleController   = new ModuleController();
    $sportController    = new SportController();
    $discountController    = new DiscountController();

    $course = $courseController->getCourseById($courseId);
    $discount = $discountController->getAllDiscount();

    // Depuración: imprimir el contenido de $course

    $imageCourse = $course["CIimage"];
    $status = $course["Cstatus"];
    $dataQH = $courseController->getCourseByIdQH($courseId);

    include 'course-validation.php';
    include 'course-pagination.php';
    include 'course-modal.php';
    include 'course-pagination-available.php';
}
?>


<div class="iq-navbar-header" style="height: 100px;">

    <div class="iq-header-img">
        <img src="./../assets/image/dashboard/top-header.png" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header1.png" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header2.png" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header3.png" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header4.png" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
        <img src="./../assets/image/dashboard/top-header5.png" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
    </div>
</div>





<div class="container-fluid content-inner mt-n5 py-0" id="page_layout">
    <div class="row">
        <div class="col-lg-12">

            <div class="card  p-5">
                <div class="card-body">
                    <div class="row ">


                        <div id="terminos-condiciones" class="text-dark"  style="font-size: 20px; color: black; text-align: justify; " >
                            <h2><center><b>Términos y Condiciones para las Inscripciones en los Cursos Vacacionales de la Concentración Deportiva de Pichincha, 2024</b></center></h2>
                            <p style="font-size: 20px; color: black" class="p-3">Por favor, lee detenidamente los siguientes términos y condiciones antes de inscribirte en cualquiera de nuestros cursos vacacionales:</p>
                           <p>
                             <ol >
                                <li><strong>Pago y Cancelación:</strong>
                                    <ol type="a">
                                        <li style=" text-align: justify;">Al comprar un cupo en cualquiera de nuestros cursos deportivos, aceptas que el pago es no reembolsable bajo ninguna circunstancia.</li>
                                        <li style=" text-align: justify;">No se permiten cambios de curso una vez realizada la inscripción.</li>
                                    </ol>
                                </li>
                                <li><strong>Inscripción:</strong>
                                    <ol type="a">
                                    <li style=" text-align: justify;">La inscripción en nuestros cursos está sujeta a disponibilidad de cupos y se asignará por orden de llegada del pago.</li>
                                    <li style=" text-align: justify;">Nos reservamos el derecho de cancelar cualquier curso si no se alcanza el número mínimo de participantes. En ese caso, se ofrecerá apertura de un nuevo horario bajo restricciones; o el usuario que que se haya inscrito sin que no exitan cupos debe realizar la solicitud de reembolso despues la culminación de los curso vacacionales 2024 en las oficina Matriz de la Concentración Deportiva de Pichincha.</li>
                                    </ol>
                                </li>
                                <li><strong>Responsabilidad del Participante:</strong>
                                    <ol type="a">
                                    <li style=" text-align: justify;">Los participantes deben cumplir con los requisitos de edad y habilidad establecidos para cada curso.</li>
                                    <li style=" text-align: justify;">Es responsabilidad del participante o del tutor legal asegurarse de que el participante esté en condiciones de participar en el curso seleccionado.</li>
                                    </ol>
                                </li>
                                <li><strong>Cambio de Horarios:</strong>
                                    <ol type="a">
                                    <li style=" text-align: justify;">Nos reservamos el derecho de modificar horarios, fechas o ubicaciones de los cursos por razones logísticas o de fuerza mayor. En tal caso, se informará a los participantes con la mayor antelación posible.</li>
                                    </ol>
                                </li>
                                <li><strong>Normas de Conducta:</strong>
                                    <ol type="a">
                                    <li style=" text-align: justify;">Se espera que todos los participantes se comporten de manera respetuosa hacia los instructores, el personal y otros participantes durante el curso. El incumplimiento de esta norma puede resultar en la expulsión del participante sin derecho a reembolso.</li>
                                    </ol>
                                </li>
                            </ol>
                           </p>
                            <p style="font-size: 20px; color: black" class="p-3">Al inscribirte en cualquiera de nuestros cursos vacacionales 2024, aceptas automáticamente todos los términos y condiciones establecidos anteriormente.</p>
                            <p style="font-size: 20px; color: black" class="p-3">Para cualquier pregunta o aclaración adicional, no dudes en ponerte en contacto con nuestro equipo de atención al cliente.</p>
                            <p style="font-size: 20px; color: black" class="p-3"><center>Gracias por elegir nuestros cursos vacacionales. <br>¡Esperamos que tengas una experiencia increíble!</center></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>