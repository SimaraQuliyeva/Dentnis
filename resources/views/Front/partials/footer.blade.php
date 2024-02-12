<footer class="footerMain">
    <div class="top-footer">
        <h2>Diş Estetiği ile ilgili sorunlarınız mı var?</h2>
        <a href="{{route('front.contact')}}">Contact us</a>
    </div>
    <div class="bottom-footer">
        <div class="upper">
            <div class="logo-part">
                @foreach($settings as $setting)
                <img src="{{ Storage::url($setting->bottom_logo) }}" alt="">
                @endforeach
                <div class="address">
                    @foreach($contacts as $contact)
                    <p class="address-line">Adres: {{$contact->address}}</p>
                    <p class="phone-number">Telefon: {{$contact->phone}}</p>
                    <p class="email">Mail: {{$contact->email}}</p>
                    @endforeach
                </div>
            </div>
            <div class="titles-part">
                @foreach($blogs as $blog)
                <p><a href="{{ url("$blog->slug") }}" class="footer-li">{{$blog->translations->first()->title}}</a></p>
                @endforeach
            </div>
        </div>
        <div class="lower">
            <p>© 2024 Tüm hakları www.dentnis.com’a aittir.</p>
            <p>Dentnis.com'da yer alan tüm içerikler sadece kullanıcıyı bilgilendirmek amacı ile sunulmuş olup tıbbi tedavi anlamında tavsiye niteliği taşımamaktadır.</p>
        </div>
    </div>
</footer>
