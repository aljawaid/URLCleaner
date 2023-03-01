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
            array(
                "before_route" => "?controller=ConfigController&action=email",
                "after_route" => "/settings/email"
            ),
            array(
                "before_route" => "?controller=LinkController&action=show",
                "after_route" => "/settings/link-labels"
            ),
            array(
                "before_route" => "?controller=CurrencyController&action=show",
                "after_route" => "/settings/currencies"
            ),
            array(
                "before_route" => "?controller=TaskListController&action=show&project_id=37&search=status%3Aopen",
                "after_route" => "/project/37/task/liststatus:open"
            ),
            array(
                "before_route" => "?controller=TaskRecurrenceController&action=edit&task_id=662&project_id=37",
                "after_route" => "/project/37/task/662/recurrence/edit"
            ),
            array(
                "before_route" => "?controller=SubtaskController&action=create&task_id=662&project_id=37",
                "after_route" => "/project/37/task/662/subtask/add"
            ),
            array(
                "before_route" => "?controller=TaskInternalLinkController&action=create&task_id=662&project_id=37",
                "after_route" => "/project/37/task/662/link/internal/add"
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
            array(
                "before_route" => "?controller=WikiController&action=index&plugin=Wiki",
                "after_route" => "/help",
                "plugin" => "Wiki"
            ),
            array(
                "before_route" => "?controller=WikiController&action=show&project_id=37&search=status%3Aopen&plugin=wiki",
                "after_route" => "/help/project/37/show/status:open",
                "plugin" => "Wiki"
            ),
            array(
                "before_route" => "?controller=WikiController&action=create&plugin=wiki&project_id=37",
                "after_route" => "/help/project/37/create",
                "plugin" => "Wiki"
            ),
            array(
                "before_route" => "?controller=WikiController&action=detail&plugin=wiki&project_id=37&wiki_id=8",
                "after_route" => "/help/project/37/page/8/show",
                "plugin" => "Wiki"
            ),
            array(
                "before_route" => "?controller=WikiController&action=edit&plugin=wiki&wiki_id=8",
                "after_route" => "/help/page/8/edit",
                "plugin" => "Wiki"
            ),
            array(
                "before_route" => "?controller=WikiFileController&action=create&plugin=wiki&wiki_id=8&project_id=37",
                "after_route" => "/help/project/37/page/8/attach",
                "plugin" => "Wiki"
            ),
            array(
                "before_route" => "?controller=WikiController&action=confirm&plugin=wiki&project_id=37&wiki_id=8",
                "after_route" => "/help/project/37/page/8/delete",
                "plugin" => "Wiki"
            ),
            array(
                "before_route" => "?controller=WikiController&action=editions&plugin=wiki&project_id=37&wiki_id=8",
                "after_route" => "/help/project/37/page/8/editions",
                "plugin" => "Wiki"
            ),
            array(
                "before_route" => "?controller=WikiController&action=confirm_restore&plugin=wiki&project_id=37&wiki_id=8&edition=5",
                "after_route" => "/help/project/37/page/8/editions/restore/5",
                "plugin" => "Wiki"
            ),
            array(
                "before_route" => "?controller=ConfigController&action=show&plugin=Wiki",
                "after_route" => "/settings/wiki",
                "plugin" => "Wiki"
            ),
            array(
                "before_route" => "?controller=CalendarController&action=user&plugin=Calendar",
                "after_route" => "/my-calendar",
                "plugin" => "Calendar"
            ),
            array(
                "before_route" => "?controller=ConfigController&action=show&plugin=Calendar",
                "after_route" => "/settings/calendar",
                "plugin" => "Calendar"
            ),
            array(
                "before_route" => "?controller=CalendarController&action=project&project_id=37&search=status%3Aopen&plugin=Calendar",
                "after_route" => "/project/37/calendar/status:open",
                "plugin" => "Calendar"
            ),
            array(
                "before_route" => "?controller=MetadataTypesController&action=config&plugin=MetaMagik",
                "after_route" => "/settings/custom-fields",
                "plugin" => "MetaMagik"
            ),
            array(
                "before_route" => "?controller=MetadataTypesController&action=editType&plugin=metaMagik&key=3",
                "after_route" => "/settings/custom-fields/3/edit",
                "plugin" => "MetaMagik"
            ),
            array(
                "before_route" => "?controller=MetadataTypesController&action=confirmTask&plugin=metaMagik&key=3",
                "after_route" => "/settings/custom-fields/3/delete",
                "plugin" => "MetaMagik"
            ),
            array(
                "before_route" => "?controller=MetadataController&action=project&plugin=metaMagik&project_id=37",
                "after_route" => "/project/37/metadata",
                "plugin" => "MetaMagik"
            ),
            array(
                "before_route" => "?controller=MetadataController&action=task&plugin=metaMagik&task_id=662&project_id=37",
                "after_route" => "/project/37/task/662/metadata",
                "plugin" => "MetaMagik"
            ),
            array(
                "before_route" => "?controller=MetadataController&action=user&plugin=metaMagik&user_id=1",
                "after_route" => "/user/1/metadata",
                "plugin" => "MetaMagik"
            ),
            array(
                "before_route" => "?controller=MetadataController&action=editUser&plugin=metaMagik&user_id=1&key=board.collapsed.12",
                "after_route" => "/user/1/metadata/board.collapsed.12/edit",
                "plugin" => "MetaMagik"
            ),
            array(
                "before_route" => "?controller=MetadataController&action=confirmUser&plugin=metaMagik&user_id=1&key=board.collapsed.14",
                "after_route" => "/user/1/metadata/board.collapsed.14/delete",
                "plugin" => "MetaMagik"
            ),
            array(
                "before_route" => "?controller=AnalyticExtensionController&action=fieldTotalDistribution&plugin=metaMagik&project_id=37",
                "after_route" => "/project/37/analytics/metadata/total",
                "plugin" => "MetaMagik"
            ),
            array(
                "before_route" => "?controller=AnalyticExtensionController&action=fieldTotalDistributionRange&plugin=metaMagik&project_id=37",
                "after_route" => "/project/37/analytics/metadata/range",
                "plugin" => "MetaMagik"
            ),
        );
    }
}
