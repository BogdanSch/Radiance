<?php
if ( ! defined( 'ABSPATH' ) ) exit;
    ?>
    <div id="tabs-7">
        <h3>Product Writer</h3>
        <div class="wpcgai_form_row">
            <label class="wpcgai_label"><?php echo esc_html__('Write a SEO friendly product title?','gpt3-ai-content-generator')?>:</label>
            <?php $wpaicg_woo_generate_title = get_option('wpaicg_woo_generate_title',false); ?>
            <input<?php echo $wpaicg_woo_generate_title ? ' checked':'';?> type="checkbox" name="wpaicg_woo_generate_title" value="1">
            <a class="wpcgai_help_link" href="https://docs.aipower.org/docs/woocommerce#woocommerce-product-writer" target="_blank">?</a>
        </div>
        <div class="wpcgai_form_row">
            <label class="wpcgai_label"><?php echo esc_html__('Write a SEO Meta Description?','gpt3-ai-content-generator')?>:</label>
            <?php $wpaicg_woo_meta_description = get_option('wpaicg_woo_meta_description',false); ?>
            <input<?php echo $wpaicg_woo_meta_description ? ' checked':'';?> type="checkbox" name="wpaicg_woo_meta_description" value="1">
            <a class="wpcgai_help_link" href="https://docs.aipower.org/docs/woocommerce#woocommerce-product-writer" target="_blank">?</a>
        </div>
        <div class="wpcgai_form_row">
            <label class="wpcgai_label"><?php echo esc_html__('Write a product description?','gpt3-ai-content-generator')?>:</label>
            <?php $wpaicg_woo_generate_description = get_option('wpaicg_woo_generate_description',false); ?>
            <input<?php echo $wpaicg_woo_generate_description ? ' checked':'';?> type="checkbox" name="wpaicg_woo_generate_description" value="1">
            <a class="wpcgai_help_link" href="https://docs.aipower.org/docs/woocommerce#woocommerce-product-writer" target="_blank">?</a>
        </div>
        <div class="wpcgai_form_row">
            <label class="wpcgai_label"><?php echo esc_html__('Write a short product description?','gpt3-ai-content-generator')?>:</label>
            <?php $wpaicg_woo_generate_short = get_option('wpaicg_woo_generate_short',false); ?>
            <input<?php echo $wpaicg_woo_generate_short ? ' checked':'';?> type="checkbox" name="wpaicg_woo_generate_short" value="1">
            <a class="wpcgai_help_link" href="https://docs.aipower.org/docs/woocommerce#woocommerce-product-writer" target="_blank">?</a>
        </div>
        <div class="wpcgai_form_row">
            <label class="wpcgai_label"><?php echo esc_html__('Generate product tags?','gpt3-ai-content-generator')?>:</label>
            <?php $wpaicg_woo_generate_tags = get_option('wpaicg_woo_generate_tags',false); ?>
            <input<?php echo $wpaicg_woo_generate_tags ? ' checked':'';?> type="checkbox" name="wpaicg_woo_generate_tags" value="1">
            <a class="wpcgai_help_link" href="https://docs.aipower.org/docs/woocommerce#woocommerce-product-writer" target="_blank">?</a>
        </div>
        <?php
        $wpaicg_woo_custom_prompt = get_option('wpaicg_woo_custom_prompt',false);
        $wpaicg_woo_custom_prompt_title = get_option('wpaicg_woo_custom_prompt_title',esc_html__('Compose an SEO-optimized title in English for the following product: %s. Ensure it is engaging, concise, and includes relevant keywords to maximize its visibility on search engines.','gpt3-ai-content-generator'));
        $wpaicg_woo_custom_prompt_short = get_option('wpaicg_woo_custom_prompt_short',esc_html__('Provide a compelling and concise summary in English for the following product: %s, highlighting its key features, benefits, and unique selling points.','gpt3-ai-content-generator'));
        $wpaicg_woo_custom_prompt_description = get_option('wpaicg_woo_custom_prompt_description',esc_html__('Craft a comprehensive and engaging product description in English for: %s. Include specific details, features, and benefits, as well as the value it offers to the customer, thereby creating a compelling narrative around the product.','gpt3-ai-content-generator'));
        $wpaicg_woo_custom_prompt_keywords = get_option('wpaicg_woo_custom_prompt_keywords',esc_html__('Propose a set of relevant keywords in English for the following product: %s. The keywords should be directly related to the product, enhancing its discoverability. Please present these keywords in a comma-separated format, avoiding the use of symbols such as -, #, etc.','gpt3-ai-content-generator'));
        $wpaicg_woo_custom_prompt_meta = get_option('wpaicg_woo_custom_prompt_meta',esc_html__('Craft a compelling and concise meta description in English for: %s. Aim to highlight its key features and benefits within a limit of 155 characters, while incorporating relevant keywords for SEO effectiveness.','gpt3-ai-content-generator'));
        $wpaicg_woo_custom_prompt_title = str_replace("\\",'',$wpaicg_woo_custom_prompt_title);
        $wpaicg_woo_custom_prompt_short = str_replace("\\",'',$wpaicg_woo_custom_prompt_short);
        $wpaicg_woo_custom_prompt_description = str_replace("\\",'',$wpaicg_woo_custom_prompt_description);
        $wpaicg_woo_custom_prompt_keywords = str_replace("\\",'',$wpaicg_woo_custom_prompt_keywords);
        $wpaicg_woo_custom_prompt_meta = str_replace("\\",'',$wpaicg_woo_custom_prompt_meta);
        ?>
        <div class="wpcgai_form_row">
            <label class="wpcgai_label"><?php echo esc_html__('Use Custom Prompt','gpt3-ai-content-generator')?>:</label>
            <input<?php echo $wpaicg_woo_custom_prompt ? ' checked':'';?> type="checkbox" class="wpaicg_woo_custom_prompt" name="wpaicg_woo_custom_prompt" value="1">
            <a class="wpcgai_help_link" href="https://docs.aipower.org/docs/woocommerce#customizing-prompts" target="_blank">?</a>
        </div>
        <div<?php echo $wpaicg_woo_custom_prompt ? '':' style="display:none"';?> class="wpaicg_woo_custom_prompts">
            <div class="wpcgai_form_row">
                <label class="wpcgai_label"><?php echo esc_html__('Title Prompt','gpt3-ai-content-generator')?>:</label>
                <textarea style="width: 65%;" type="text" name="wpaicg_woo_custom_prompt_title"><?php echo esc_html($wpaicg_woo_custom_prompt_title);?></textarea>
            </div>
            <div class="wpcgai_form_row">
                <label class="wpcgai_label"><?php echo esc_html__('Short description prompt','gpt3-ai-content-generator')?>:</label>
                <textarea style="width: 65%;" type="text" name="wpaicg_woo_custom_prompt_short"><?php echo esc_html($wpaicg_woo_custom_prompt_short);?></textarea>
            </div>
            <div class="wpcgai_form_row">
                <label class="wpcgai_label"><?php echo esc_html__('Description prompt','gpt3-ai-content-generator')?>:</label>
                <textarea style="width: 65%;" type="text" name="wpaicg_woo_custom_prompt_description"><?php echo esc_html($wpaicg_woo_custom_prompt_description);?></textarea>
            </div>
            <div class="wpcgai_form_row">
                <label class="wpcgai_label"><?php echo esc_html__('Meta Description prompt','gpt3-ai-content-generator')?>:</label>
                <textarea style="width: 65%;" type="text" name="wpaicg_woo_custom_prompt_meta"><?php echo esc_html($wpaicg_woo_custom_prompt_meta);?></textarea>
            </div>
            <div class="wpcgai_form_row">
                <label class="wpcgai_label"><?php echo esc_html__('Keywords prompt','gpt3-ai-content-generator')?>:</label>
                <textarea style="width: 65%;" type="text" name="wpaicg_woo_custom_prompt_keywords"><?php echo esc_html($wpaicg_woo_custom_prompt_keywords);?></textarea>
            </div>
        </div>
        <h3><?php echo esc_html__('Token Sale','gpt3-ai-content-generator')?></h3>
        <?php
        $wpaicg_order_status_token = get_option('wpaicg_order_status_token','completed');
        ?>
        <div class="wpcgai_form_row wpaicg_woo_token_sale">
            <label class="wpcgai_label"><?php echo esc_html__('Add tokens to user account if order status is','gpt3-ai-content-generator')?>: </label>
            <select name="wpaicg_order_status_token">
                <option<?php echo $wpaicg_order_status_token == 'completed'? ' selected':''?> value="completed"><?php echo esc_html__('Completed','gpt3-ai-content-generator')?></option>
                <option<?php echo $wpaicg_order_status_token == 'processing'? ' selected':''?> value="processing"><?php echo esc_html__('Processing','gpt3-ai-content-generator')?></option>
            </select>
        <a class="wpcgai_help_link" href="https://docs.aipower.org/docs/user-management-token-sale" target="_blank">?</a>
        </div>
    </div>
<script>
    jQuery(document).ready(function ($){
        $('.wpaicg_woo_custom_prompt').click(function (){
            if($(this).prop('checked')){
                $('.wpaicg_woo_custom_prompts').show();
            }
            else{
                $('.wpaicg_woo_custom_prompts').hide();
            }
        })
    })
</script>
