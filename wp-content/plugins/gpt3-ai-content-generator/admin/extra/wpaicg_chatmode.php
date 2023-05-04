<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$wpaicg_action = isset($_GET['action']) && !empty($_GET['action']) ? sanitize_text_field($_GET['action']) : '';
$checkRole = \WPAICG\wpaicg_roles()->user_can('wpaicg_chatgpt',empty($wpaicg_action) ? 'shortcode' : $wpaicg_action);
if($checkRole){
    echo '<script>window.location.href="'.$checkRole.'"</script>';
    exit;
}
?>
<style>
.wpaicg_notice_text_rw {
    padding: 10px;
    background-color: #F8DC6F;
    text-align: left;
    margin-bottom: 12px;
    color: #000;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
</style>
<div class="wrap fs-section">
    <h2 class="nav-tab-wrapper">
        <?php
        if(empty($wpaicg_action)){
            $wpaicg_action = 'shortcode';
        }
        \WPAICG\wpaicg_util_core()->wpaicg_tabs('wpaicg_chatgpt', array(
            'shortcode' => esc_html__('Shortcode','gpt3-ai-content-generator'),
            'widget' => esc_html__('Widget','gpt3-ai-content-generator'),
            'bots' => esc_html__('Chat Bots','gpt3-ai-content-generator'),
            'logs' => esc_html__('Logs','gpt3-ai-content-generator'),
            'settings' => esc_html__('Settings','gpt3-ai-content-generator')
        ), $wpaicg_action);
        if(!$wpaicg_action || $wpaicg_action == 'shortcode'){
            $wpaicg_action = '';
        }
        ?>
    </h2>
    <div id="poststuff">
        <div id="fs_account">
            <?php
            if(empty($wpaicg_action)):
                include __DIR__.'/wpaicg_chat_shortcode.php';
            elseif($wpaicg_action == 'widget'):
                include __DIR__.'/wpaicg_chat_widget_settings.php';
            elseif($wpaicg_action == 'bots'):
                include __DIR__.'/wpaicg_chatbots.php';
            elseif($wpaicg_action == 'logs'):
                include __DIR__.'/wpaicg_chatlog.php';
            elseif($wpaicg_action == 'settings'):
                include __DIR__.'/wpaicg_chat_settings.php';
            endif;
            ?>
        </div>
    </div>
</div>
