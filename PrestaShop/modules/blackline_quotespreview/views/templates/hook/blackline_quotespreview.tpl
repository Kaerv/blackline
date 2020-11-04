<section id="quotes-preview">
    <script>
        let customerId = {$customer_id}
    </script>
        <div class="slider">
        <img src="/assets/icons/down-arrow.svg" class="slider-button left">
            {foreach from=$quotes item="quote"}
                    {include file="_partials/quote.tpl" quote=$quote}
            {/foreach}
        <img src="/assets/icons/down-arrow.svg" class="slider-button right">
    </div>
</section>