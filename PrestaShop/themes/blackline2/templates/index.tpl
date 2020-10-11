{**
 * 2007-2019 PrestaShop and Contributors
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<!doctype html>
<html lang="{$language.iso_code}">
  <head>
    {block name='head'}
      {include file='_partials/head.tpl'}
    {/block}
  </head>
  <body>
{extends file='page.tpl'}
{block name="page_content"}
    {block name='page_content_container'}
      <section id="content" class="page-home">
    <section id="hero-image" class="section"></section>
    <section id="quote_section" class="section">
        {include 
            file='_partials/section_header.tpl' 
            title='CYTATY Z GŁĘBI STRON'
            link = '#cytaty'
            style=""}
          <style>@import "/styles/fancy-border.css";</style>
          <div class="fancy-div" style="margin-top:var(--quotes-section-margin-top)">
              <div class="fancy-border-container">
                  <div class="fancy-border-lt"></div>
                  <div class="fancy-border-rt"></div>
                  <div class="fancy-border-lb"></div>
                  <div class="fancy-border-rb"></div>
              </div>
              <div class="quotes-section-title">SŁOWA SĄ UKRYTĄ SIŁA ŻYCIA...</div>
              <div class="quotes-section-title quotes-title-fancy">Ile masz jej w sobie?</div>
          </div>
        {assign var=authors value=[
            'BERTOLD BRECHT',
            'JOHANN WOLFGANG VON GOETHE',
            'ANTOINE DE SAINT EXUPÉRY',
            'ALEKSANDER DUMAS']} 
        {assign var=quotes value=[
            'Kto walczy, może przegrać. Kto nie walczy, już przegrał.',
            'Talent rośnie w samotności, charakter wśród ludzi.',
            'Mowa jest źródłem nieporozumień.',
            '[...] zła najczęściej nie da się naprawić; możemy je tylko pomścić.']}
        <div id="quotes" class="text">
            {for $i = 0 to 3}
                <div class="quote">
                    <div class="quote-border">
                        <div class="border lt"></div>
                        <div class="border rt"></div>
                        <div class="border lm"></div>
                        <div class="border rm"></div>
                        <div class="border lb"></div>
                        <div class="border rb"></div>
                    </div>
                    <div class="quote-wrap">
                        <img class="quotation-mark" src="/assets/icons/quotation.svg">
                        <div class="quote-content">{$quotes[$i]}</div>
                        <div class="quote-author">- {if $authors[$i] == ""} Autor nieznany {else}{$authors[$i]}{/if} -</div>
                    </div>
                </div>
            {/for}
        </div>
    </section>

    <section id="preamble-wrap" class="section text" style="background-image:url(/assets/images/preambula-tlo.png)">
        <div id="preamble" style="background-image:url(/assets/images/preambula-kartka.png)">
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
        {include file='_partials/section_header.tpl' 
        title='GALERIA MOJEGO EGO'
        link = '#galeria'
        style=""}   
        <style>@import '../styles/shop-description.css'; </style>
        {include file="_partials/shop_description.tpl"}
    </section>
    <section id="youtube-preview" class="section text">
        {include file='_partials/section_header.tpl' 
        title='CHCIAŁBYŚ WIĘCEJ?'
        link = '#galeria'
        style=""} 

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
                //console.log(headerHeight)
            });
        </script>
        {/literal}
    </section>
      </section>
    {/block}
    <script src="{$urls.js_url}/index-scroll.js"></script>
{/block}
</body>
</html>