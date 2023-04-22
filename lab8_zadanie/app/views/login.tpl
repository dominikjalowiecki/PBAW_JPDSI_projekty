{extends file="_base.tpl"}

{block name=main}
<form method="POST" action="{$config->app_url}login{$next}">
    <div class="row gtr-uniform gtr-50">
        <div class="col-4 col-12-small">
        <input
            type="text"
            name="login"
            id="login"
            placeholder="Login"
        />
        </div>
        <div class="col-4 col-12-small">
        <input
            type="password"
            name="password"
            id="password"
            placeholder="Password"
        />
        </div>

        <div class="col-4 col-12-small">
            <input type="submit" value="Login" class="primary fit" />
        </div>
    </div>

    {include file='_messages.tpl'}
</form>
{/block}