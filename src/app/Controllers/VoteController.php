<?php

namespace app\Controllers;

use Server\CoreBase\Controller;

class VoteController extends Controller{

    public $VoteModel;
    protected function initialization($controller_name, $method_name)
    {
        parent::initialization($controller_name, $method_name);
        $this->VoteModel = $this->loader->model('VoteModel', $this);
    }

    public function actionAdd(){
        $time = time();
        $score =
        yield $this->redis_pool->getCoroutine()->select(1);
        yield $this->redis_pool->getCoroutine()->set("key","111");
        $this->destroy();

        // 1.投票200为有趣
        // 2.有趣的在前面展示1天
        // 3.每票分数432

        // 设计：两个有序集合 1.id time 2.id vote_score


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