<x-guest-layout>
    @section('title', $title)

    @section('page-style')
        <!-- Menu -->
        @vite(['resources/assets/css/pages/home.css'])
    @endsection

    <x-big-banner :imgUrl="'assets/img/backgrounds/home-bg.jpg'">
        <div class="col-md-8 col-sm-12 text-center">
            <span class="subheading">Welcome</span>
            <h1 class="mb-4">The Best Coffee Testing Experience</h1>
            <p class="mb-4 mb-md-5">
                A small river named Duden flows by
                their place and supplies it with the
                necessary regelialia.
            </p>
            <p>
                <a href="#" class="btn btn-primary p-3 px-xl-4 py-xl-3">Mua ngay</a>
                <a href="{{ route('menu') }}" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Xem sản phẩm</a>
            </p>
        </div>
    </x-big-banner>

    <x-intro />

    <section class="container" style="padding: 120px 0;">
        <div class="row px-0">
            <img class="col-12 col-md-6 pb-5 pb-md-0" data-aos="fade-up"
                src="https://raw.githubusercontent.com/letuyen2102/coffee_shop/letuyen-21522778/public/images/about.jpg"
                alt="">

            <div class="col-12 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <p class="fs-2 title-tertiary">Discover</p>
                <p class="fs-2 title-primary">OUR STORY</p>

                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Suscipit minima obcaecati eligendi ratione
                    possimus
                    illo dolorum iste amet dicta, fugiat laudantium soluta debitis! Ad incidunt dignissimos dolorem
                    placeat
                    asperiores assumenda.</p>
            </div>
        </div>
    </section>

    <section class="feature bg-color-yellow mx-0">
        <div class="row" style="width:100%;">
            <div class="order col-12 col-md-4 py-4 py-md-0" data-aos="fade-up">
                <p class="text-center"><i class=" fa-solid fa-bars fs-1"></i></p>
                <p class="text-center fs-3">Easy to order</p>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolorum fugit tempore quam provident
                    nesciunt a
                    incidunt omnis iusto veritatis recusandae nam quis nostrum nobis soluta earum nisi, inventore nulla
                    asperiores?</p>
            </div>
            <div class="delivery col-12 col-md-4 py-4 py-md-0" data-aos="fade-up" data-aos-delay="50">
                <p class="text-center"><i class="fa-solid fa-truck fs-1"></i></p>
                <p class="text-center fs-3">Fastest delivery</p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolor, reiciendis. Nulla odio doloremque
                    omnis
                    minus nostrum itaque laboriosam et, beatae nam quisquam molestias necessitatibus consectetur quod
                    illum
                    repellendus eum non.</p>
            </div>
            <div class="coffee col-12 col-md-4 py-4 py-md-0" data-aos="fade-up" data-aos-delay="100">
                <p class="text-center"><i class="fa-solid fa-mug-saucer fs-1"></i></p>
                <p class="text-center fs-3">Quality coffee</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad natus ex, a reiciendis doloribus eligendi
                    vitae tenetur. Temporibus non laborum ratione sunt labore modi, ipsam explicabo facilis qui,
                    repudiandae
                    distinctio!</p>
            </div>
        </div>
    </section>

    <section class="menu container" style="padding: 120px 0;">
        <div class="row px-5 py-5">
            <div class="col-12 col-md-7 pb-5 pb-md-0" data-aos="fade-up">
                <p class="fs-2 text-center text-md-end title-tertiary">Discover</p>
                <p class="fs-2 text-center text-md-end title-primary">OUR MENU</p>
                <p class="text-center text-md-end">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio
                    tempora numquam
                    facere
                    cumque nisi soluta error rem repellat amet vel? Nulla enim adipisci veniam, libero dolorum hic
                    facilis
                    doloribus nisi.</p>
            </div>
            <div class="col-12 col-md-5" data-aos="fade-up" data-aos-delay="100">
                <div class="row">
                    <img class="col-6 pb-2 px-1"
                        src="https://neurosciencenews.com/files/2023/06/coffee-brain-caffeine-neuroscincces.jpg"
                        alt="">
                    <img class="col-6 pb-2 px-1"
                        src="https://file.hstatic.net/1000075078/article/blog_f80b599183c340bca744c174e7ab2af8.jpg"
                        alt="">
                    <img class="col-6 pb-2 px-1"
                        src="https://hips.hearstapps.com/hmg-prod/images/1519246658-irish-coffee-delish-1620163679.jpeg?crop=0.8890666666666666xw:1xh;center,top&resize=1200:*"
                        alt="">
                    <img class="col-6 pb-2 px-1"
                        src="https://www.seriouseats.com/thmb/nXNRk-XzGCfGrffLICBjT9i-6_0=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/__opt__aboutcom__coeus__resources__content_migration__serious_eats__seriouseats.com__images__2017__02__20170210-barbajada-milanese-coffee-cocoa-vicky-wasik-6-cddd037c955c4b0bb2f72bad5bca0c50.jpg"
                        alt="">
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
