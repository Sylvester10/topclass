<?php
defined('BASEPATH') or exit('Direct access to script not allowed');


class News_model extends CI_Model {
	public function __construct() {
		parent::__construct();
	}



	/* ===== News ===== */
	public function get_news_details($id)	{ 
		return $this->db->get_where('news', array('id' => $id))->row();
	}


	public function get_news($limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date", "DESC"); //order by date DESC i.e. latest newsletters first
		$query = $this->db->get_where('news');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
            return false;
    }


    public function get_published_news($limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date", "DESC"); //order by date DESC i.e. latest newsletters first
		$query = $this->db->get_where('news', array('published' => 'true'));
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
            return false;
    }


    public function count_news() { 
		return $this->db->get_where('news')->num_rows();
	}
	
	
	public function count_published_news() { 
		return $this->db->get_where('news', array('published' => 'true'))->num_rows();
	}
	
	
	public function count_unpublished_news() { 
		return $this->db->get_where('news', array('published' => 'false'))->num_rows();
	}


	public function get_recent_published_news($limit) { //recent news for homepage and sidebar
		$this->db->order_by('date', 'DESC');
		$this->db->limit($limit); 
		return $this->db->get_where('news', array('published' => 'true'))->result();
	}


	public function check_news_is_published($post_id) { 
		$query = $this->get_news_details($post_id);
		$published = $query->published;
		return ($published == 'true') ? TRUE : redirect('home/news');  
    }






	/* ========== Admin Actions: News ============= */
	
	public function create_news($featured_image, $thumbnail) { 
		/*
		//For snippet, mb_strimwidth is used get the first 300 xters from the content and append ...
		//strip_tags is used to remove html tags when post is shared
		//For slug, the title is processed to replace spaces with hyphen, and remove special xters that are not url-friendly.
		*/
		$title = ucwords($this->input->post('title', TRUE)); 
		$slug = get_slug($title); 
		$content = ucfirst($this->input->post('body', TRUE));		
		$snippet = mb_strimwidth(strip_tags($content), 0, 300, "...");
		$body = nl2br($content);
		
		$data = array (
			'title' => $title,
			'slug' => $slug,
			'snippet' => $snippet,
			'body' => $body,
			'featured_image' => $featured_image,
			'featured_image_thumb' => $thumbnail,
			'published' => 'true',
		);
		return $this->db->insert('news', $data);
	}
	
	
	public function edit_news($id, $featured_image, $thumbnail) { 
		/*
		//For snippet, mb_strimwidth is used get the first 300 xters from the content and append ...
		//strip_tags is used to remove html tags when post is shared
		//For slug, the title is processed to replace spaces with hyphen, and remove special xters that are not url-friendly.
		*/
		$title = ucwords($this->input->post('title', TRUE)); 
		$slug = get_slug($title); 
		$content = ucfirst($this->input->post('body', TRUE));		
		$snippet = mb_strimwidth(strip_tags($content), 0, 300, "...");
		$body = nl2br($content);
		
		$data = array (
			'title' => $title,
			'slug' => $slug,
			'snippet' => $snippet,
			'body' => $body,
			'featured_image' => $featured_image,
			'featured_image_thumb' => $thumbnail,
			'published' => 'true',
		);
		$this->db->where('id', $id);
		return $this->db->update('news', $data);
	}
	
	
	public function publish_news($id) { 
		$data = array (
			'published' => 'true',
		);
		$this->db->where('id', $id);
		return $this->db->update('news', $data);
	}
	
	
	public function unpublish_news($id) { 
		$data = array (
			'published' => 'false',
		);
		$this->db->where('id', $id);
		return $this->db->update('news', $data);
	}
	
	
	public function delete_news_featured_image($id) {
		$y = $this->get_news_details($id);
		unlink('./assets/uploads/news/'.$y->featured_image); //delete the featured image
		unlink('./assets/uploads/news/'.$y->featured_image_thumb); //delete the thumbnail
    } 
	
	
	public function delete_news($id) {
		$y = $this->get_news_details($id);
		$this->delete_news_featured_image($id); //remove image files from server
		return $this->db->delete('news', array('id' => $id));
    } 
	
	
	public function bulk_actions_news() {
		$selected_rows = count($this->input->post('check_bulk_action', TRUE)); 
		$bulk_action_type = $this->input->post('bulk_action_type', TRUE);		
		$row_id = $this->input->post('check_bulk_action', TRUE);
		foreach ($row_id as $id) {
			switch ($bulk_action_type) {
				case 'publish':
					$this->publish_news($id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} News article published successfully.");
				break;
				case 'unpublish':
					$this->unpublish_news($id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} News article unpublished successfully.");
				break;
				case 'delete':
					$this->delete_news($id);
					$this->session->set_flashdata('status_msg', "{$selected_rows} News article deleted successfully.");
				break;
			}
		} 
	}


	
	/* ===== Comments ===== */
	public function get_comment_details($comment_id)	{ 
		return $this->db->get_where('comments', array('id' => $comment_id))->row();
	}


	public function get_comments_by_post_id($post_id, $limit, $offset) {		
		$this->db->limit($limit, $offset); //limit to be used as per_page, offset to be used as pagination segment
		$this->db->order_by("date", "DESC"); //order by date DESC i.e. latest commentsletters first
		$this->db->where('post_id', $post_id);
		$query = $this->db->get('comments');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
       	return FALSE;
    }


    public function count_post_comments($post_id) { 
    	$this->db->where('post_id', $post_id);
		return $this->db->get('comments')->num_rows();
	}
	
	
	public function create_comment($post_id) { 
		$name = ucwords($this->input->post('name', TRUE)); 
		$email = $this->input->post('email', TRUE); 
		$comment = ucfirst($this->input->post('comment', TRUE));		
		$comment = nl2br($comment);
		
		$data = array (
			'post_id' => $post_id,
			'name' => $name,
			'email' => $email,
			'comment' => $comment,
		);
		return $this->db->insert('comments', $data);
	}


	/* ========== Admin Actions: Comments ============= */
	public function delete_comment($comment_id) {
		return $this->db->delete('comments', array('id' => $comment_id));
    } 


}