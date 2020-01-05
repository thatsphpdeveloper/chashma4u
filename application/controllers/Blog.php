<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	public $outputData = array();

	public function index(){
		$this->outputData['recentBlogData'] = $this->Common_model->exequery("SELECT bl.*, (SELECT count(*) FROM ch_blog_comment WHERE status = 0 AND replyId = 0 AND blogId = bl.blogId) as totalComment, (SELECT GROUP_CONCAT(tag) FROM ch_tags WHERE status = 0 AND find_in_set(tagId, bl.tags)) as tags from ".tablePrefix."blog as bl where bl.status !=2 order by bl.addedOn DESC LIMIT 3");

        $this->outputData['testimonialData'] = $this->Common_model->exequery("SELECT re.*, (case when img != '' then concat('".UPLOADPATH."/user_images/', img) else '' end) as image,firstName,lastName from ".tablePrefix."review as re left join ".tablePrefix."user as us on us.userId = re.userId where re.status !=2 order by re.addedOn DESC LIMIT 3");

        $this->load->viewF('blog_view',$this->outputData);
	}


	public function details($slug){	
		



        $this->outputData['blogDetails'] = $this->Common_model->exequery("SELECT bl.blogId, bl.blogTitle, bl.description, bl.addedOn, bl.metaTitle, bl.metaDescription, bl.keywords, (SELECT slug FROM ch_blog WHERE blogId = (select max(blogId) from ch_blog where  status = 0 AND blogId < bl.blogId )) as previous, (SELECT slug FROM ch_blog WHERE blogId = (select min(blogId) from ch_blog where  status = 0 AND blogId > bl.blogId)) as next, (SELECT GROUP_CONCAT(tag) FROM ch_tags WHERE FIND_IN_SET(tagId, bl.tags)) as tags, (case when bl.image != '' then concat('".UPLOADPATH."/blog_images/', bl.image) else '' end) as big_image FROM ".tablePrefix."blog as bl where bl.status = 0 AND bl.slug ='".$slug."'",1 );
       
        
        $blogId = '';
        if(isset($this->outputData['blogDetails']->blogId) && !empty($this->outputData['blogDetails']->blogId)){
        	$blogId = $this->outputData['blogDetails']->blogId;
        	$this->outputData['title'] = $this->outputData['blogDetails']->metaTitle;
        	$this->outputData['description'] = $this->outputData['blogDetails']->metaDescription;
        	$this->outputData['keyword'] = $this->outputData['blogDetails']->keywords;
        }
        $this->outputData['commentSection'] = $this->Common_model->exequery("SELECT cs.*, firstName, lastName, (SELECT count(*) FROM ch_blog_comment where ch_blog_comment.replyId = cs.commentId AND status = 0) as replyCount, (case when img != '' then concat('".UPLOADPATH."/user_images/', img) else '' end) as image FROM ".tablePrefix."blog_comment as cs left join ".tablePrefix."user as cu on cu.userId = cs.userId WHERE cs.status = 0 AND cs.blogId = '".$blogId."'  AND replyId='0' order by cs.addedOn DESC LIMIT 0, 2");
        $this->outputData['totalComment'] = $this->Common_model->exequery("SELECT count(*) as total FROM ".tablePrefix."blog_comment WHERE status = 0 AND blogId = '".$blogId."'  AND replyId='0'",1);
        
        $this->outputData['blogMessage'] = $this->Common_model->exequery("SELECT count(co.commentId) as countMessage FROM ".tablePrefix."blog_comment as co WHERE co.blogId='".$blogId."' AND co.status = !2 ",1);
        

		$this->outputData['recentBlogData'] = $this->Common_model->exequery("SELECT bl.*, (SELECT count(*) FROM ch_blog_comment WHERE status = 0 AND replyId = 0 AND blogId = bl.blogId) as totalComment, (SELECT GROUP_CONCAT(tag) FROM ch_tags WHERE status = 0 AND find_in_set(tagId, bl.tags)) as tags from ".tablePrefix."blog as bl where bl.status !=2 order by bl.addedOn DESC LIMIT 3");

        $this->outputData['testimonialData'] = $this->Common_model->exequery("SELECT re.*, (case when img != '' then concat('".UPLOADPATH."/user_images/', img) else '' end) as image,firstName,lastName from ".tablePrefix."review as re left join ".tablePrefix."user as us on us.userId = re.userId where re.status !=2 order by re.addedOn DESC LIMIT 3");
        
		$this->load->viewF('blog_details',$this->outputData);
	}

}
?>