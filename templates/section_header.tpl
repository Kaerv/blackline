<div class="section-header" style={$style}>
    <div class="header-line"></div>
        
    <div class="section-title header-text">
        {if $subtitle}
                <div class="section-title-text decoration-text">{$title}</div>
                <div class="section-title-text" style="margin-top: 10px;">{$subtitle}</div>
        {else} 
            <div class="section-title-text">{$title}</div>
        {/if}
    </div>

    <div class="header-line"></div>
</div>