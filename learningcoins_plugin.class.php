<?php
/* For licensing terms, see /license.txt */

/**
 * Class LearningCoinsPlugin
 * This class defines the course plugin "LearningCoins", storing its data in the plugin_mindmap table.
 */
class LearningCoinsPlugin extends Plugin
{
     /**public $isCoursePlugin = true;
    public $course_settings = []; 
    */
    public $table = 'plugin_learningcoins';

    /**
     * LearningCoinsPlugin constructor.
    */
    protected function __construct()
    {
        parent::__construct(
            '1.0', 'LearningCoins Team',
            [
                'tool_enable' => 'boolean',
            ]
        );
    }

    /**
     * Create instance of a Mindmap plugin object.
     *
     * @return MindmapPlugin|null
     */
    public static function create()
    {
        static $result = null;

        return $result ? $result : $result = new self();
    }

    /**
     * Install the table structure.
    */
    public function install()
    {
        $sql = "CREATE TABLE IF NOT EXISTS ".$this->table."(
            id INT NOT NULL AUTO_INCREMENT,
            learningcoins_key VARCHAR(50),
            value_coin INT,
            user_id INT,
            c_id INT,
            session_id INT,
            url_id INT,
            used INT,
            PRIMARY KEY (id));";
        Database::query($sql);
        
        // Copy icons to the main Chamilo directory
        $p1 = api_get_path(SYS_PATH).'plugin/learningcoins/resources/img/learningcoins64.png';
        $p2 = api_get_path(SYS_PATH).'main/img/icons/64/learningcoins.png';
        copy($p1, $p2);
        
        $p3 = api_get_path(SYS_PATH).'plugin/learningcoins/resources/img/learningcoins64_na.png';
        $p4 = api_get_path(SYS_PATH).'main/img/icons/64/learningcoins_na.png';
        copy($p3, $p4);
        
        // Installing course settings
        //$this->install_course_fields_in_all_courses();
    }

    public function uninstall()
    {
        // Remove table
        $em = Database::getManager();
        $sm = $em->getConnection()->getSchemaManager();
        if ($sm->tablesExist('plugin_learningcoins')) {
            Database::query('DROP TABLE IF EXISTS plugin_learningcoins');
        }
        // Deleting course settings and course home icons
        //$this->uninstall_course_fields_in_all_courses();

        $p2 = api_get_path(SYS_PATH).'main/img/icons/64/learningcoins64.png';
        if (file_exists($p2) && is_writable($p2)) {
            unlink($p2);
        }
        $p4 = api_get_path(SYS_PATH).'main/img/icons/64/learningcoins64_na.png';
        if (file_exists($p4) && is_writable($p4)) {
            unlink($p4);
        }
    }
}
