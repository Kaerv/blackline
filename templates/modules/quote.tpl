<div class="quote" id="quote-{$quote['id']}">
    <div class="quote-mark">,,</div>
    <div class="quote-content">{$quote.content}</div>
    <div class="quote-author">{$quote.author}</div>
    <div class="categories-container">
        {foreach from=$quote.categories item="category" key="key"}
            <span class="category">{$category}</span>
        {/foreach}
    </div>
</div>