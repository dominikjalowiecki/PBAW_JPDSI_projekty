{extends file="../assets/templates/_hero.tpl"}

{block name=main}
<h3>Form</h3>
<form method="GET" action="{$app_url}/app/credit_calc.php">
    <div class="row gtr-uniform gtr-50">
        <div class="col-6 col-12-small">
            <label for="credit_amount">Credit amount ($)</label>
            <input
            type="text"
            name="credit_amount"
            id="credit_amount"
            value="{if $credit_amount !== null}{$credit_amount|escape}{/if}"
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
            value="{if $credit_duration !== null}{$credit_duration|escape}{/if}"
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
            value="{if $credit_percent !== null}{$credit_percent|escape}{/if}"
            placeholder="12.5"
            />
        </div>
        <div class="col-6 col-12-small"></div>

        <div class="col-6 col-12-small">
            <label for="output_type">Output type</label>
            <select name="output_type" id="output_type">
            <option value="montly">Monthly</option>
            <option value="annually" {if $output_type !== null && $output_type === 'annually'}selected{/if}>Annually</option>
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

        <div class="col-6 col-12-small">
        {if !empty($res)}
            <hr />
            <div class="table-wrapper">
            <table id="table-result" class="alt">
                <tbody>
                <tr>
                    <td>Result:</td>
                    <td>{$res|string_format:"%.2f"}{($output_type === 'annually') ? '$ per year' : '$ per month'}</td>
                </tr>
                </tbody>
            </table>
            </div>
        {/if}
        </div>
    </div>
</form>
{/block}