{if !$messages->isEmpty()}
    <div class="row gtr-uniform gtr-50 messages-row">
        {if $messages->isInfo()} 
            <div class="col-6 col-12-small">
                <h4>Infos:</h4>
                <ol id="list-infos" class="list-messages">
                {foreach from=$messages->getInfos() item=info}
                    {strip}
                        <li>{$info}</li>
                    {/strip}
                {/foreach}
                </ol>
            </div>
        {/if}   

        {if $messages->isError()} 
            <div class="col-6 col-12-small">
                <h4>Errors:</h4>
                <ol id="list-errors" class="list-messages">
                {foreach from=$messages->getErrors() item=message}
                    {strip}
                    <li>{$message}</li>
                    {/strip}
                {/foreach}
                </ol>
            </div>
        {/if}   
    </div>
{/if}