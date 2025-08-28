<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Left Aligned Icons & Text -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="column-container">


    <div class="column-one-third">
        <div class="icons-column">
            <!-- Icon Backing -->
            <div class="icon-backing" style="background-color: #6E6588;">
                <!-- Icon -->
                <i class="fa">O</i>
            </div>
        </div>
        <div class="content-column">
            <!-- Title -->
            <h3>Obfuscation</h3>
            <!-- Text -->
            <p>Obfuscation scrambles PHP source code so that the code is extremely difficult to understand , encrypts quickly and safely large projects are no problem for my tool</p>
        </div>
    </div>

    <div class="column-one-third">
        <div class="icons-column">
            <!-- Icon Backing -->
            <div class="icon-backing" style="background-color: #66b9b4;">
                <!-- Icon -->
                <i class="fa">C</i>
            </div>
        </div>
        <div class="content-column">
            <!-- Title -->
            <h3>Ciphers Encryption</h3>
            <!-- Text -->
            <p>Lock down your code set your own key, select your code type to integrate with it, <a
                    href="http://en.wikipedia.org/wiki/Cipher" target="_blank">ciphers</a> supported by the mcrypt
                extension </p>
        </div>
    </div>

    <div class="column-one-third">
        <div class="icons-column">
            <!-- Icon Backing -->
            <div class="icon-backing" style="background-color: #63885F;">
                <!-- Icon -->
                <i class="fa">B</i>
            </div>
        </div>
        <div class="content-column">
            <!-- Title -->
            <h3>Blowfish Encription</h3>
            <!-- Text -->
            <p>Encode your project fully and set your own key using <a href="http://pecl.php.net/package/BLENC"
                                                                       target="_blank">BLENC</a> open source, Ncryptd
                will bring a PDF report included all keys files</p>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END One Third -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Left Aligned Icons & Text -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Latest News / Testimonials (Three Quater/One Fourth) -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="column-container">

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Latest News Columns -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="column-three-qtr">

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Divider -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="divider"></div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END Divider -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Title -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <h3 class="section-title">Who's join us ?</h3>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END Title -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <div id="blog-nav" class="carousel-nav">
        <div class="back"></div>
        <div class="next"></div>
    </div>

    <div class="carousel team ">
        <ul id="blog-carousel" class="slider-container">

            @foreach($users as $user)

            <li class="column-one-fourth">
                <!-- Image -->
                <a href="#" class=""><img alt="{{ $user->first_name }} registered at ncryptd " src="{{ $user->avatar }}" class="fullwidth"/></a>
                <!-- Title -->
                <h3><a href="#">{{ $user->first_name }}</a></h3>
                <!-- Date -->
                <div class="date">Registered at {{ $user->created_at }}</div>
                <!-- Excerpt -->
                {{--<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of...</p>--}}
                <p></p>
                <ul class="social">
                    <li>
                        <a href="#"><i class="fa fa-linkedin-square"></i><div class="tooltip">LinkedIn</div></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-github"></i><div class="tooltip">Github</div></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-google-plus"></i><div class="tooltip">Google+</div></a>
                    </li>
                </ul>
            </li>

            @endforeach



        </ul>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END Carousel -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Latest News Columns -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Testimonials Column -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="column-one-fourth">

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Divider -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="divider"></div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END Divider -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Title -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <h3 class="section-title">Testimonials</h3>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END Title -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Navigation (Back/Next) -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div id="testimonials-nav" class="carousel-nav">
        <div class="back"></div>
        <div class="next"></div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END Navigation (Back/Next) -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Carousel -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="carousel">
        <ul id="testimonials-carousel" class="slider-container">

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- Testimonial 1 -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <li class="column-one-fourth">
                <!-- Text -->
                <div class="testimonial-text">
                    <p>"What ever happened to predictability? Everywhere you look, everywhere you go, there's a
                        heart, a hand to hold onto."</p>
                </div>
                <!-- Name -->
                <div class="testimonial-name">
                    Joe
                </div>
                <!-- Company URL -->
                <div class="testimonial-link">
                    <a href="#">DM3</a>
                </div>
            </li>
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- END Testimonial 1 -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- Testimonial 2 -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <li class="column-one-fourth">
                <!-- Text -->
                <div class="testimonial-text">
                    <p>"ncryptd have proven time and time again that they can deliver results on time!"</p>
                </div>
                <!-- Name -->
                <div class="testimonial-name">
                    Sami
                </div>
                <!-- Company URL -->
                <div class="testimonial-link">
                    <a href="#">GoodSite</a>
                </div>
            </li>
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
            <!-- END Testimonial 2 -->
            <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

        </ul>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END Carousel -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Testimonials Column -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Latest News / Testimonials -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->