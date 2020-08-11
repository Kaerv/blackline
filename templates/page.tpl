{if $page != 'index'}
    {assign var="page_title" value = "{$page|ucfirst}{' - BLACKLINE'}"}

    {else}
        {assign var="page_title" value='BLACKLINE'}
{/if}

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$page_title}</title>
    <link rel="stylesheet" href="/styles/normalize.css">
    <link rel="stylesheet" href="/styles/general.css">
    <link rel="stylesheet" href="/styles/cart-preview.css">
    <link rel="stylesheet" href={"/styles/$page.css"}>
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
</head>
<body>
    {include file='modules/page_header.tpl'}
    {include file="$page.tpl"}
    {include file='modules/page_footer.tpl'}
</body>
</html>