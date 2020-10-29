<div id="shop-preview-module">
    {foreach from=$categories item="category"}
        <a class="category-container" href="${$category.link}">
            <img src="{$category.image}" class="preview-category-image">
            <div class="category-name">{$category.name}</div>
        </a>
    {/foreach}
</div>