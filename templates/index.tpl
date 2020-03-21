<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Black Line</title>
    <link rel="stylesheet" href="{STYLES_PATH}/normalize.css">
    <link rel="stylesheet" href="{STYLES_PATH}/general.css">
    <link rel="stylesheet" href="{STYLES_PATH}/page-header.css">
    <link rel="stylesheet" href="{STYLES_PATH}/index.css">
</head>
<body>
    {include file='page_header.tpl'}
    <section id="hero-image" class="section"></section>

    <section id="quote_section" class="section">
        <div id="quotation-link" class="section header-text"><a href="#cytaty">CYTATY Z GŁĘBI STRON</a></div>

        {include 
            file='section_header.tpl' 
            title='Słowa są ukrytą siłą życia...'
            link = '#cytaty' 
            subtitle='ILE MASZ JEJ W SOBIE?' style='margin-top:50px;'}
    
        {assign var=authors value=[
            '- BERTOLD BRECHT -',
            '- JOHANN WOLFGANG VON GOETHE -',
            '- ANTOINE DE SAINT EXUPÉRY -',
            '- ALEKSANDER DUMAS -'
        ]} 
        {assign var=quotes value=[
            'Kto walczy, może przegrać. Kto nie walczy, już przegrał.',
            'Talent rośnie w samotności, charakter wśród ludzi.',
            'Mowa jest źródłem nieporozumień.',
            '[...] zła najczęściej nie da się naprawić; możemy je tylko pomścić.'
        ]}
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

    <section id="preamble-wrap" class="section text" style="background-image:url({$preamble_bg_url})">
        <div id="preamble" style="background-image:url({$preamble_paper_url})">
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
        {include file='section_header.tpl' 
        title='GALERIA MOJEGO EGO'
        link = '#galeria' 
    }
        <div class="shop-note">
            <p>
                Witaj wędrowcze! Oto sens i cel naszej manufaktury. Tutaj określisz siebie, a cytat Twój podziwiany będzie za szczerość i odwagę. Słowa wybrane z głębi mądrości wrażliwej, poprzez technologię zaklętą w ciśnieniu i temperaturze naniesione na materiał zostaną. Ty zaś z dumą przywdziejesz materiał ten w formie bluzy, koszulki, apaszki i ogólny zachwyt wywołasz. I nie myśl wędrowcze, że to kupczenie dukatami złotymi za bycie sobą… - To tylko odzienia fragment dukaty kosztuje… - Sens w słowach zawarty – jest bezcenny…
            </p>
            <p style="font-size:16px;">
                (Wykonanie zleconego cytatu na wybranym nośniku poprzez najnowocześniejszą technikę termosublimacji zapewniającą niespotykaną dotąd jakość nadruku na materiale)
            </p>
        </div>
        <div id="products-categories">
            {assign var=categories value = [
                'BLUZY',
                'KOSZULKI',
                'APASZKI',
                'CZAPECZKI',
                'INNE'
                ]}
            {for $i = 0 to 4}
            <div class="category">
                <div class="category-img"></div>
                <div class="category-name">{$categories[$i]}</div>
            </div>
            {/for}
        </div>

    </section>
</body>
</html>