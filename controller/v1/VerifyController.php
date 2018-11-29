<?php
/**
 * Created by PhpStorm.
 * User: Alan 341455770@qq.com
 * Date: 2017/05/24 0024
 * Time: 12:20
 */

namespace App\Controller;


use App\System\Basic\CompactController;
use App\System\BasicInterface\ControllerInterface;
use App\System\Http\RequestProvider;
use App\System\Other\VerifyProvider;


class VerifyController extends CompactController implements ControllerInterface
{
    public function __construct($request)
    {
        parent::__construct($request);
    }

    /**
     * add action.
     * @return mixed
     */
    public function add()
    {
        // TODO: Implement add() method.
    }

    /**
     * edit action
     * @param int $id
     * @return mixed
     */
    public function edit($id)
    {
        // TODO: Implement edit() method.
    }

    /**
     * HTTP Method GET or get action.
     * @param int $id
     * @return mixed
     */
    public function getAction($id)
    {
        // TODO: Implement getAction() method.

        $this->getVerifyProvider()->entry();
    }


    /**
     * HTTP Method POST or save action.
     * Insert in db.
     * @return mixed
     */
    public function saveAction()
    {
        // TODO: Implement saveAction() method.

        $code = $this->getRequest()['verify_code'];

        var_dump($code);
        var_dump($this->getVerifyProvider()->check($code));

    }

    /**
     * HTTP Method PUT or update action.
     * Update in db.
     * @param int $id
     * @return mixed
     */
    public function putAction($id)
    {
        // TODO: Implement putAction() method.
    }

    /**
     * HTTP Method DELETE or delete action.
     * delete in db by id.
     * @param int $id
     * @return mixed
     */
    public function removeAction($id)
    {
        // TODO: Implement removeAction() method.
    }

    /**
     * HTTP Method DELETE or delete action.
     * delete in db by all.
     * @return mixed
     */
    public function destroy()
    {
        // TODO: Implement destroy() method.
    }

    protected function getVerifyProvider(){
        return app(VerifyProvider::class);
    }
}