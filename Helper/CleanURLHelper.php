<?php

namespace Kanboard\Plugin\URLCleaner\Helper;

use Kanboard\Core\Base;

/**
 * Provides the single route registry used for alias registration and presentation.
 *
 * Native Kanboard routes are informational only. Plugin aliases are registered only
 * when the related plugin and controller action are available and no native route exists.
 *
 * Related test: tests/RouteContractTest.php
 *
 * @package Plugin\URLCleaner\Helper
 * @author  aljawaid
 */
class CleanURLHelper extends Base
{
    /**
     * Register missing aliases for installed and supported plugins.
     */
    public function registerPluginRoutes()
    {
        foreach ($this->getPluginRouteDefinitions() as $definition) {
            $loadedPlugin = $this->getLoadedPluginName($definition['plugin_name']);

            if ($loadedPlugin === null || !$this->isPluginActionAvailable($loadedPlugin, $definition)) {
                continue;
            }

            if ($this->findPluginUrl($definition, $loadedPlugin) !== '') {
                continue;
            }

            $this->route->addRoute(
                $definition['path'],
                $definition['controller'],
                $definition['action'],
                $loadedPlugin
            );
        }
    }

    /**
     * Return the current native Kanboard routes for the settings catalogue.
     *
     * @return array
     */
    public function newCoreRoutes()
    {
        $routes = array();

        foreach ($this->getCoreRouteDefinitions() as $definition) {
            $route = $this->buildCatalogueRoute($definition);

            if ($route !== null) {
                $routes[] = $route;
            }
        }

        return $routes;
    }

    /**
     * Return clean routes that are actually available for installed plugins.
     *
     * @return array
     */
    public function newPluginRoutes()
    {
        $routes = array();

        foreach ($this->getPluginRouteDefinitions() as $definition) {
            $loadedPlugin = $this->getLoadedPluginName($definition['plugin_name']);

            if ($loadedPlugin === null || !$this->isPluginActionAvailable($loadedPlugin, $definition)) {
                continue;
            }

            $route = $this->buildPluginCatalogueRoute($definition, $loadedPlugin);

            if ($route !== null) {
                $route['plugin'] = $definition['plugin_name'];
                $routes[] = $route;
            }
        }

        return $routes;
    }

    /**
     * Expose plugin definitions for focused compatibility tests.
     *
     * @return array
     */
    public function getPluginRouteDefinitions()
    {
        return array(
            $this->pluginRoute('Bigboard', 'Bigboard', 'Bigboard', 'index', '/bigboard'),

            $this->pluginRoute('Wiki', 'wiki', 'WikiController', 'index', '/wiki/index'),
            $this->pluginRoute('Wiki', 'wiki', 'WikiController', 'show', '/wiki/project/:project_id', array(
                'project_id' => 37,
            )),
            $this->pluginRoute('Wiki', 'wiki', 'WikiController', 'create', '/wiki/project/:project_id/create', array(
                'project_id' => 37,
            )),
            $this->pluginRoute(
                'Wiki',
                'wiki',
                'WikiController',
                'detail',
                '/wiki/project/:project_id/detail/:wiki_id',
                array('project_id' => 37, 'wiki_id' => 8)
            ),
            $this->pluginRoute('Wiki', 'wiki', 'WikiController', 'edit', '/wiki/edit/:wiki_id', array(
                'wiki_id' => 8,
            )),
            $this->pluginRoute(
                'Wiki',
                'wiki',
                'WikiFileController',
                'create',
                '/wiki/file/:project_id/create/:wiki_id',
                array('project_id' => 37, 'wiki_id' => 8)
            ),
            $this->pluginRoute(
                'Wiki',
                'wiki',
                'WikiController',
                'confirm',
                '/wiki/project/:project_id/remove/:wiki_id',
                array('project_id' => 37, 'wiki_id' => 8)
            ),
            $this->pluginRoute(
                'Wiki',
                'wiki',
                'WikiController',
                'editions',
                '/wiki/project/:project_id/editions/:wiki_id',
                array('project_id' => 37, 'wiki_id' => 8)
            ),
            $this->pluginRoute(
                'Wiki',
                'wiki',
                'WikiController',
                'confirm_restore',
                '/wiki/project/:project_id/restore/:wiki_id/:edition',
                array('project_id' => 37, 'wiki_id' => 8, 'edition' => 5)
            ),

            $this->pluginRoute('Calendar', 'Calendar', 'CalendarController', 'user', '/my-calendar'),
            $this->pluginRoute('Calendar', 'Calendar', 'ConfigController', 'show', '/settings/calendar'),
            $this->pluginRoute(
                'Calendar',
                'Calendar',
                'CalendarController',
                'project',
                '/project/:project_id/calendar/:search',
                array('project_id' => 37, 'search' => 'status:open')
            ),

            $this->pluginRoute(
                'MetaMagik',
                'metaMagik',
                'MetadataTypesController',
                'config',
                '/settings/custom-fields'
            ),
            $this->pluginRoute(
                'MetaMagik',
                'metaMagik',
                'MetadataTypesController',
                'editType',
                '/settings/custom-fields/:key/edit',
                array('key' => 3)
            ),
            $this->pluginRoute(
                'MetaMagik',
                'metaMagik',
                'MetadataTypesController',
                'confirmTask',
                '/settings/custom-fields/:key/delete',
                array('key' => 3)
            ),
            $this->pluginRoute(
                'MetaMagik',
                'metaMagik',
                'MetadataController',
                'project',
                '/project/:project_id/metadata',
                array('project_id' => 37)
            ),
            $this->pluginRoute(
                'MetaMagik',
                'metaMagik',
                'MetadataController',
                'task',
                '/project/:project_id/task/:task_id/metadata',
                array('project_id' => 37, 'task_id' => 662)
            ),
            $this->pluginRoute(
                'MetaMagik',
                'metaMagik',
                'MetadataController',
                'user',
                '/user/:user_id/metadata',
                array('user_id' => 1)
            ),
            $this->pluginRoute(
                'MetaMagik',
                'metaMagik',
                'MetadataController',
                'editUser',
                '/user/:user_id/metadata/:key/edit',
                array('user_id' => 1, 'key' => 'board.collapsed.12')
            ),
            $this->pluginRoute(
                'MetaMagik',
                'metaMagik',
                'MetadataController',
                'confirmUser',
                '/user/:user_id/metadata/:key/delete',
                array('user_id' => 1, 'key' => 'board.collapsed.14')
            ),
            $this->pluginRoute(
                'MetaMagik',
                'metaMagik',
                'AnalyticExtensionController',
                'fieldTotalDistribution',
                '/project/:project_id/analytics/metadata/total',
                array('project_id' => 37)
            ),
            $this->pluginRoute(
                'MetaMagik',
                'metaMagik',
                'AnalyticExtensionController',
                'fieldTotalDistributionRange',
                '/project/:project_id/analytics/metadata/range',
                array('project_id' => 37)
            ),
        );
    }

