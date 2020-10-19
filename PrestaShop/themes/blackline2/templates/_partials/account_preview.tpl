{if $customer.id != ""}
<div id="account-preview">
    <div class="preview-welcome-message">Witaj {$customer.firstname}!</div>
    <div id="my-account-preview-button"><div>Moje konto</div></div>
    <div class="account-preview-separate-line"></div>
    <div id="logout"><div>Wyloguj</div></div>
</div>
{else}
{/if}
<script>
    $("#my-account-preview-button").on("click", function(event) {
        event.preventDefault();
        window.location.href = "{$urls.pages.authentication}"
    });
    $("#logout").on("click", function(event) {
        event.preventDefault();
        window.location.href = "{$urls.base_url}index.php?mylogout="
    });

    $("#header-account-ico").on("click", function(event) {
        window.location.href = "{$urls.pages.authentication}"
    });
</script>   