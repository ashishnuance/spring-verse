<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Spring Verse</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <style>
    body {
        font-family: 'Lora', serif;
    }

    .landing-wraper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
        position: relative;
        overflow: hidden;
    }

    .landing-wraper .brandLogo {
        padding: 30px;
    }

    .landing-wraper .brandLogo img {
        width: 200px;
    }

    .landing-wraper .container {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .landing-wraper .container .row {
        flex: 1;
        align-items: center;
    }

    .landing-wraper .landingInfo h1 {
        font-weight: 400;
        font-size: 55px;
        color: #000000;
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
    }

    .landing-wraper .landingInfo h1 img {
        width: 420px;
    }

    .landingSlider .swiper-slide img {
        width: 100%;
        object-fit: cover;
        aspect-ratio: 1/1;
        border-radius: 10px;
    }

    .joinNow-btn {
        text-decoration: none;
        padding: 14px 30px;
        margin-top: 20px;
        background: #7a438e;
        color: #fff;
        border-radius: 15px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 180px;
        transition: all 0.3s ease-in-out;
    }

    .joinNow-btn:hover {
        color: #fff;
        background: #000;
    }

    .landingFooter {
        padding: 20px 15px;
        background: #73468A;
        text-align: center;
        margin-top: 20px;
    }

    .landingFooter h6 {
        margin: 0;
        color: #fff;
        font-size: 20px;
        font-weight: 400;
    }

    .wave-bg {
        position: absolute;
        width: 100%;
        top: 0;
        min-height: 100vh;
        pointer-events: none;
    }

    .wave-bg img {
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
    }

    @media (max-width: 767.98px) {
        .landing-wraper .brandLogo {
            padding: 15px;
        }

        .landing-wraper .brandLogo img {
            width: 150px;
        }

        .landing-wraper .landingInfo h1 {
            font-size: 34px;
            align-items: center;
        }

        .landing-wraper .landingInfo h1 img {
            width: 200px;
        }
    }

    @media (max-width: 320px) {

        .landing-wraper .brandLogo img {
            width: 120px;
        }

        .landing-wraper .landingInfo h1 {
            font-size: 24px;
        }

        .landing-wraper .landingInfo h1 img {
            width: 170px;
        }
    }
    </style>
</head>

<body>

    <section class="landing-wraper">
        <div class="brandLogo">
            <img src="{{ asset('frontend/images/sv-logo.png') }}" alt="">
        </div>

        <div class="wave-bg">
            <img src="{{ asset('frontend/images/transparent-wave.png') }}" alt="">
        </div>

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-8">
                    <div class="landingInfo">
                        <h1>We are global.</h1>
                        <h1>We are creative.</h1>
                        <h1>
                            We are
                            <img src="{{ asset('frontend/images/sv-logo.png') }}" alt="">
                        </h1>

                        <a href="{{route('login')}}" class="joinNow-btn">Join Now</a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="swiper landingSlider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/images/slide1.png') }}" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/images/slide2.png') }}" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('frontend/images/slide3.png') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="landingFooter">
            <h6>Officially launching June 2023</h6>
        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

    <script>
    var swiper = new Swiper(".landingSlider", {
        effect: "fade",
        loop: true,
        speed: 1000,
        autoplay: {
            delay: 4000,
            disableOnInteraction: false,
        },
    });
    </script>
</body>

</html>