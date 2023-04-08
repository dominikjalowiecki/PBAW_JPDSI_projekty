{extends file="_hero.tpl"}

{block name=main}
<h3>Form</h3>
<form method="GET" action="{$config->app_url}">
    <input type="hidden" name="action" value="credit_calc">
    <div class="row gtr-uniform gtr-50">
        <div class="col-6 col-12-small">
            <label for="credit_amount">Credit amount ($)</label>
            <input
            type="text"
            name="credit_amount"
            id="credit_amount"
            value="{if $form->credit_amount !== null}{$form->credit_amount|escape}{/if}"
            placeholder="100000"
            />
        </div>
        <div class="col-6 col-12-small"></div>

        <div class="col-6 col-12-small">
            <label for="credit_duration">Credit duration (years)</label>
            <input
            type="text"
            name="credit_duration"
            id="credit_duration"
            value="{if $form->credit_duration !== null}{$form->credit_duration|escape}{/if}"
            placeholder="5"
            />
        </div>
        <div class="col-6 col-12-small"></div>

        <div class="col-6 col-12-small">
            <label for="credit_percent">Credit percent (%)</label>
            <input
            type="text"
            name="credit_percent"
            id="credit_percent"
            value="{if $form->credit_percent !== null}{$form->credit_percent|escape}{/if}"
            placeholder="12.5"
            />
        </div>
        <div class="col-6 col-12-small"></div>

        <div class="col-6 col-12-small">
            <label for="output_type">Output type</label>
            <select name="output_type" id="output_type">
                {if isset($form->output_type)}
                    <option value="{$form->output_type}" selected>Repeat: {$form->output_type|capitalize}</option>
                    <option value="" disabled>======</option>
                {/if}
                <option value="montly">Monthly</option>
                <option value="annually">Annually</option>
            </select>
        </div>

        <div class="col-12">
            <ul class="actions">
            <li>
                <input type="submit" value="Calculate" class="primary" />
            </li>
            <li>
                <input type="reset" value="Reset" />
            </li>
            </ul>
        </div>

        {if !empty($result->result)}
            <div class="col-6 col-12-small">
                <hr />
                <div class="table-wrapper">
                <table id="table-result" class="alt">
                    <tbody>
                    <tr>
                        <td>Result:</td>
                        <td>{$result->result|string_format:"%.2f"}{($result->output_type === 'annually') ? '$ per year' : '$ per month'}</td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
        {/if}
    </div>

    {include file='_messages.tpl'}
</form>
{/block}