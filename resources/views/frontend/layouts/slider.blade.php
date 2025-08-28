<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- Home Banner ("light" and "dark" style can be applied here) -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="home-banner dark">

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Slides -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <ul class="slider-container" id="home-slider">


        <!-- ~~~~~~~~~~~~~~~~~ -->
        <!-- Slide 0 (Big Title & Text) -->
        <!-- ~~~~~~~~~~~~~~~~~ -->
        <li class="slide-outer">
            <div class="slide-inner">
                <div class="content-width">
                 <div class="slide-style-0">
                    <!-- Title -->
                    <h1 style="visibility: hidden">Professional php  <span>obfuscator</span> and <span>encryptor</span></h1>
                    <div class="window">
                        <nav>
                        <a href="#" class="close"></a>
                        <a href="#" class="minimize"></a>
                        <a href="#" class="maximize"></a>
                        <h1>Ncryptd</h1>
                        </nav>
                        <div class="container type-wrap">
                            <span id="typed" style="white-space:pre;"></span>
                        </div>
                    </div>
                 </div>
                 </div>
            </div>

        <div id="thecode" style="display: none"><pre><code>/**
 * @author Hany alsamman (<hany.alsamman@gmail.com>)
 */
class dbconnector
{
        private static $_singleton;
        private $_connection;

