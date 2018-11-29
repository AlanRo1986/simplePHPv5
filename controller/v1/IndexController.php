<?php
/**
 * Created by PhpStorm.
 * User: alan.luo
 * Date: 2018/11/28
 * Time: 15:38
 */

namespace App\Controller;


use App\System\Basic\CompactController;
use App\System\BasicInterface\ControllerInterface;
use App\System\Http\RequestProvider;

class IndexController extends CompactController implements ControllerInterface
{


    /**
     * Initialize the class.
     * ControllerInterface constructor.
     * @param RequestProvider $request
     */
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

        $this->display();
    }

    /**
     * HTTP Method POST or save action.
     * Insert in db.
     * @return mixed
     */
    public function saveAction()
    {
        // TODO: Implement saveAction() method.
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
}