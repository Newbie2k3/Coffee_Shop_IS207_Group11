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

                <p>húng tôi đã bắt đầu với một niềm đam mê về cà phê và mong muốn chia sẻ hương vị tuyệt vời này với mọi người.

Từ việc tìm kiếm những hạt cà phê độc đáo đến việc phát triển quy trình rang xay tinh tế, chúng tôi đã luôn tận hưởng việc mang đến cho khách hàng những trải nghiệm cà phê đặc biệt và chất lượng.

Câu chuyện của chúng tôi không chỉ xoay quanh cà phê mà còn về sự đam mê và tận hưởng cuộc sống. Chúng tôi tin rằng mỗi tách cà phê đều mang trong đó một câu chuyện và chúng tôi muốn chia sẻ câu chuyện đó với bạn..</p>
            </div>
        </div>
    </section>

    <section class="feature bg-color-yellow mx-0">
        <div class="row" style="width:100%;">
            <div class="order col-12 col-md-4 py-4 py-md-0" data-aos="fade-up">
                <p class="text-center"><i class=" fa-solid fa-bars fs-1"></i></p>
                <p class="text-center fs-3">Dễ dàng đặt món</p>
                <p>Chúng tôi mang đến cho bạn trải nghiệm đặt hàng cực kỳ dễ dàng ngay trên trang chủ. 
                    Chỉ cần vài cú click chuột, bạn có thể lựa chọn các món cà phê yêu thích và thực hiện thanh toán trực tuyến. 
                    Tiết kiệm thời gian, tiện lợi và nhanh chóng!</p>
            </div>
            <div class="delivery col-12 col-md-4 py-4 py-md-0" data-aos="fade-up" data-aos-delay="50">
                <p class="text-center"><i class="fa-solid fa-truck fs-1"></i></p>
                <p class="text-center fs-3">Giao hàng nhanh chóng</p>
                <p>Đặt hàng ngay và chúng tôi sẽ giao tận nơi cho bạn một cách nhanh chóng. 
                    Với dịch vụ giao hàng nhanh nhất, bạn sẽ nhận được cà phê tươi ngon ngay trong thời gian ngắn nhất. 
                    Tiết kiệm thời gian và tận hưởng cà phê ngon ngọt ngay lập tức!</p>
            </div>
            <div class="coffee col-12 col-md-4 py-4 py-md-0" data-aos="fade-up" data-aos-delay="100">
                <p class="text-center"><i class="fa-solid fa-mug-saucer fs-1"></i></p>
                <p class="text-center fs-3">Cà phê chất lượng</p>
                <p>Chúng tôi tự hào mang đến cho bạn cà phê chất lượng cao.
                     Từ nguyên liệu tốt nhất cho đến quy trình rang xay cẩn thận, chúng tôi đảm bảo hương vị đích thực và đậm đà.
                      Hãy thưởng thức cà phê thơm ngon và độc đáo với chất lượng tuyệt vời của chúng tôi.
                     Tạo ra trải nghiệm thưởng thức cà phê đáng nhớ tại cửa hàng của chúng tôi ngay hôm nay!</p>
            </div>
        </div>
    </section>

    <section class="menu container" style="padding: 120px 0;">
        <div class="row px-5 py-5">
            <div class="col-12 col-md-7 pb-5 pb-md-0" data-aos="fade-up">
                <p class="fs-2 text-center text-md-end title-tertiary">Discover</p>
                <p class="fs-2 text-center text-md-end title-primary">OUR MENU</p>
                <p class="text-center text-md-end">Duyệt qua các lựa chọn trên menu và tìm hiểu về thành phần, mô tả và giá cả của từng món. Chúng tôi cam kết mang đến cho bạn những trải nghiệm thưởng thức cà phê độc đáo và đáng nhớ.</p>
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
