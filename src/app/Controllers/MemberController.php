<?php

namespace app\Controllers;

use app\Models\MemberModel;
use Server\CoreBase\Controller;


class MemberController extends Controller{

//    public $MemberModel;
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
    }
}