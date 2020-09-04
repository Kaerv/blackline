<div class="quote" id="quote-{$quote['id']}">
    <div>id: {$quote.id}</div>
    <div>Autor: {$quote.author}</div>
    <div>Tresc: {$quote.content}</div>
    {foreach from=$quote.categories item="category" key="key"}
        <div>Kategoria {$key}: {$category}</div>
    {/foreach}
    <div>Data dodania: {$quote.date_added}</div>
    <div>Wizyt rocznie: {$quote.visit_yearly}</div>
    <div>Wizyt miesiecznie: {$quote.visit_monthly}</div>
    <div>Wizyt dziennie: {$quote.visit_daily}</div>
</div>