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
    <div id="menu-separate-line"></div>
    {assign var=rules value=[
        'Dokonujesz zakupu świadomie i uczciwie przyznajesz, że chcesz i wiesz, że chcesz tego, co kupujesz.',
        'Przekazujesz środki materialne w postaci fenicjańskich pieniędzy – a polskich złotówek, amerykańskich dolarów, brytyjskich funtów i europejskich euro, 
        na rzecz zmaterializowania wytworów manufaktury - dzieł rzeczywistych w postaci nadruków, na podłożu wybranym przez Ciebie.',
        'A podłoże to na Tobie spoczywać będzie, w formie fizycznego odzienia: bluza, koszulka, apaszka, czapeczka, narzuta, ponczo.',
        'Jasno i świadomie określasz swój rozmiar - wielkość Ciebie, poprzez kwadrat intencji i metafizykę potrzeb wrażliwości, rozmiar – S, M, L, XL, XXL, XXXXL... lub inny.',
        'Jasno i z podniesionym czołem opisujesz siebie, swoje poglądy, uczucia, stany, emocje, instynkty, nawyki, potrzeby, fochy, sukcesy, porażki, intencje, fabuły, popędy poprzez jasne komunikaty w formie cytatów, definicji lub opisów w języku polskim, angielskim, niemiecki, fińskim, hiszpańskim, koreańskim, ukraińskim, bułgarskim, tureckim i hutu.',
        'I przyznajesz iż treść Ciebie samego na fizyczności okrycia twego, będzie ostateczna i niestety niezmienialna z powodów techniczno-fizycznych. Podłoże i nadruk stanowią od momentu połączenia, nierozerwalną jedność, niepodlegającą zmianom w przeszłości, a jedynie przyszłości z powodu…',
        '…możliwości dodania kolejnych form cytatów na już istniejącym okryciu z istniejącymi już stwierdzeniami lub cytatami  (tylko w polu, gdzie to będzie możliwe po uprzedniej konsultacji).',
        'A cytaty Twe i poglądy na odzieniu Twym będą dwojako prawnie interpretowane: a) jako treść wytwóru ludzkiej myśli niepodlegającej prawom autorskim, majątkowym, azali tylko osobistym (prawa autorskie osobiste i majątkowe, zgodnie z obowiązującymi zasadami prawnymi) b) jako Twe prawa autorskie, jednorodnie osobiste i tylko Tobie immanentne oraz Tobie z woli praw wszelakich – przysługującej,  a w formie materialnej nam do realizacji przekazanej.',
        'A forma piękna dzieła tego, zawarta będzie w samym podłożu bluzy, koszulki tej, w połączeniu z wyśmienitym smakiem nadruku czerni prawdziwej  z czeluści otchłani pobranej.',
        'A upragnione swe prawdziwe „ja”, odziejesz, kiedy posłaniec dostarczy Ci szczęście to w paczce prawdziwie pięknej,  z papieru i sznura złożonej, z pieczęcią na froncie dodaną.',
        'I naprawdę upraszamy Ciebie o świadome dzieła tworzenie, gdyż zwrotów jako takich nie będzie ze względu na nieodwracalną ingerencję farby w materiał odzienia Twego.  A jeszcze nikt nie wymyślił maszyny czasu by go cofnąć i zmiany dokonać.'
        ]}
    <section id="rules" class="section text">
        {for $i = 1 to 11}
        <p class="rule-num">{$i}</p>
        <p class="rule">{$rules[$i - 1]}</p>
        {/for}
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
    </section>
{/block}
</body>
</html>