    /**
     * Define representative native routes without registering or overriding them.
     *
     * @return array
     */
    private function getCoreRouteDefinitions()
    {
        return array(
            $this->coreRoute('ActivityController', 'user', '?controller=ActivityController&action=user'),
            $this->coreRoute(
                'TaskMovePositionController',
                'show',
                '?controller=TaskMovePositionController&action=show&task_id=662',
                array('task_id' => 662)
            ),
            $this->coreRoute(
                'ProjectOverviewController',
                'show',
                '?controller=ProjectOverviewController&action=show&project_id=37&search=status%3Aopen',
                array('project_id' => 37, 'search' => 'status:open')
            ),
            $this->coreRoute(
                'WebNotificationController',
                'show',
                '?controller=WebNotificationController&action=show&user_id=1',
                array('user_id' => 1)
            ),
            $this->coreRoute(
                'BoardViewController',
                'show',
                '?controller=BoardViewController&action=show&project_id=37&search=status%3Aopen',
                array('project_id' => 37, 'search' => 'status:open')
            ),
            $this->coreRoute(
                'TaskModificationController',
                'edit',
                '?controller=TaskModificationController&action=edit&task_id=629',
                array('task_id' => 629)
            ),
            $this->coreRoute('ConfigController', 'email', '?controller=ConfigController&action=email'),
            $this->coreRoute('LinkController', 'show', '?controller=LinkController&action=show'),
            $this->coreRoute('LinkController', 'create', '?controller=LinkController&action=create'),
            $this->coreRoute(
                'LinkController',
                'edit',
                '?controller=LinkController&action=edit&link_id=1',
                array('link_id' => 1)
            ),
            $this->coreRoute(
                'LinkController',
                'confirm',
                '?controller=LinkController&action=confirm&link_id=1',
                array('link_id' => 1)
            ),
            $this->coreRoute('CurrencyController', 'show', '?controller=CurrencyController&action=show'),
            $this->coreRoute('CurrencyController', 'create', '?controller=CurrencyController&action=create'),
            $this->coreRoute('CurrencyController', 'change', '?controller=CurrencyController&action=change'),
            $this->coreRoute(
                'TaskListController',
                'show',
                '?controller=TaskListController&action=show&project_id=37&search=status%3Aopen',
                array('project_id' => 37, 'search' => 'status:open')
            ),
            $this->coreRoute(
                'TaskRecurrenceController',
                'edit',
                '?controller=TaskRecurrenceController&action=edit&task_id=662',
                array('task_id' => 662)
            ),
            $this->coreRoute(
                'SubtaskController',
                'create',
                '?controller=SubtaskController&action=create&task_id=662',
                array('task_id' => 662)
            ),
            $this->coreRoute(
                'TaskInternalLinkController',
                'create',
                '?controller=TaskInternalLinkController&action=create&task_id=662',
                array('task_id' => 662)
            ),
            $this->coreRoute(
                'TaskExternalLinkController',
                'find',
                '?controller=TaskExternalLinkController&action=find&task_id=662',
                array('task_id' => 662)
            ),
            $this->coreRoute(
                'CommentController',
                'create',
                '?controller=CommentController&action=create&task_id=662',
                array('task_id' => 662)
            ),
            $this->coreRoute(
                'TaskFileController',
                'create',
                '?controller=TaskFileController&action=create&task_id=662',
                array('task_id' => 662)
            ),
            $this->coreRoute(
                'TaskFileController',
                'screenshot',
                '?controller=TaskFileController&action=screenshot&task_id=662',
                array('task_id' => 662)
            ),
            $this->coreRoute(
                'TaskPopoverController',
                'screenshot',
                '?controller=TaskPopoverController&action=screenshot&task_id=607',
                array('task_id' => 607)
            ),
            $this->coreRoute(
                'TaskDuplicationController',
                'duplicate',
                '?controller=TaskDuplicationController&action=duplicate&task_id=662',
                array('task_id' => 662)
            ),
            $this->coreRoute(
                'TaskDuplicationController',
                'copy',
                '?controller=TaskDuplicationController&action=copy&task_id=662&project_id=37',
                array('task_id' => 662, 'project_id' => 37)
            ),
            $this->coreRoute(
                'TaskDuplicationController',
                'move',
                '?controller=TaskDuplicationController&action=move&task_id=662&project_id=37',
                array('task_id' => 662, 'project_id' => 37)
            ),
            $this->coreRoute(
                'TaskMailController',
                'create',
                '?controller=TaskMailController&action=create&task_id=662',
                array('task_id' => 662)
            ),
            $this->coreRoute(
                'TaskStatusController',
                'close',
                '?controller=TaskStatusController&action=close&task_id=662',
                array('task_id' => 662)
            ),
            $this->coreRoute(
                'TaskSuppressionController',
                'confirm',
                '?controller=TaskSuppressionController&action=confirm&task_id=662&redirect=board',
                array('task_id' => 662, 'redirect' => 'board')
            ),
            $this->coreRoute(
                'TaskSuppressionController',
                'confirm',
                '?controller=TaskSuppressionController&action=confirm&task_id=662',
                array('task_id' => 662)
            ),
        );
    }

