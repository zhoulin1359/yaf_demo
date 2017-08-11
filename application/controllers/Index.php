<?php

/**
 * Created by PhpStorm.
 * User: zhoulin
 * Date: 2016/11/18
 * Time: 19:23
 * Email: zhoulin@mapgoo.net
 */
class IndexController extends InitController {


    private $webId;
    private $uid;
    private $clientIpAddress;

    private $webModel;
    private $webCount;
    private $webCache;
    private $userCache;

    /**
     * 加载模型
     */
    protected function init(){
        parent::init();
        $this->webId = $this->getParam('web_id');
        if (empty( $this->webId)){
            ajaxReturn(null,'not id',-1);
        }
        $this->clientIpAddress = getClientIp();
        $this->uid = md5( $this->clientIpAddress.$_SERVER['HTTP_USER_AGENT']);

        $this->webModel = new DbWebModel();

        $this->webCache = RedisWebModel::getInstance();
        $this->userCache = RedisUserModel::getInstance();
    }

    public function dataAction(){

        $webId = $this->getParam('id');
        if (empty($webId)){
            ajaxReturn(null,'not id',-1);
        }
        $webData = $this->webModel -> getWebInfoById($webId);
        var_dump($webData);


        if (!isset($_COOKIE[config('cookie.name')])){
            setcookie(config('cookie.name'), $this->uid ,time()+config('cookie.expire'),'/');
        }elseif ($_COOKIE[config('cookie.name')] !=  md5($this->uid .$_SERVER['HTTP_USER_AGENT'])){
            setcookie(config('cookie.name'), $this->uid ,time()+config('cookie.expire'),'/');
        }

        //浏览统计
        (new DbBrowseCountModel()) ->setConutInfo([
            'web_id'=>$webId,
            'uid'=>$this->uid,
            'ip'=>$this->clientIpAddress,
            'platform'=>getClientPlatform(),
            'is_weixin' => empty(isWeixin())?0:1,
            'create_time'=>time()
            ]);
    }


    /**
     * 事件
     */
    public function evenAction(){

        $webData = $this->webModel -> getWebInfoById($this->webId);
        //var_dump($webData);
        $class = new Web_Test($this->webId,$this->uid,$this->clientIpAddress,$this->param);
        ajaxReturn($class->test());
    }

    /**
     * 按钮统计
     */
    public function clickButtonAction(){
        $buttonName = $this->getParam('button_name');
        if (empty($buttonName)){
            ajaxReturn();
        }
        $webId = $this->getParam('id');
        if (empty($webId)){
            ajaxReturn();
        }
        if (!isset($_COOKIE[config('cookie.name')])){
            setcookie(config('cookie.name'), $this->uid ,time()+config('cookie.expire'),'/');
        }elseif ($_COOKIE[config('cookie.name')] !=  $this->uid ){
            setcookie(config('cookie.name'), $this->uid ,time()+config('cookie.expire'),'/');
        }
        $insertData['ip'] = $this->clientIpAddress;
        $insertData['web_id'] = $webId;
        $insertData['uid'] = $this->uid ;
        $insertData['name'] = $buttonName;
        $insertData['platform'] = getClientPlatform();
        $insertData['is_weixin'] = empty(isWeixin())?0:1;
        $insertData['create_time'] = time();
        (new DbButtonCountModel())->setButtonInfo($insertData);
        ajaxReturn();
    }

    public function indexAction() {//默认Action
        RedisUserModel::getInstance();
        $model = new DbWebModel();
        $model->getWebInfoById(1);
        var_dump( $model->getWebInfoById(1));

    }

    public function postAction(){
        $data['name'] =  $this->param['name'];
        $data['password'] = $this->param['password'];
        $data['id'] = $this->param['id'];
        $gump = new GUMP();
        $gump->validation_rules([
            'name' => 'required|alpha_numeric',
            'password'=>'required|max_len,25|min_len,6',
            'id'=>'required|integer'
        ]);
        $validated =$gump->run($data);

        var_dump($data);
        var_dump($validated);
        var_dump($gump->get_errors_array());
    }


    public function insertAction(){
        var_dump($_SERVER);
        var_dump($_GET);
        var_dump($this->param);
        $a = new WebModel();
        $a -> insertLogInfo(['name'=>$this->param['name']]);
    }

    public function showAction(){
        echo((new WebModel())->getWebInfoById($_GET['id'])['name']);
    }

    private function ss(){
        var_dump($_GET);
    }
    public function suiAction(){
        echo $this->getView()->render(APP_PATH.'/application/views/index/sui.phtml');
    }
    
    public function autoloadAction(){
        /*$json = new Json_json(array(12,34));
        var_dump($json->encode());
        var_dump($json->decode());*/
        var_dump(Json_json::staticFunction(array(123456)));
        //die();
    }
    
    public function autoload1Action(){
        $arr = [1,5,88,23,1,34];
        var_dump(Test_test::test($arr));
        var_dump($arr);
    }

    public function bootstrapAction(){
        var_dump(Bootstrap::randStr(6));
    }

}