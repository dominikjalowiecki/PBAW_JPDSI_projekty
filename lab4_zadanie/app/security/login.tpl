{extends file="../../assets/templates/_base.tpl"}

{block name=main}
<form method="POST" action="{$app_url}/app/security/login.php">
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
        <div class="col-6 col-12-small">
            {if count($messages) > 0} 
                <h4>Errors:</h4>
                <ol id="list-errors" class="list-messages">
                {foreach from=$messages item=message}
                    {strip}
                        <li>{$message}</li>
                    {/strip}
                {/foreach}
                </ol>
            {/if}            
        </div>
    </div>
</form>
{/block}