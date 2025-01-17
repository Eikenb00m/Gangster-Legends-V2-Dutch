<?php

    /*
        THIS IS A CORE ENGINE FILE IT IS STRONGLY RECOMMENDED THAT YOU DO NOT EDIT THIS FILE!
     */

class page {

    public function __construct() {
        $setting = new Settings();
        $this->addToTemplate('game_name', $setting->loadSetting('game_name', true, 'Game Name'));
        $this->theme = $setting->loadSetting('theme', true, 'default');
        $this->adminTheme = $setting->loadSetting('adminTheme', true, 'admin');
        $this->landingPage = $setting->loadSetting('landingPage', true, 'loggedin');
        $this->addToTemplate("timestamp", time());
    }
    
    public $printPage = true, $theme, $template, $success = false, $loginPages = array('login', 'register'), $jailPages = array(), $loginPage, $jailPage, $dontRun = false, $modules = array(), $moduleView, $loadedTheme, $loadedModule, $landingPage, $module, $menus = array();
    private $pageHTML, $pageItems, $pageReplace, $alerts = array(), $files = array("js"=>array(), "css"=>array());
    
    public function addMenu($id, $title, $hook, $sort) {
        $this->menus[] = array(
            "id" => $id, 
            "title" => $title, 
            "hook" => $hook, 
            "sort" => $sort
        );
    }

    public function loadModuleMetaData() {
        $moduleDirectories = scandir("modules/installed/");
        
        /* Load meta data first */
        foreach ($moduleDirectories as $moduleName) {
            if ($moduleName[0] == ".") continue;
            $moduleInfoFile = "modules/installed/" . $moduleName . "/module.json";

            if (file_exists($moduleInfoFile)) {
                $info = json_decode(file_get_contents($moduleInfoFile), true);
                $info["id"] = $moduleName;
                $this->modules[$moduleName] = $info;
            }
        }

        /* Run hooks after */
        foreach ($moduleDirectories as $moduleName) {
            if ($moduleName[0] == ".") continue;
            $moduleHooksFile = "modules/installed/" . $moduleName . "/" . $moduleName . ".hooks.php";
            if (file_exists($moduleHooksFile)) {
                include_once $moduleHooksFile;
            }
        }
    }

    public function registerTemplateFile($url) {
        $ext = strtolower(pathinfo($url)["extension"]);
        if (!in_array($ext, array_keys($this->files))) {
            return $this->error($ext . " is an unsupported module file type!");
        }
        $this->files[$ext][] = $url;
    }

    public function username($user) {
        return $this->buildElement("userName", array(
            "user" => $user->user
        ));
    }

    public function loadPage($page, $dontRun = false) {

        $this->dontRun = $dontRun;
        $hook = new Hook("moduleLoad");
        $page = $hook->run($page, true);

        if (ctype_alpha($page)) {
            return $this->load($page);
        } else {
            die("Invalid page name");
        }
        
    }
        
    public function htmlOutput($module) {
        return $module->html;
    }

    public function alertsOutput($module) {
        $html = '';

        $alerts = array_merge($module->alerts, $this->alerts);

        foreach ($alerts as $key => $value) {
            $html .= $value;
        }
        return $html;
    } 

    public function money($money) {

        $defaultMoneyFunction = function ($money) {
            return "$" . number_format($money);
        };

        $hook = new Hook("currencyFormat");
        $func = $hook->run($defaultMoneyFunction, true);

        if (is_callable($func)) {
            return $func($money);
        }

    }
    
