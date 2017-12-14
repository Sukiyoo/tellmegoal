<?php

namespace app\Controllers;

use Server\CoreBase\Controller;

class ArticleController extends Controller{

    public $ArticleModel;
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->ArticleModel = $this->loader->model('ArticleModel', $this);
    }

    public function actionAdd(){
        $time = time();
        $this->redis_pool->getCoroutine()->multi();
        $num =  yield $this->redis_pool->getCoroutine()->sCard("article");
        $id = $num + 1;
        $article_key = "article:".$id;
        $article_arr = [
            "title" => "IOTA-如何尽快确认”pending”的交易",
            "link" => "http://www.iotachina.com/",
            "poster" => "user",
            "votes" => "0"
        ];
        $res1 = yield $this->redis_pool->getCoroutine()->hMset($article_key,$article_arr);
        $res2 = yield $this->redis_pool->getCoroutine()->zAdd("score:",$time,$article_key);
        if($res1 && $res2){
            $this->redis_pool->getCoroutine()->exec();
            $this->http_output->end("添加成功!");
        }else{
            $this->redis_pool->getCoroutine()->discard();
            $this->http_output->end("添加失败!");
        }


    }

//
//    protected function initialization($controller_name, $method_name)
//    {
//        parent::initialization($controller_name, $method_name);
//        $this->MemberModel = $this->loader->model('MemberModel', $this);
//    }

    public function actionRegister(){

//        $model = $this->loader->model(MemberModel::class, $this);

//        $id = yield $this->mysql_pool->coroutineBegin($this);
//        $update_result = yield $this->mysql_pool->dbQueryBuilder->update('member')->set('sex', '1')->where('uid', 10000)->coroutineSend($id);
//        $result = yield $this->mysql_pool->dbQueryBuilder->select('*')->from('user_info')->where('uid', 10000)->coroutineSend($id);
//        if ($result['result'][0]['channel'] == 1000) {
//            $this->http_output->end('commit');
//            yield $this->mysql_pool->coroutineCommit($id);
//        } else {
//            $this->http_output->end('rollback');
//            yield $this->mysql_pool->coroutineRollback($id);
//        }
        $result = yield $this->mysql_pool->dbQueryBuilder->select('*')
            ->from('member')
            ->coroutineSend()->row();
        $this->http_output->end($result, false);

//        $result = yield $this->redis_pool->getCoroutine()->set('testroute', 1);
        $result = yield $this->redis_pool->getCoroutine()->select(1);
        yield $this->redis_pool->getCoroutine()->set("key","111");
        $this->destroy();
        // 实例化模型
        $this->MemberModel = $this->loader->model("MemberModel",$this);
        $MemberTask = $this->loader->task("MemberTask");
        // tcp
        $this->send("hello");
        // initAsynPools
        $aa = get_instance()->getAsynPool("kkk");


    }
}