        private function __construct()
        {
            $this->_connection = mysql_connect($this->HOST, $this->USER_NAME, $this->USER_PASSWORD);
        }
}
        </code></pre>
        </div>
        </li>

        <li class="slide-outer">
            <div class="slide-inner">
                <div class="content-width">
                    <div class="slide-style-git slide-style-2">
                        <!-- Title -->
                        <h1><i class="fa fa-github"></i> <Br> Ncryptd is <span>open-source!</span></h1>
                        <!-- Text -->
                        <p>Want to <b>Contribute?</b>
                            Help make Ncryptd <b>better</b> by checking out the GitHub repository and submitting pull requests.
                            If you find a bug please report it on the issues page.</p>

                        <a class="button accent" href="https://github.com/codex-corp/ncryptd"><i class="fa fa-github-alt"></i>View Project on Github</a>
                        <a class="button accent" href="http://codexc.com/blog/#filter=.contact">Give some feedback <i class="fa fa-heart"></i></a>

                    </div>
                </div>
            </div>
        </li>

        <!-- ~~~~~~~~~~~~~~~~~ -->
        <!-- Slide 1 (Big Title & Text) -->
        <!-- ~~~~~~~~~~~~~~~~~ -->
        <li class="slide-outer">
            <div class="slide-inner">
                <div class="content-width">
                    <div class="slide-style-1">
                        <!-- Title -->
                        <h1>Encode Your PHP Applications <span>For</span> Free <span>!</span></h1>
                        <!-- Text -->
                        <p>Welcome to Ncryptd, This site was created to encrypt your applications to protect your source code from being stolen
                            <br>
                            The best part about this site is encryption of your code  is free
                        </p>
                    </div>
                </div>
            </div>
        </li>
        <!-- ~~~~~~~~~~~~~~~~~ -->
        <!-- END Slide 1 -->
        <!-- ~~~~~~~~~~~~~~~~~ -->

        <!-- ~~~~~~~~~~~~~~~~~ -->
        <!-- Slide 2 (Centered Icon & Text) -->
        <!-- ~~~~~~~~~~~~~~~~~ -->
        <li class="slide-outer">
            <div class="slide-inner">
                <div class="content-width">
                    <div class="slide-style-2">
                        <!-- Title -->
                        <h1><img alt="" src="{{{ asset('assets/images/laravel_logo.png') }}}" /> <Br> Laravel Code and Concept Support<span>.</span></h1>
                        <!-- Text -->
                        <p>obfuscate scrambles classes, functions, variables and will replace your <b>routes</b> settings  <b>automatic</b></p>
                    </div>
                </div>
            </div>
        </li>
        <!-- ~~~~~~~~~~~~~~~~~ -->
        <!-- END Slide 2 -->
        <!-- ~~~~~~~~~~~~~~~~~ -->

        <!-- ~~~~~~~~~~~~~~~~~ -->
        <!-- Slide 3 (Left Text / Right Image) -->
        <!-- ~~~~~~~~~~~~~~~~~ -->
        <li class="slide-outer">
            <div class="slide-inner">
                <div class="content-width">
                    <div class="slide-style-3">
                        <!-- ~~~~~~~~~~~~~~~~~ -->
                        <!-- Left Column -->
                        <!-- ~~~~~~~~~~~~~~~~~ -->
                        <div class="left-column">
                            <!-- Title -->
                            <h1>PROTECT YOUR JAVASCRIPT <span>!</span></h1>
                            <!-- Text -->
                            <p>Ncryptd is the simplest, fastest and strongest solution to protect your JavaScript!</p>
                            <!-- Button -->
                            <a class="button accent" href="#"><i class="fa fa-info-circle"></i>Soon!</a>
                        </div>
                        <!-- ~~~~~~~~~~~~~~~~~ -->
                        <!-- END Left Column -->
                        <!-- ~~~~~~~~~~~~~~~~~ -->
                        <!-- ~~~~~~~~~~~~~~~~~ -->
                        <!-- Right Column -->
                        <!-- ~~~~~~~~~~~~~~~~~ -->
                        <div class="right-column">
                            <!-- Image -->
                            <img alt="" height="400" src="{{{ asset('assets/images/cube.magic.png') }}}" />
                        </div>
                        <!-- ~~~~~~~~~~~~~~~~~ -->
                        <!-- END Right Column -->
                        <!-- ~~~~~~~~~~~~~~~~~ -->
                    </div>
                </div>
            </div>
        </li>
        <!-- ~~~~~~~~~~~~~~~~~ -->
        <!-- END Slide 3 -->
        <!-- ~~~~~~~~~~~~~~~~~ -->

    </ul>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END Slides -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- Banner Navigation Bar -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="slider-nav-container">
        <div class="slider-nav-inner">
            <div class="slider-nav content-width">

                <!-- ~~~~~~~~~~~~~~~~~ -->
                <!-- Slide Links -->
                <!-- ~~~~~~~~~~~~~~~~~ -->
                <ul id="bx-pager">
                    <li><a data-slide-index="0" href="">How it works</a></li>
                    <li><a data-slide-index="1" href="">Ncryptd is open-source</a></li>
                    <li><a data-slide-index="2" href="">Protect php project</a></li>
                    <li><a data-slide-index="3" href="">Frameworks Support</a></li>
                    <li><a data-slide-index="4" href="">Protect javascript</a></li>
                </ul>
                <!-- ~~~~~~~~~~~~~~~~~ -->
                <!-- END Slide Links -->
                <!-- ~~~~~~~~~~~~~~~~~ -->

                <!-- ~~~~~~~~~~~~~~~~~ -->
                <!-- Slide Controls -->
                <!-- ~~~~~~~~~~~~~~~~~ -->
                <div class="slider-controls">
                    <div id="slider-pause"></div>
                    <div id="slider-prev"></div>
                    <div id="slider-next"></div>
                </div>
                <!-- ~~~~~~~~~~~~~~~~~ -->
                <!-- END Slide Controls -->
                <!-- ~~~~~~~~~~~~~~~~~ -->

            </div>
        </div>
    </div>
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!-- END Banner Navigation Bar -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END Home Banner -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- CTA Bar - Set "white", "accent" or "dark" -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<div class="home-cta-bar-container accent">

    <div class="content-width">
        <div class="home-cta-bar">
            <!-- Text -->
            <div class="text">
                Ncryptd it's your super awesome tool to be safely, So what are you waiting ? go and give a try !
            </div>
            <!-- Button -->
            <div class="home-cta-bar-button">
                <a href="admin/project/create" class="button transparent"><i class="fa fa-check-square"></i>GET STARTED</a>
            </div>
        </div>
    </div>

</div>
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
<!-- END CTA Bar -->
<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