    private function load($page) {
        
        global $user;
        
        $moduleInfo = $this->modules[$page];

        $s = new Settings();

        $this->loadedModule = $moduleInfo;

        $this->moduleController = 'modules/installed/' . $page . '/' . $page . '.inc.php';
        $this->moduleView = 'modules/installed/' . $page . '/' . $page . '.tpl.php';

        if (file_exists($this->moduleController)) {
            if (file_exists($this->moduleView)) {
                
                include_once 'class/template.php';
                include_once $this->moduleView;
                
                $moduleCSSFile = "modules/installed/" . $page . "/" . $page . ".styles.css";
                if (file_exists($moduleCSSFile)) {
                    $this->registerTemplateFile($moduleCSSFile);
                }
                
                $moduleJSFile = "modules/installed/" . $page . "/" . $page . ".script.js";
                if (file_exists($moduleJSFile)) {
                    $this->registerTemplateFile($moduleJSFile);
                }

                $templateMethod = $page . 'Template';
                
                $this->template = new $templateMethod($page);

                if (!$this->template) {
                    $this->template = new template();
                }

                $this->loginPage = $moduleInfo["requireLogin"];
                $this->jailPage = $moduleInfo["accessInJail"];
                
                if ($this->dontRun) {
                    return $this;
                }

                include $this->moduleController;
                
                $this->module = new $page();

                $pageName = $page;

                if (isset($moduleInfo["pageName"])) {   
                    $pageName = $moduleInfo["pageName"];
                }
                    
                $this->addToTemplate('page', $pageName);

                $locationName = "";

                if (isset($this->pageItems["location"])) {
                    $locationName = $this->pageItems["location"];
                }                

                if ($user) {
                    $this->addMenu("actions", "Acties", "actionMenu", 10);
                    $this->addMenu("location", $locationName, "locationMenu", 20);
                    $this->addMenu("money", "Geld", "moneyMenu", 30);
                    $this->addMenu("casino", "Gokken", "casinoMenu", 40);
                    $this->addMenu("gang", "Families", "gangMenu", 50);
                    $this->addMenu("kill", "Moord", "killMenu", 60);
                    $this->addMenu("points", $s->loadSetting("pointsName"), "pointsMenu", 70);
                    $this->addMenu("account", "Account", "accountMenu", 80);
                } else {
                    $this->addMenu("login", "Login", "loginMenu", 0);
                }

                $menus = array();

                foreach ($this->menus as $menu) {
                    $hook = new Hook($menu["hook"]);
                    $items = $this->sortArray($hook->run($user));
                    $menus[$menu["id"]] = array(
                        "title" => $menu["title"], 
                        "items" => $items, 
                        "sort" => $menu["sort"]
                    );
                }

                $customMenus = array();
                $customMenu = new hook("customMenus");
                foreach ($customMenu->run($user) as $key => $menu) {
                    if ($menu) {
                        $menus[$key] = $menu;
                        $customMenus[$key] = $menu;
                    }
                }
    
                $allMenus = new hook("menus", function ($menus) {
                    return $this->sortArray($menus);
                });

                $allMenus = $allMenus->run($menus, true);

                $customMenus = $this->sortArray($customMenus);

                if (isset($this->module)) {
                    $this->addToTemplate('game', $this->htmlOutput($this->module));
                    $this->addToTemplate('alerts', $this->alertsOutput($this->module));
                }

                $this->addToTemplate('menus', $this->setActiveLinks($allMenus));
                $this->addToTemplate('customMenus', $this->setActiveLinks($customMenus));

                $this->pageHTML = $this->template->mainTemplate->pageMain;
                
            } else {
                die("Module template niet gevonden!" . 'modules/installed/' . $page . 'tpl.php');
            }
            
        } else {
            die("404 De pagina $page was niet gevonden!");
        }
        
    }

    public function setActiveLinks($menus) {
        if ($_SERVER["QUERY_STRING"]) {
            $queryString = "?" . $_SERVER["QUERY_STRING"];
        } else {
            $queryString = "?page=" . $this->landingPage;
        }

        if (!is_array($menus)) $menus = array();

        foreach ($menus as $key => $menu) {
            if (!is_array($menu["items"])) $menu["items"] = array();
            foreach ($menu["items"] as $k => $item) {
                if ($item["url"] && strpos($queryString, $item["url"]) !== false) {
                    $menu["items"][$k]["active"] = true;
                    break;
                }
            }
            $menus[$key] = $menu;
        }
        return $menus;
    }

    public function cmp ($a, $b) {
        if (!isset($a["sort"])) $a["sort"] = 0;
        if (!isset($b["sort"])) $b["sort"] = 0;
        return $a["sort"] - $b["sort"];
    }

    public function sortArray($arr) {
        if (!$arr) return $arr;
        $arr = array_filter($arr);
        uasort($arr, array($this, "cmp"));
        return $arr;

    }
    
    public function getPageItem($find) {
        return $this->pageItems[$find];
    }

    public function addToTemplate($find, $replace) {
        $this->pageItems[$find] = $replace;
    }
    
    private function replaceVars() {

        $this->addToTemplate("JSFiles", $this->files["js"]);
        $this->addToTemplate("CSSFiles", $this->files["css"]);

        $template = new pageElement($this->pageItems);

        if (isset($_SERVER["HTTP_RETURN_JSON"])) {
            header("content-type: application/json");
            echo json_encode($this->pageItems, JSON_PRETTY_PRINT);
            exit;
        }
        $this->pageHTML = $template->parse($this->pageHTML);
        
    }
    
    public function printPage() {

        $this->replaceVars();
        
        if (!$this->printPage) return;

        $hook = new Hook("printPage");
        $hook->run($this);

        echo $this->pageHTML;
        
    }
        
    public function alert($text, $type = "error") {
        $this->alerts[] = $this->buildElement($type, array(
            "text" => $text
        ));
    }

    public function buildElement($templateName, $vars = array()) {

        $vars["_theme"] = $this->loadedTheme;
        $this->addToTemplate("_theme", $this->loadedTheme);

        $template = new pageElement($vars, $this->template, $templateName);
        return $template->parse();        
    }

    public function redirectTo($page, $vars = array()) {
        
        $get = '';

        $this->printPage = false;
        
        foreach ($vars as $key => $val) {
            $get .= '&' . $key . '=' . $val;
        }
        
        $redirect = '?page=' . $page . '';
        
        header("Location:" . $redirect . $get);
        
    }
    
}

?>