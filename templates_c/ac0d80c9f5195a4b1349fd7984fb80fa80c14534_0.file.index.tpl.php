<?php
/* Smarty version 3.1.34-dev-7, created on 2020-03-25 21:20:43
  from '/var/www/html/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e7bcb2b02df97_82881628',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ac0d80c9f5195a4b1349fd7984fb80fa80c14534' => 
    array (
      0 => '/var/www/html/templates/index.tpl',
      1 => 1585171240,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:page_header.tpl' => 1,
    'file:section_header.tpl' => 3,
  ),
),false)) {
function content_5e7bcb2b02df97_82881628 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Black Line</title>
    <link rel="stylesheet" href="<?php echo STYLES_PATH;?>
/normalize.css">
    <link rel="stylesheet" href="<?php echo STYLES_PATH;?>
/general.css">
    <link rel="stylesheet" href="<?php echo STYLES_PATH;?>
/page-header.css">
    <link rel="stylesheet" href="<?php echo STYLES_PATH;?>
/index.css">
</head>
<body>
    <?php $_smarty_tpl->_subTemplateRender('file:page_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <section id="hero-image" class="section"></section>

    <section id="quote_section" class="section">
        <div id="quotation-link" class="section header-text"><a href="#cytaty">CYTATY Z GŁĘBI STRON</a></div>

        <?php $_smarty_tpl->_subTemplateRender('file:section_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'Słowa są ukrytą siłą życia...','link'=>'#cytaty','subtitle'=>'ILE MASZ JEJ W SOBIE?','style'=>'margin-top:50px;'), 0, false);
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
            <p> Zadajesz sobie pytanie: co to za strona i właściwie, po co istnieje? <br>
                Czym są te dziwnie brzmiące stwierdzenia, określające często znane Ci już stany Twojej osobowości? <br>
                I właśnie w tej chwili dociera do Ciebie fala nieopisanego spokoju, z dawno nieodczuwaną radością. <br> 
                Tak... Jesteś w domu. Witaj w przestrzeni wolnej woli. <br> 
                Dlaczego budzisz się w środku nocy z gonitwą myśli napawając snem na jawie wszystko to, co w rzeczywistości przepadło? Dlaczego codziennie rano zakładasz maskę dnia i pancerz osobowości - czyż nie po to by przeżyć ten dzień? <br>
                Czyż nie po to by odetchnąć jednym haustem tlenu pośród goryczy oddechów innych? <br>
                Dlaczego patrząc w lustro zamykasz oczy, by nie widzieć siebie, a milczeniem wołasz by Cię dostrzeżono, że jesteś, że czujesz, że kochasz, że pragniesz tak samo mocno jak inny, także milczący i we własnym lęku zamknięty. <br>
                A lęk ten cykutą strachu smakuje, paraliżuje, obezwładnia i zamyka jedyne drzwi na klucz... Drzwi do Twojego serca. <br>
                Nie! Nie musisz się już bać! - Żyj i czerp z życia, zanurz się w niej po ostatni atom własnej wolnej woli i pokaż światu wszystko to, co skrzętnie na dnie duszy ukryte było, a teraz innym otwierać serca będzie! Pokaż siebie! <br> Opowiedz 
                o sobie, napisz Siebie od początku, a słowa Twe będą jak tlen dla tych, co jeszcze goryczą oddychają. <br> 
                Pokaż swą siłę w pięknie i wrażliwości zawartą. Daj nadzieję innym by też otworzyli swe serca i światu się ukazali by mieli siłę mówić o sobie, o emocjach, o pragnieniach, o uczuciach, o pytaniach o nadzieję i szczęście dla siebie samych i innych. <br>
            </p>
            <p>
                Czy teraz już wiesz, po co jest ta strona? - Jest, dlatego, że ją odnalazłaś! Jest, dlatego, że jej szukałeś. <br>
                Jest, dlatego, iż Ty jesteś wszystkim, czego świat mógłby oczekiwać od życia.
            </p>
            <p>
                Zajrzyj w nasz pejzaż myśli ulotnej i posmakuj cytatów z głębi stron, a znajdziesz wszystko, co świat powinien wiedzieć o Tobie. Powodzenia!
            </p>
        </div>
    </section>
    <section id="shop-preview" class="section text">
        <?php $_smarty_tpl->_subTemplateRender('file:section_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'GALERIA MOJEGO EGO','link'=>'#galeria'), 0, true);
?>   
        <div class="shop-note">
            <p>
                Witaj wędrowcze! Oto sens i cel naszej manufaktury. Tutaj określisz siebie, a cytat Twój podziwiany będzie za szczerość i odwagę. Słowa wybrane z głębi mądrości wrażliwej, poprzez technologię zaklętą w ciśnieniu i temperaturze naniesione na materiał zostaną. Ty zaś z dumą przywdziejesz materiał ten w formie bluzy, koszulki, apaszki i ogólny zachwyt wywołasz. I nie myśl wędrowcze, że to kupczenie dukatami złotymi za bycie sobą… - To tylko odzienia fragment dukaty kosztuje… - Sens w słowach zawarty – jest bezcenny…
            </p>
            <p style="font-size:16px;">
                (Wykonanie zleconego cytatu na wybranym nośniku poprzez najnowocześniejszą technikę termosublimacji zapewniającą niespotykaną dotąd jakość nadruku na materiale)
            </p>
        </div>
        <div id="products-categories">
            <?php $_smarty_tpl->_assignInScope('categories', array('BLUZY','KOSZULKI','APASZKI','CZAPECZKI','INNE'));?>
            <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 4+1 - (0) : 0-(4)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 0, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
            <div class="category">
                <div class="category-img"></div>
                <div class="category-name"><?php echo $_smarty_tpl->tpl_vars['categories']->value[$_smarty_tpl->tpl_vars['i']->value];?>
</div>
            </div>
            <?php }
}
?>
        </div>
    </section>
    <section id="youtube-preview" class="section text">
        <?php $_smarty_tpl->_subTemplateRender('file:section_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'AKADEMIA MYŚLI ULOTNEJ','link'=>'#galeria'), 0, true);
?> 
        <div class="youtube-note">
            <div class="youtube-sign">
                <a href="#youtube">
                    <img src="/assets/icons/youtube.svg" class="youtube-ico">
                    <p>YOUTUBE </p>
                </a>
                <div style="clear:both"></div>
            </div>
            <p class="note-content">
                To wielki zaszczyt gościć was w przestrzeni wizji i fonii. Zasiądźcie wygodnie z kubkiem kawy i głodem ciekawości niezaspokojonej. Filmów tu kilka odnajdziecie, a wykłady w nich ukryte niech odpowiedzią będą na pytania Wasze najważniejsze. Czym jest ta psychologia, czym miłość, czym samotność, filozofia, cierpienie. I dlaczego tak często zastanawiacie się czy w ogóle warto rano wstać…?
            </p>
        </div>
        <div class="separate-line"></div>
        <div class="social-media-wrap">
            <div class="social-media-desc" style="grid-area: desc1;">Chciałbyś więcej?</div>
            <div class="social-media-desc" style="grid-area: desc2;">ŚLEDŹ NAS NA INSTAGRAMIE I FACEBOOKU!</div>
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
    </section>
</body>
</html><?php }
}
