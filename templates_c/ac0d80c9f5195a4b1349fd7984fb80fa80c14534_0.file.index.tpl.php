<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-16 13:31:55
  from '/var/www/html/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e985e4b6d4383_81216515',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac0d80c9f5195a4b1349fd7984fb80fa80c14534' => 
    array (
      0 => '/var/www/html/templates/index.tpl',
      1 => 1587043914,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/section_header.tpl' => 3,
    'file:modules/fancy_border.tpl' => 1,
  ),
),false)) {
function content_5e985e4b6d4383_81216515 (Smarty_Internal_Template $_smarty_tpl) {
?>    <section id="hero-image" class="section"></section>

    <section id="quote_section" class="section">
        <?php $_smarty_tpl->_subTemplateRender('file:modules/section_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'CYTATY Z GŁĘBI STRON','link'=>'#cytaty'), 0, false);
?>

            <?php $_smarty_tpl->_subTemplateRender('file:modules/fancy_border.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('content'=>'
                <div class="quotes-section-title">SŁOWA SĄ UKRYTĄ SIŁA ŻYCIA...</div>
                <div class="quotes-section-title quotes-title-fancy">Ile masz jej w sobie?</div>','style'=>'margin-top:40px;'), 0, false);
?>


        <?php $_smarty_tpl->_assignInScope('authors', array('- BERTOLD BRECHT -','- JOHANN WOLFGANG VON GOETHE -','- ANTOINE DE SAINT EXUPÉRY -','- ALEKSANDER DUMAS -'));?> 
        <?php $_smarty_tpl->_assignInScope('quotes', array('Kto walczy, może przegrać. Kto nie walczy, już przegrał.','Talent rośnie w samotności, charakter wśród ludzi.','Mowa jest źródłem nieporozumień.','[...] zła najczęściej nie da się naprawić; możemy je tylko pomścić.'));?>
        <div id="quotes" class="text">
            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 3+1 - (0) : 0-(3)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
            <div class="quote-container center-position">
                <div class="quote-sign">,,</div>
                <div class="quote"><?php echo $_smarty_tpl->tpl_vars['quotes']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</div>
                <div class="quote-author"><?php echo $_smarty_tpl->tpl_vars['authors']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</div>
            </div>
            <?php }
}
?>
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
        <?php $_smarty_tpl->_subTemplateRender('file:modules/section_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'GALERIA MOJEGO EGO','link'=>'#galeria'), 0, true);
?>   
        <div class="shop-note">
            <p>
                Witaj wędrowcze! <br>
                Oto sens i&nbsp;cel naszej manufaktury.
                Tutaj określisz siebie, a&nbsp;cytat Twój podziwiany będzie za szczerość i&nbsp;odwagę. <br>
                Słowa wybrane z&nbsp;głębi mądrości wrażliwej, poprzez technologię zaklętą w&nbsp;ciśnieniu i&nbsp;temperaturze naniesione na materiał zostaną. <br> Ty zaś z&nbsp;dumą przywdziejesz materiał ten w&nbsp;formie bluzy, koszulki, apaszki i&nbsp;ogólny zachwyt wywołasz. <br>
                I&nbsp;nie myśl wędrowcze, że to kupczenie dukatami złotymi za bycie sobą… - To tylko odzienia fragment dukaty kosztuje…
                <br>Sens w&nbsp;słowach zawarty – jest bezcenny…
            </p>
            <p>
                (Wykonanie zleconego cytatu na wybranym nośniku poprzez najnowocześniejszą technikę termosublimacji zapewniającą niespotykaną dotąd jakość nadruku na materiale)
            </p>
        </div>
        <div class="separate-line"></div>
        <div id="products-categories">
            <?php $_smarty_tpl->_assignInScope('categories', array('BLUZY','KOSZULKI','APASZKI','CZAPECZKI','INNE'));?>
            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 4+1 - (0) : 0-(4)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
            <div class="category">
                <a href="#produkt">
                <div class="category-img"></div>
                <div class="category-name"><?php echo $_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</div>
                </a>
            </div>
            <?php }
}
?>
        </div>
    </section>
    <section id="youtube-preview" class="section text">
        <?php $_smarty_tpl->_subTemplateRender('file:modules/section_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'AKADEMIA MYŚLI ULOTNEJ','link'=>'#galeria'), 0, true);
?> 

        <div id="slider">
            <div id="slide-1" class="slide">
                <p id="youtube-note">                
                    To wielki zaszczyt gościć was w&nbsp;przestrzeni wizji i&nbsp;fonii. <br> Zasiądźcie wygodnie z&nbsp;kubkiem kawy i&nbsp;głodem ciekawości niezaspokojonej. Filmów tu kilka odnajdziecie, a&nbsp;wykłady w&nbsp;nich ukryte niech odpowiedzią będą na pytania Wasze najważniejsze.<br> Czym jest ta psychologia, czym miłość, czym samotność, filozofia, cierpienie? <br> I&nbsp;dlaczego tak często zastanawiacie się czy w&nbsp;ogóle warto rano wstać..?
                </p>
                <div class="separate-line" style="width: 350px;"></div>
                <p class="youtube-summary-1">Akademia myśli ulotnej?</p>
                <p class="youtube-summary-2">TO NASZ KANAŁ NA YOUTUBIE!</p>
                <a href="#youtube"><img id="first-slide-youtube-ico" src="/assets/icons/youtube.svg" alt=""></a>
            </div>

            <div id="slide-2" class="slide">
                <div id="slide-2-content-container">
                    <div id="slide-2-left-content">
                        <div id="slide-2-lt">
                            <p id="slide-2-youtube-desc">W naszych filmach poznasz odpowiedzi na najtrudniejsze pytania!</p>
                            <a id="slide-2-youtube-button" href="">
                                <img id="slide-2-youtube-ico" src="/assets/icons/youtube.svg" alt="">
                                <p id="slide-2-youtube-button-text">Youtube</p>
                            </a>
                        </div>
                        <div id="slide-2-lb">
                            <p style="margin-bottom: 10px">Nie przegap żadnej odpowiedzi</p>
                            <p style="margin: 0; margin-bottom: 10px;">i</p>
                            <div id="subscribe">
                                <div id="subscribe-button">SUBSKRYBUJ</div> 
                                <img id="subscribe-click" src="/assets/icons/click.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <div id="slide-2-right-content">
                        <div id="preview-1"  class="preview"></div>
                        <div id="preview-2" class="preview"></div>
                        <p id="preview-title-1">Czym jest ta <span style="font-family: Dancing Script; margin: 0 10px 0 10px; font-size: 24px; line-height: -100%;">psychologia</span>?</p>
                        <p id="preview-title-2">A co to właściwie jest <span style="font-family: Dancing Script; margin: 0 10px 0 10px; font-size: 24px; line-height: -100%;">miłość</span>?</p>
                    </div>
                </div>
            </div>
            <div id="slide-3" class="slide">
                <div id="slide-3-content-container">
                    <div id="social-note"  style="grid-area:title;">
                        ŚLEDŹ NAS NA INSTAGRAMIE I FACEBOOKU!
                    </div>
                    <div class="slider-3-blackline-link" style="grid-area:insta-account;">@blackline</div>
                    <div class="slider-3-social-link"  style="grid-area:insta-link;">
                        <img class="slider-3-social-ico" src="/assets/icons/instagram.svg" alt="">
                        <p class="slider-3-social-title">INSTAGRAM</p>
                    </div>
                    <div class="slider-3-social-link"  style="grid-area:fb-link;">
                        <img class="slider-3-social-ico" src="/assets/icons/facebook.svg" alt="">
                        <p class="slider-3-social-title" >FACEBOOK</p>
                    </div>
                    <div class="slider-3-blackline-link"  style="grid-area:fb-account;">@Blackline</div>
                </div>
            </div>

            <div id="slide-dots-container">
                <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 3+1 - (1) : 1-(3)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
                <div class="slide-dot" onclick="slider.manualChange(<?php echo $_smarty_tpl->tpl_vars['i']->value;?>
)"></div>
                <?php }
}
?>
            </div>

        </div>
        <?php echo '<script'; ?>

        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"><?php echo '</script'; ?>
