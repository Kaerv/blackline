<?php
/* Smarty version 3.1.34-dev-7, created on 2020-04-13 14:56:57
  from '/var/www/html/templates/regulamin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5e947db9cc4172_27011949',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '54574f10b17dfebf77fbf2a1499d84c94cb3cddb' => 
    array (
      0 => '/var/www/html/templates/regulamin.tpl',
      1 => 1586788015,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:modules/section_header.tpl' => 1,
  ),
),false)) {
function content_5e947db9cc4172_27011949 (Smarty_Internal_Template $_smarty_tpl) {
?>    <div id="menu-separate-line"></div>
    <?php $_smarty_tpl->_assignInScope('rules', array('Dokonujesz zakupu świadomie i uczciwie przyznajesz, że chcesz i wiesz, że chcesz tego, co kupujesz.','Przekazujesz środki materialne w postaci fenicjańskich pieniędzy – a polskich złotówek, amerykańskich dolarów, brytyjskich funtów i europejskich euro, 
        na rzecz zmaterializowania wytworów manufaktury - dzieł rzeczywistych w postaci nadruków, na podłożu wybranym przez Ciebie.','A podłoże to na Tobie spoczywać będzie, w formie fizycznego odzienia: bluza, koszulka, apaszka, czapeczka, narzuta, ponczo.','Jasno i świadomie określasz swój rozmiar - wielkość Ciebie, poprzez kwadrat intencji i metafizykę potrzeb wrażliwości, rozmiar – S, M, L, XL, XXL, XXXXL... lub inny.','Jasno i z podniesionym czołem opisujesz siebie, swoje poglądy, uczucia, stany, emocje, instynkty, nawyki, potrzeby, fochy, sukcesy, porażki, intencje, fabuły, popędy poprzez jasne komunikaty w formie cytatów, definicji lub opisów w języku polskim, angielskim, niemiecki, fińskim, hiszpańskim, koreańskim, ukraińskim, bułgarskim, tureckim i hutu.','I przyznajesz iż treść Ciebie samego na fizyczności okrycia twego, będzie ostateczna i niestety niezmienialna z powodów techniczno-fizycznych. Podłoże i nadruk stanowią od momentu połączenia, nierozerwalną jedność, niepodlegającą zmianom w przeszłości, a jedynie przyszłości z powodu…','…możliwości dodania kolejnych form cytatów na już istniejącym okryciu z istniejącymi już stwierdzeniami lub cytatami  (tylko w polu, gdzie to będzie możliwe po uprzedniej konsultacji).','A cytaty Twe i poglądy na odzieniu Twym będą dwojako prawnie interpretowane: a) jako treść wytwóru ludzkiej myśli niepodlegającej prawom autorskim, majątkowym, azali tylko osobistym (prawa autorskie osobiste i majątkowe, zgodnie z obowiązującymi zasadami prawnymi) b) jako Twe prawa autorskie, jednorodnie osobiste i tylko Tobie immanentne oraz Tobie z woli praw wszelakich – przysługującej,  a w formie materialnej nam do realizacji przekazanej.','A forma piękna dzieła tego, zawarta będzie w samym podłożu bluzy, koszulki tej, w połączeniu z wyśmienitym smakiem nadruku czerni prawdziwej  z czeluści otchłani pobranej.','A upragnione swe prawdziwe „ja”, odziejesz, kiedy posłaniec dostarczy Ci szczęście to w paczce prawdziwie pięknej,  z papieru i sznura złożonej, z pieczęcią na froncie dodaną.','I naprawdę upraszamy Ciebie o świadome dzieła tworzenie, gdyż zwrotów jako takich nie będzie ze względu na nieodwracalną ingerencję farby w materiał odzienia Twego.  A jeszcze nikt nie wymyślił maszyny czasu by go cofnąć i zmiany dokonać.'));?>
        <?php $_smarty_tpl->_subTemplateRender('file:modules/section_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('title'=>'REGULAMIN - METAFIZYKA ZASAD'), 0, false);
?>
    <section id="rules" class="section text">
        <?php
$_smarty_tpl->tpl_vars['i'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['i']->step = 1;$_smarty_tpl->tpl_vars['i']->total = (int) ceil(($_smarty_tpl->tpl_vars['i']->step > 0 ? 11+1 - (1) : 1-(11)+1)/abs($_smarty_tpl->tpl_vars['i']->step));
if ($_smarty_tpl->tpl_vars['i']->total > 0) {
for ($_smarty_tpl->tpl_vars['i']->value = 1, $_smarty_tpl->tpl_vars['i']->iteration = 1;$_smarty_tpl->tpl_vars['i']->iteration <= $_smarty_tpl->tpl_vars['i']->total;$_smarty_tpl->tpl_vars['i']->value += $_smarty_tpl->tpl_vars['i']->step, $_smarty_tpl->tpl_vars['i']->iteration++) {
$_smarty_tpl->tpl_vars['i']->first = $_smarty_tpl->tpl_vars['i']->iteration === 1;$_smarty_tpl->tpl_vars['i']->last = $_smarty_tpl->tpl_vars['i']->iteration === $_smarty_tpl->tpl_vars['i']->total;?>
        <p class="rule-num"><?php echo $_smarty_tpl->tpl_vars['i']->value;?>
</p>
        <p class="rule"><?php echo $_smarty_tpl->tpl_vars['rules']->value[$_smarty_tpl->tpl_vars['i']->value-1];?>
</p>
        <?php }
}
?>
        <div id="footer-separate-line">
            <div class="line"></div>
            <div></div>
            <div class="line"></div>
        </div>
        <p>Podsumowując - oficjalnie, urzędowo i prawnie – dokonujesz wyboru materiału dzieła w postaci:
            <br>- bluzy
            <br>-koszulki
            <br>- czapeczki
            <br>- narzuty
            <br>- ponczo
            <br>z materiału przystosowanego do obróbki za pomocą techniki termosublimacji.</p>
        <p class="rules-end">Określasz wielkość siebie podając rozmiar, 
            który zabierać się będzie w standardach normy krajów Unii Europejskiej, 
            Stanów Zjednoczonych, Wielkiej Brytanii i pozostałych krajów, 
            z których będzie możliwe pozyskiwanie półproduktów wysokiej jakości 
            do wykonania ostatecznego dzieła.</p>
        <p class="rules-end">Zamawiasz czcionkę i gabaryt nadruku <br>
            -wypełniasz formularz zamówienia i drogą nadprzyrodzoną internetową posyłasz- 
            <br><br>
            A za pomysł swój, a naszą realizację – opłatę uiścisz na cyfrowy numer konta, 
            Tobie podany z identyfikatorem zamówienia Twego, 
            i od momentu, kiedy zaksięgowanie nastąpi, proces twórczy w manufakturze ruszy, 
            <br><br>
            lub u posłańca, który paczkę Ci dostarczy za pobraniem, 
            zali zważ swe postanowienie umowy słownej formularzem potwierdzonej 
            i odpowiedzialnie u posłańca z paczką Twą, należność ureguluj.</p>
    </section><?php }
}
