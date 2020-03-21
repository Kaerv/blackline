<div class="section-header center-position" style={$style}>
    <div class="header-line"></div>

    <a href="{$link}"> 
        <div class="section-title header-text">
            {if $subtitle}
                    <div class="section-title-text decoration-text">{$title}</div>
                    <div class="section-title-text" style="margin-top: 10px;">{$subtitle}</div>
            {else} 
                <div class="section-title-text">{$title}</div>
            {/if}
        </div>
    </a>  
    <div class="header-line"></div>
</div>