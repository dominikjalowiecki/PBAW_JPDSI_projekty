{extends file="_base.tpl"}


{block name=main}    
<div class="table-wrapper">
    <table class="alt">
        <thead>
            <tr>
                <th>Count</th>
                <th>Amount</th>
                <th>Year duration</th>
                <th>Interest rate</th>
                <th>Output type</th>
                <th>Result</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$results key=k item=result}
                <tr>
                    <td>{$k + 1}</td>
                    <td>{$result['amount']}</td>
                    <td>{$result['year_duration']}</td>
                    <td>{$result['interest_rate']}</td>
                    <td>{$result['output_type']|capitalize}</td>
                    <td>{$result['result']}</td>
                    <td>{$result['date']}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</div>
{include file='_messages.tpl'}
{/block}