>
        
        <?php echo '<script'; ?>
>
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
                        if(slide == 3)
                            $("#youtube-preview").find(".section-title-text").html("CHCIAŁBYŚ WIĘCEJ?");
                        if(this.actualSlide == 3)
                        $("#youtube-preview").find(".section-title-text").html("AKADEMIA MYŚLI ULOTNEJ");


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
            //$("#slide-3").show();
            let slider = new Slider(1, 10000);
            $("#slider").ready(slider.start());
            console.log(`${window.innerWidth}x${window.innerHeight}`)
        <?php echo '</script'; ?>
>
        
        <!--
        <div class="youtube-note">
            <div class="youtube-sign">
                <a href="#youtube">
                    <img src="/assets/icons/youtube.svg" class="youtube-ico">
                    <p>YOUTUBE </p>
                </a>
                <div style="clear:both"></div>
            </div>
            <p class="note-content">
                To wielki zaszczyt gościć was w&nbsp;przestrzeni wizji i&nbsp;fonii. <br> Zasiądźcie wygodnie z&nbsp;kubkiem kawy i&nbsp;głodem ciekawości niezaspokojonej. Filmów tu kilka odnajdziecie, a&nbsp;wykłady w&nbsp;nich ukryte niech odpowiedzią będą na pytania Wasze najważniejsze.<br> Czym jest ta psychologia, czym miłość, czym samotność, filozofia, cierpienie? <br> I&nbsp;dlaczego tak często zastanawiacie się czy w&nbsp;ogóle warto rano wstać..?
            </p>
        </div>
        <div class="separate-line"></div>
        <div class="social-media-wrap">
            <div class="social-media-desc" style="grid-area: desc1;">Chciałbyś więcej?</div>
            <div class="social-media-desc" style="grid-area: desc2;">ŚLEDŹ NAS NA INSTAGRAMIE I&nbsp;FACEBOOKU!</div>
            <div class="links-container" style="grid-area: links;">
                <div class="social-media-link">
                    <a href="#instagram">
                        <img src="/assets/icons/instagram.svg">
                        <p>INSTAGRAM</p>
                    </a>
                </div>
                <div class="social-media-link">
                    <a href="#facebook">
                        <img src="/assets/icons/facebook.svg">
                        <p>FACEBOOK</p>
                    </a>
                </div>
            </div>
        </div>
        <div id="social-media-decoration">
            <div class="sm-decoration-dot"></div>
            <div class="sm-decoration-dot"></div>
            <div class="sm-decoration-dot"></div>
        </div>
        -->
    </section><?php }
}