    private function coreRoute($controller, $action, $beforeRoute, array $params = array())
    {
        return array(
            'before_route' => $beforeRoute,
            'controller' => $controller,
            'action' => $action,
            'params' => $params,
            'route_key' => '',
        );
    }

    private function pluginRoute(
        $pluginName,
        $routeKey,
        $controller,
        $action,
        $path,
        array $params = array()
    ) {
        $beforeRoute = '?controller=' . $controller . '&action=' . $action . '&plugin=' . $routeKey;

        foreach ($params as $name => $value) {
            $beforeRoute .= '&' . $name . '=' . rawurlencode((string) $value);
        }

        return array(
            'plugin_name' => $pluginName,
            'route_key' => $routeKey,
            'controller' => $controller,
            'action' => $action,
            'path' => $path,
            'params' => $params,
            'before_route' => $beforeRoute,
        );
    }

    private function buildCatalogueRoute(array $definition)
    {
        $url = $this->findUrl($definition);

        if ($url === '') {
            return null;
        }

        return array(
            'before_route' => $definition['before_route'],
            'after_route' => '/' . ltrim($url, '/'),
        );
    }

    private function buildPluginCatalogueRoute(array $definition, $loadedPlugin)
    {
        $url = $this->findPluginUrl($definition, $loadedPlugin);

        if ($url === '') {
            return null;
        }

        return array(
            'before_route' => $definition['before_route'],
            'after_route' => '/' . ltrim($url, '/'),
        );
    }

    private function findUrl(array $definition)
    {
        return $this->route->findUrl(
            $definition['controller'],
            $definition['action'],
            $definition['params'],
            $definition['route_key']
        );
    }

    private function findPluginUrl(array $definition, $loadedPlugin)
    {
        $routeKeys = array_unique(array(
            $loadedPlugin,
            $definition['route_key'],
            $definition['plugin_name'],
        ));

        foreach ($routeKeys as $routeKey) {
            $url = $this->route->findUrl(
                $definition['controller'],
                $definition['action'],
                $definition['params'],
                $routeKey
            );

            if ($url !== '') {
                return $url;
            }
        }

        return '';
    }

    private function getLoadedPluginName($expectedName)
    {
        foreach (array_keys($this->pluginLoader->getPlugins()) as $pluginName) {
            if (strcasecmp($pluginName, $expectedName) === 0) {
                return $pluginName;
            }
        }

        return null;
    }

    private function isPluginActionAvailable($loadedPlugin, array $definition)
    {
        $controllerClass = 'Kanboard\\Plugin\\' . $loadedPlugin . '\\Controller\\' . $definition['controller'];

        return class_exists($controllerClass) && method_exists($controllerClass, $definition['action']);
    }
}
