@php
    $home_about = \App\Models\About::find(1);
    $all_multiple_image = \App\Models\MultiImage::all();
@endphp

<section id="aboutSection" class="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <ul class="about__icons__wrap">
                    @foreach($all_multiple_image as $item)
                        <li>
                            <img class="light" src="{{ asset($item->multi_image) }}" alt="">
                            <img class="dark" src="{{ asset($item->multi_image) }}" alt="">
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-6">
                <div class="about__content">
                    <div class="section__title">
                        <span class="sub-title">{{ $home_about->title }}</span>
                        <h2 class="title">{{ $home_about->short_title }}</h2>
                    </div>
                    <div class="about__exp">
                        <div class="about__exp__icon">
                            <img src="{{ asset('frontend/assets/img/icons/about_icon.png') }}" alt="">
                        </div>
                        <div class="about__exp__content">
                            {{ $home_about->short_description }}
                        </div>
                    </div>
                    <p class="desc">I love to work in User Experience & User Interface designing. Because I love to solve the design problem and find easy and better solutions to solve it. I always try my best to make good user interface with the best user experience. I have been working as a UX Designer</p>
                    <a href="about.html" class="btn">Download my resume</a>
                </div>
            </div>
        </div>
    </div>
</section>
