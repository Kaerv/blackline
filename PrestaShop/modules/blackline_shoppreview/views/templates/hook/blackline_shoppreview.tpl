<div id="shop-preview-module">
    {foreach from=$categories item="category"}
        <a class="category-container" href="${$category.link}">
            <img src="{$category.image}" class="preview-category-image">
            <div class="category-name">{$category.name}</div>
        </a>
    {/foreach}
</div>

<div class="mobile-shop-preview-separate-line"></div>
<div id="mobile-shop-preview-module">
        {foreach from=$categories item="category"}
        <a class="mobile-category-container" href="${$category.link}">
            <img src="{$category.image}" class="mobile-preview-category-image">
            <div class="mobile-category-name">{$category.name}</div>
        </a>
        {/foreach}
    <div class="mobile-shop-preview-fading"></div>
</div>