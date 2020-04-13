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
    <link rel="stylesheet" href={"/styles/$page.css"}>
</head>
<body>
    {include file='modules/page_header.tpl'}
    {include file="$page.tpl"}
    {include file='modules/page_footer.tpl'}
</body>
</html>