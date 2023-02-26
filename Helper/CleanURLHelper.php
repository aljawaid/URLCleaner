<?php

namespace Kanboard\Plugin\URLCleaner\Helper;

use Kanboard\Core\Base;

class CleanURLHelper extends Base
{
    public function newCoreRoutes()
    {
        $routes = array(
            // Default key for each will start from 0
            array(
                "before_route" => "?controller=TaskMovePositionController&action=show&task_id=662&project_id=37",
                "after_route" => "/project/37/task/662/move",
            ),
            array(
                "before_route" => "?controller=ActivityController&action=user",
                "after_route" => "/my-activity"
            ),
        );
    }
}
