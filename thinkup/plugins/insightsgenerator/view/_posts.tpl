<span class="label label-{if $i->emphasis eq '1'}info{elseif $i->emphasis eq '2'}success{elseif $i->emphasis eq '3'}error{else}inverse{/if}"><i class="icon-white icon-{if $i->emphasis eq '1'}time{elseif $i->emphasis eq '2'}thumbs-up{elseif $i->emphasis eq '3'}warning-sign{else}star{/if}"></i> <a href="?u={$i->instance->network_username}&n={$i->instance->network}&d={$i->date|date_format:'%Y-%m-%d'}&s={$i->slug}">{$i->prefix}</a></span> 
{$i->text|link_usernames_to_twitter}
{foreach from=$i->related_data key=uid item=p name=bar}

    {* Show more link if there are more posts after the first one *}
    {if !$expand and $smarty.foreach.bar.total gt 1 and $smarty.foreach.bar.first}
        <div class="pull-right detail-btn"><button class="btn btn-info btn-mini" data-toggle="collapse" data-target="#flashback-{$i->id}"><i class="icon-chevron-down icon-white"></i></button></div>
    {/if}

    {* Hide posts after the first one *}
    {if !$expand and $smarty.foreach.bar.index eq 1}
        <div class="collapse in" id="flashback-{$i->id}">
    {/if}

    {include file=$tpl_path|cat:"_post.tpl" post=$p hide_insight_header='1'}

    {* Close up hidden div if there is one *}
    {if !$expand and $smarty.foreach.bar.total gt 1 and $smarty.foreach.bar.last}
        </div>
    {/if}

    {assign var="prev_post_year" value=$p->adj_pub_date|date_format:"%Y"}
{/foreach}
