<?php
/**
 * Category class.
 * 
 * @extends REST_Controller
 */
   require APPPATH . '/libraries/REST_Controller.php';
   use Restserver\Libraries\REST_Controller;
     
class Category extends REST_Controller {
    
	  /**
     * CONSTRUCTOR | LOAD MODEL
     *
     * @return Response
    */
    public function __construct() {
       parent::__construct();
       $this->load->library('Authorization_Token');	
       $this->load->model('Category_model');
    }
       
    /**
     * SHOW | GET method.
     *
     * @return Response
    */
	public function index_get($id = 0)
	{
        // ------- Main Logic part -------
        if(!empty($id)){
            $data = $this->Category_model->show($id);
            if($data==null){
                $this->response($data, REST_Controller::HTTP_NOT_FOUND);
            }
        } else {
            $data = $this->Category_model->show();
        }
        $this->response($data, REST_Controller::HTTP_OK);
        // ------------- End -------------
	}
      
    /**
     * INSERT | POST method.
     *
     * @return Response
    */
    public function index_post()
    {
        $headers = $this->input->request_headers(); 
		if (isset($headers['Authorization'])) {
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            if ($decodedToken['status'])
            {
                // ------- Main Logic part -------
                $input = $this->input->post();
                $data = $this->Category_model->insert($input);
        
                $this->response(['Category created successfully.'], REST_Controller::HTTP_OK);
                // ------------- End -------------
            }
            else {
                $this->response($decodedToken);
            }
		}
		else {
			$this->response(['Authentication failed'], REST_Controller::HTTP_UNAUTHORIZED);
		}
    } 
     
    /**
     * UPDATE | PUT method.
     *
     * @return Response
    */
    public function index_put($id)
    {
        $headers = $this->input->request_headers(); 
		if (isset($headers['Authorization'])) {
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            if ($decodedToken['status'])
            {
                // ------- Main Logic part -------
                $input = $this->_put_args;
                $headers = $this->input->request_headers(); 
                $data['category_name'] = $input['category_name'];
                // var_dump($data);die;
                $response = $this->Category_model->update($data, $id);

                $response>0?$this->response(['Category updated successfully.'], REST_Controller::HTTP_OK):$this->response(['Not updated'], REST_Controller::HTTP_OK);
                // ------------- End -------------
            }
            else {
                $this->response($decodedToken);
            }
		}
		else {
			$this->response(['Authentication failed'], REST_Controller::HTTP_UNAUTHORIZED);
		}
    }
     
    /**
     * DELETE method.
     *
     * @return Response
    */
    public function index_delete($id)
    {
        
        $headers = $this->input->request_headers(); 
		if (isset($headers['Authorization'])) {
			$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
            if ($decodedToken['status'])
            {
                // ------- Main Logic part -------
                $response = $this->Category_model->delete($id);

                $response>0?$this->response(['Category deleted successfully.'], REST_Controller::HTTP_OK):$this->response(['Not deleted'], REST_Controller::HTTP_OK);
                // ------------- End -------------
            }
            else {
                $this->response($decodedToken);
            }
		}
		else {
			$this->response(['Authentication failed'], REST_Controller::HTTP_UNAUTHORIZED);
		}
    }
    	
}