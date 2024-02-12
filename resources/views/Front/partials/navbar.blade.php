@php use Illuminate\Support\Facades\Storage; @endphp
<div class="header">
    <ul class="container1">
        <div class="image">
            <a href="{{route('front.index')}}">
                @foreach($settings as $setting)
                    <img src="{{Storage::url($setting->top_logo)}}" alt="logo">
                @endforeach
            </a>
        </div>
        <div class="toggle-menu">
            <ul class="navbar">
                {{--                @dd($categories);--}}

                {{--                                @dd($categoriesAll)--}}
                <nav>
                    @foreach ($categories  as $category)
                        <li>
                            @if ($category->translations->isNotEmpty())
                                <a href='#' class="toggle-menu2"><span> {{$category->translations->first()->name}} </span><i class="toggle-icon">+</i> </a>
                            @endif


                            <ul class="submenu">
                                @foreach ($category->blogs as $blog)
                                    @if ($blog->translations->isNotEmpty())
                                        <li>
                                            <a href="{{ url("$blog->slug") }}">{{ $blog->translations->first()->title}}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endforeach


                    <li>
                        <a href='{{route('front.about')}}'  ><span class="toggle-menu2">{{ __('Hakkımızda') }}</span><i class="toggle-icon">+</i> </a>
                        <ul class="submenu">
                            @foreach ($aboutMenu as $menu)
                                @if ($menu->translations->isNotEmpty())
                                    <li>
                                        <a href="{{$menu->slug}}">{{ $menu->translations->first()->title  }}</a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href='{{route('front.contact')}}'><span>{{ __('İletişim') }}</span> </a>
                    </li>

                </nav>
                @foreach($languages as $language)
                    <a href='{{ url('/langChange/' . $language->lang) }}'
                       class="{{ $lang == $language->lang ? 'd-none' : '' }} lang"><img
                            src="{{ url('storage/' . $language->image) }}" alt="Language image"></a>
                @endforeach

                {{--                <a href="{{ url('/change-language/en') }}" class="{{ $lang == 'en' ? 'd-none' : '' }} lang"><img src="" alt="" id="en"></a>--}}
                {{--                <a href="{{ url('/change-language/gr') }}" class="{{ $lang == 'gr' ? 'd-none' : '' }} lang"><img src="" alt="" id="gr"></a>--}}
                {{--                <a href="{{ url('/change-language/tr') }}" class="{{ $lang== 'tr' ? 'd-none' : '' }} lang"><img alt="" src="" id="tr"></a>--}}
            </ul>
            <a href="#" class="toggle-btn"><i class="fa-solid fa-bars"></i></a>
            <a href="#" id="search-icon"><i class="fa-solid fa-magnifying-glass"></i></a>
            <div id="search-box">
                <form action="{{route('front.search')}}" method="GET">
                    <input type="text" name="query" placeholder="Ara...">
                    <button id="close-search" type="button">&times;</button>
                </form>
            </div>
        </div>
    </ul>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $("#search-icon").click(function (e) {
            e.preventDefault();
            $("#search-box").slideDown();
        });

        $("#close-search").click(function (e) {
            e.preventDefault();
            $("#search-box").slideUp();
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // DOM tamamen yüklendiğinde bu kod çalışır
        var toggleBtn = document.querySelector('.toggle-btn');
        var navbar = document.querySelector('.navbar>nav');

        // Toggle butonuna tıklandığında navbar'ı göster/gizle
        toggleBtn.addEventListener('click', function () {
            if (navbar.style.left === '-700px' || navbar.style.left === '') {
                navbar.style.display = 'block';
                navbar.style.left = '0';
                toggleBtn.textContent = '✕'; // Close ikonu
            } else {
                navbar.style.left = '-700px';
                navbar.style.display = 'none !important';
                toggleBtn.textContent = '☰'; // Toggle menü ikonu
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Her toggle-menu öğesini seç
        const toggleIcons = document.querySelectorAll(".toggle-icon");

        // Her toggle-menu için tıklama olayı ekle
        toggleIcons.forEach(function(toggleIcon) {
            toggleIcon.addEventListener("click", function(e) {
                e.preventDefault(); // Sayfanın yenilenmesini engelle

                // İlgili alt menüyü seç
                const submenu = toggleIcon.parentElement.nextElementSibling;

                // Alt menü durumunu kontrol et
                const isOpen = submenu.classList.contains("open");

                // Alt menüyü aç/kapat
                if (isOpen) {
                    // Alt menü zaten açık, kapat
                    submenu.style.maxHeight = 0;
                    submenu.classList.remove("open");
                    toggleIcon.textContent = "+";
                } else {
                    // Alt menü kapalı, aç
                    submenu.style.maxHeight = submenu.scrollHeight + "px";
                    submenu.classList.add("open");
                    toggleIcon.textContent = "-";
                }
            });
        });
    });

</script>
