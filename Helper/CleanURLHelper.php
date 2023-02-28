<?php

namespace Kanboard\Plugin\URLCleaner\Helper;

use Kanboard\Core\Base;

class CleanURLHelper extends Base
{
    public function newCoreRoutes()
    {
        return array(
            // Default key for each will start from 0
            array(
                "before_route" => "?controller=TaskMovePositionController&action=show&task_id=662&project_id=37",
                "after_route" => "/project/37/task/662/move",
            ),
            array(
                "before_route" => "?controller=ActivityController&action=user",
                "after_route" => "/my-activity"
            ),
            array(
                "before_route" => "?controller=ProjectOverviewController&action=show&project_id=37&search=status%3Aopen",
                "after_route" => "/project/37/overview/status:open"
            ),
            array(
                "before_route" => "?controller=WebNotificationController&action=show&user_id=1",
                "after_route" => "/user/1/notifications/show"
            ),
            array(
                "before_route" => "?controller=BoardViewController&action=show&project_id=37&search=status%3Aopen",
                "after_route" => "/board/37/status:open"
            ),
            array(
                "before_route" => "?controller=TaskModificationController&action=edit&task_id=629&project_id=34",
                "after_route" => "/project/34/task/629/edit"
            ),
        );
    }

    public function newPluginRoutes()
    {
        return array(
            // Default key for each will start from 0
            array(
                "before_route" => "?controller=Bigboard&action=index&plugin=Bigboard",
                "after_route" => "/bigboard",
                "plugin" => "Bigboard"
            ),
        );
    }
}
