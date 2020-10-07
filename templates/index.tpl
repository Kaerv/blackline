    <section id="hero-image" class="section"></section>
    <section id="quote_section" class="section">
        {include 
            file='modules/section_header.tpl' 
            title='CYTATY Z GŁĘBI STRON'
            link = '#cytaty'}

            {include 
                file='modules/fancy_border.tpl'
                content='
                <div class="quotes-section-title">SŁOWA SĄ UKRYTĄ SIŁA ŻYCIA...</div>
                <div class="quotes-section-title quotes-title-fancy">Ile masz jej w sobie?</div>'
                style='margin-top:var(--quotes-section-margin-top);'
            }


        {assign var=authors value=[
            '- BERTOLD BRECHT -',
            '- JOHANN WOLFGANG VON GOETHE -',
            '- ANTOINE DE SAINT EXUPÉRY -',
            '- ALEKSANDER DUMAS -']} 
        {assign var=quotes value=[
            'Kto walczy, może przegrać. Kto nie walczy, już przegrał.',
            'Talent rośnie w samotności, charakter wśród ludzi.',
            'Mowa jest źródłem nieporozumień.',
            '[...] zła najczęściej nie da się naprawić; możemy je tylko pomścić.']}
        <div id="quotes" class="text">
            {for $i = 0 to 3}
            <div class="quote-container center-position">
                <div class="quote-sign">,,</div>
                <div class="quote">{$quotes[$i]}</div>
                <div class="quote-author">{$authors[$i]}</div>
            </div>
            {/for}
        </div>
    </section>

    <section id="preamble-wrap" class="section text" style="background-image:url(assets/images/preambula-tlo.png)">
        <div id="preamble" style="background-image:url(assets/images/preambula-kartka.png)">
            <h1 class="header-text">PREAMBUŁA MYŚLI ULOTNEJ</h1>
            <p> Zadajesz sobie pytanie: co to za strona i&nbsp;właściwie, po co istnieje?
                Czym są te dziwnie brzmiące stwierdzenia, określające często znane Ci już stany Twojej osobowości?
                I&nbsp;właśnie w&nbsp;tej chwili dociera do Ciebie fala nieopisanego spokoju, z&nbsp;dawno nieodczuwaną radością.
                Tak... Jesteś w&nbsp;domu. Witaj w&nbsp;przestrzeni wolnej woli. <br>
                Dlaczego budzisz się w&nbsp;środku nocy z&nbsp;gonitwą myśli napawając snem na jawie wszystko to, co w&nbsp;rzeczywistości przepadło? Dlaczego codziennie rano zakładasz maskę dnia i&nbsp;pancerz osobowości, czyż nie po to by przeżyć ten dzień?
                Czyż nie po to by odetchnąć jednym haustem tlenu pośród goryczy oddechów innych?
                Dlaczego patrząc w&nbsp;lustro zamykasz oczy, by nie widzieć siebie, a&nbsp;milczeniem wołasz by Cię dostrzeżono, że jesteś, że czujesz, że kochasz, że pragniesz tak samo mocno jak inny, także milczący i&nbsp;we własnym lęku zamknięty.
                A&nbsp;lęk ten cykutą strachu smakuje, paraliżuje, obezwładnia i&nbsp;zamyka jedyne drzwi na klucz... Drzwi do Twojego serca. <br>
                Nie! Nie musisz się już bać! Żyj i&nbsp;czerp z&nbsp;życia, zanurz się w&nbsp;niej po ostatni atom własnej wolnej woli i&nbsp;pokaż światu wszystko to, co skrzętnie na dnie duszy ukryte było, a&nbsp;teraz innym otwierać serca będzie! <br>
                Pokaż siebie! Opowiedz 
                o&nbsp;sobie, napisz Siebie od początku, a&nbsp;słowa Twe będą jak tlen dla tych, co jeszcze goryczą oddychają.
                Pokaż swą siłę w&nbsp;pięknie i&nbsp;wrażliwości zawartą. Daj nadzieję innym by też otworzyli swe serca i&nbsp;światu się ukazali by mieli siłę mówić o&nbsp;sobie, o&nbsp;emocjach, o&nbsp;pragnieniach, o&nbsp;uczuciach, o&nbsp;pytaniach o&nbsp;nadzieję i&nbsp;szczęście dla siebie samych i&nbsp;innych.
            </p>
            <p>
                Czy teraz już wiesz, po co jest ta strona? Jest, dlatego, że ją odnalazłaś! Jest, dlatego, że jej szukałeś.
                Jest, dlatego, iż Ty jesteś wszystkim, czego świat mógłby oczekiwać od życia.
            </p>
            <p>
                Zajrzyj w&nbsp;nasz pejzaż myśli ulotnej i&nbsp;posmakuj cytatów z&nbsp;głębi stron, a&nbsp;znajdziesz wszystko, co świat powinien wiedzieć o&nbsp;Tobie. <br> Powodzenia!
            </p>
        </div>
    </section>
    <section id="shop-preview" class="section text">
        {include file='modules/section_header.tpl' 
        title='GALERIA MOJEGO EGO'
        link = '#galeria'}   
        <style>@import '../styles/shop-description.css'; </style>
        {include file="modules/shop_description.tpl"}
    </section>
    <section id="youtube-preview" class="section text">
        {include file='modules/section_header.tpl' 
        title='CHCIAŁBYŚ WIĘCEJ?'
        link = '#galeria'} 

        <div id="slider">
            <div id="slide-3" class="slide">
                <div id="slide-3-content-container">
                    <div id="social-note"  style="grid-area:title;">
                        ŚLEDŹ NAS NA INSTAGRAMIE I FACEBOOKU!
                    </div>
                    <div class="slider-3-blackline-link" style="grid-area:insta-account;"><a href="https://www.instagram.com/blackline.art.shop/">@blackline.shop.art</a></div>
                    <div class="slider-3-social-link"  style="grid-area:insta-link;">
                        <img class="slider-3-social-ico" id="slider-3-ig-ico" src="/assets/icons/instagram.svg" alt="">
                        <p class="slider-3-social-title">INSTAGRAM</p>
                    </div>
                    <div class="slider-3-social-link"  style="grid-area:fb-link;">
                        <img class="slider-3-social-ico" id="slider-3-fb-ico" src="/assets/icons/facebook.svg" alt="">
                        <p class="slider-3-social-title" >FACEBOOK</p>
                    </div>
                    <div class="slider-3-blackline-link"  style="grid-area:fb-account;"><a href="https://www.facebook.com/blackline.art.shop">@blackline.shop.art</a></div>
                </div>
            </div>
        </div>
        <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
        {literal}
        <script>
            $("#slider-3-ig-ico").hover( function() {
                $(this).attr('src', "/assets/icons/instagram-color.svg")
            }, function() {
                $(this).attr('src', "/assets/icons/instagram.svg")
            });

            class Slider {
                constructor(firstSlide, slideChangeTimeout) {
                    this.slideInterval = null;

                    this.actualSlide = firstSlide;
                    this.slideChangeTimeout = slideChangeTimeout;
                    this.lastSlide = $(".slide").length;
                }

                start() {
                    $(`#slide-${this.actualSlide}`).show();
                    $(`.slide-dot:eq(${this.actualSlide - 1})`).addClass("slide-dot-active");

                    this.slideInterval = window.setInterval(this.autoChange, this.slideChangeTimeout);
                }

                autoChange() {
                    let nextSlide = slider.actualSlide == slider.lastSlide? 1: slider.actualSlide + 1;
                    slider.changeSlide(nextSlide);
                }

                manualChange(slide) {
                    this.changeSlide(slide);
                    clearInterval(this.slideInterval);
                    this.slideInterval = window.setInterval(this.autoChange, this.slideChangeTimeout);
                }
                
                changeSlide(slide) {
                    if(slide != this.actualSlide) {
                        if(slide == 3) {
                            $("#youtube-preview").find(".section-title-text").html("CHCIAŁBYŚ WIĘCEJ?");
                            $("#youtube-preview").find(".section-title").addClass('noclick');
                        }
                        if(this.actualSlide == 3) {
                            $("#youtube-preview").find(".section-title-text").html("AKADEMIA MYŚLI ULOTNEJ");
                            $("#youtube-preview").find(".section-title").removeClass('noclick');
                        }

                        this.deactivateSlide(this.actualSlide);
                        this.actualSlide = slide;
                        this.activateSlide(this.actualSlide);
                    }
                }

                deactivateSlide(slide) {
                    $(`#slide-${slide}`).fadeOut();
                    $(`.slide-dot:eq(${slide - 1})`).removeClass("slide-dot-active");
                }

                activateSlide(slide) {
                    $(`.slide-dot:eq(${slide - 1})`).addClass("slide-dot-active");
                    $(`#slide-${slide}`).fadeIn();
                }
            }
            
            //let slider = new Slider(1, 10000);
            //$("#slider").ready(slider.start());
            //console.log(`${window.innerWidth}x${window.innerHeight}`);

            $(window).on("resize", function() {
                let windowHeight = window.innerHeight;
                let headerHeight = $("#page-header")[0].clientHeight;
                $("#hero-image").css("height", windowHeight - headerHeight);
            })

            $(document).ready(function() {
                let windowHeight = window.innerHeight;
                let headerHeight = $("#page-header")[0].clientHeight;
                $("#hero-image").css("height", windowHeight - headerHeight);
                console.log(headerHeight)
            });
        </script>
        {/literal}
    </section>