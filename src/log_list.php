<?php
/**
 * Categories
 */
if(!defined('EMLOG_ROOT')){exit('error!');}
if($pageurl == BLOG_URL.'page/' || $pageurl == BLOG_URL.'?page='){
    include View::getView('home');
    }else{
?>
<div class="content">
        <div class="c-left">
            <div class="c-bak">
                <span><?php echo $sort['sortname']; 
                ?></span>
            </div>
            <?php
            $child = @$sort['children'];
            function getsortname($id){
            	global $CACHE;
            	global $Tconfig;
            	$flag=0;
                $navi_cache = $CACHE->readCache('sort');
                return $navi_cache[$id]['sortname'];
            }
               if(!empty($child)){
                   echo ' <ul class="nav">';
                   foreach ($child as $cv){
                       echo '<li><a href="/?sort='.$cv.'"><span>'.getsortname($cv).'</span></a></li>';
                   }
                   echo '</ul>';
            }
            ?>
        </div>
        <div class="c-right">
            <div class="e-tour">
                <ul class="c-tt">
                    <li class="c-title">
                        <h2><?php echo $sort['sortname']; ?></h2>
                    </li>
                    <li class="c-path">
                        <span>当前位置：</span>
                        <a href="index.php">首页</a>
                        <span class="c-logo">&gt;</span>
                        <a href="#"><?php echo $sort['sortname']; ?></a>
                    </li>
                </ul>						
            </div>
            <div class="e-content">
                <ul class="e-t-list">
                <?php
                    if (!empty($logs)):
                        foreach ($logs as $value):
                            ?>
                            <li><a href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a><?php topflg($value['top'], $value['sortop'], isset($sortid) ? $sortid : ''); ?><span class="c-t-date"><?php echo gmdate('Y-n-j', $value['date']); ?></span></li>
                            <?php
                        endforeach;
                    else:
                ?>
                <h2 style="font-size: 24px; font-weight: 100;padding-top: 20px">未找到</h2>
                <p style="font-size: 14px; font-weight: 100px;padding-top: 5px">抱歉，没有符合您查询条件的结果。</p>
                <?php endif; ?>
                </ul>
                <div class="d-e-page">
                <?php 
                	$page_loglist = change_page($lognum, $index_lognum, $page, $pageurl);
                	echo $page_loglist;
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    include View::getView('footer');
}

