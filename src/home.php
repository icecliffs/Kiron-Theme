<?php
/**
 * Index
 */
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<div class="c-slideshow">
    <div class="slide-wrap">
        <div class="slide s1">
            <img src="<?php echo TEMPLATE_URL;?>images/slides/img-1.gif"/>
        </div>
        <div class="slide">
            <img src="<?php echo TEMPLATE_URL;?>images/slides/img-2.jpg"/>
        </div>
    </div>
</div>
<div class="main">
<div class="c-main">
    <?php
        $DB = Database::getInstance();
        global $CACHE;
	    global $Tconfig;
        $ss = $CACHE->readCache('sort');
        if(!empty($ss)){
            foreach ($ss as $sss){
                echo '<div class="c-row">
                    <div class="c-t-infor"><span>'.$sss['sortname'].'</span></div>
                    <div class="c-t-line"><span><a href="?sort='.$sss['sid'].'">更多>></a></span></div>
                    <ul class="c-t-list">';
        	    $sql = "SELECT  `gid`, `title`,`date` FROM ".DB_PREFIX."blog WHERE `hide` = 'n' and `checked` ='y' and type='blog' and ( `sortid`= {$sss['sid']} or `sortid`= {$sss['pid']} )  order by `date` DESC LIMIT 0,6";
		        $resu = $DB->query($sql);
                if ($resu->num_rows > 0) {
                    while($row = $resu->fetch_assoc()) {
                        echo ' <li><a href="'.Url::log($row['gid']).'">'.$row['title'].'></a><span class="c-t-date">'. gmdate('Y-n-j', $row['date']).'</span></li>';
                }}else{
                        echo '<h2 style="font-size: 24px; font-weight: 100;padding-top: 20px">未找到</h2>
                        <p style="font-size: 14px; font-weight: 100px;padding-top: 5px">抱歉，该分类没有文章！。</p>';
                }
                    echo '  </ul>
                    </div>';
            }
        }
    ?>
</div>              
<?php

    include View::getView('side');
    include View::getView('footer');
?>