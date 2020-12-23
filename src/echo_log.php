<?php 
/**
 * Article
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
			<div class="a-article">
				<h4 class="a-t-t"><?php topflg($top); ?><?php echo $log_title; ?></h4>
				<div class="line"></div>
				<div class="des-note">
                    <p class="a-t-d">来源：<?php blog_author($author); ?></p>
                    <p class="a-t-d">分类：<?php article_sort($logid); ?></p>
                    <p class="a-t-d">发布时间：<?php echo gmdate('Y-n-j', $date); ?></p>
                    <p class="a-t-d"><?php editflg($value['logid'],$value['author']); ?></p>
				</div>
				<div class="a-articles">
                    <?php echo $log_content; ?>
                </div>
                <div class="a-features">
				    <a href="index.php">返回</a><a href="">我有问题</button>
			    </div>
                <div class="nextlog">
                    <?php neighbor_log($neighborLog); ?>
                </div>
                <p class="a-tag"><?php blog_tag($logid); ?></p>
			</div>

<?php
 include View::getView('footer');
?>