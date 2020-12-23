<?php 
/**
 * Footer
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
        <div class="footer">
            <span><?php echo $footer_info; ?>
                <a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a>
                Theme <a href="http://github.com/icecliffs/cpzz_theme" style="border-bottom:1px dashed white">CPZZ</a></span>
            <?php doAction('index_footer'); ?>
        </div>
    </div>
</body>
</html>